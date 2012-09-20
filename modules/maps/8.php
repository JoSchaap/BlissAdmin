<?php
ini_set( "display_errors", 0);
error_reporting (E_ALL ^ E_NOTICE);
	$markers= "var markers = [";
	$cmd = "Players";	
	$answer = rcon($serverip,$serverport,$rconpassword,$cmd);
	
	if ($answer != ""){
		$k = strrpos($answer, "---");
		$l = strrpos($answer, "(");
		$out = substr($answer, $k+4, $l-$k-5);
		$array = preg_split ('/$\R?^/m', $out);
		
		$players = array();
		for ($j=0; $j<count($array); $j++){
			$players[] = "";
		}
		for ($i=0; $i < count($array); $i++)
		{
			$m = 0;
			for ($j=0; $j<5; $j++){
				$players[$i][] = "";
			}
			$pout = preg_replace('/\s+/', ' ', $array[$i]);
			for ($j=0; $j<strlen($pout); $j++){
				$char = substr($pout, $j, 1);
				if($m < 4){
					if($char != " "){
						$players[$i][$m] .= $char;
					}else{
						$m++;
					}
				} else {
					$players[$i][$m] .= $char;
				}
			}
		}
		
		$pnumber = count($players);

		$markers= "var markers = [";
		$m = 0;
		for ($i=0; $i<count($players); $i++){

			if(strlen($players[$i][4])>1){
				$k = strrpos($players[$i][4], " (Lobby)");
				$playername = str_replace(" (Lobby)", "", $players[$i][4]);
				
				$paren_num = 0;
				$chars = str_split($playername);
				$new_string = '';
				foreach($chars as $char) {
					if($char=='[') $paren_num++;
					else if($char==']') $paren_num--;
					else if($paren_num==0) $new_string .= $char;
				}
				$playername = trim($new_string);

				$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $playername);
				$good = trim(preg_replace("/\s(\S{1,2})\s/", " ", preg_replace("[ +]", "  "," $search ")));
				$good = trim(preg_replace("/\([^\)]+\)/", "", $good));
				$good = preg_replace("[ +]", " ", $good);

				$query = "SELECT * FROM profile WHERE name LIKE '%". str_replace(" ", "%' OR name LIKE '%", $good). "%' LIMIT 1"; 				

				$res = null;
				$res = mysql_query($query) or die(mysql_error());
				$dead = "";
				$x = 0;
				$y = 0;
				$inventory = "";
				$backpack = "";
				$ip = $players[$i][1];
				$ping = $players[$i][2];
				$name = $players[$i][4];
				$id = "0";
				$uid = "0";
				
				
				while ($row=mysql_fetch_array($res)) {
				
				$name = $row['name'];
				$id = $row['id'];
				$uid = $row['unique_id'];
				
				$queryinfo = "SELECT * FROM survivor WHERE unique_id = '" . $row['unique_id'] . "' and is_dead=0";
				$resinfo = mysql_query($queryinfo) or die(mysql_error());								
				$rowinfo = mysql_fetch_array($resinfo);
				
					$Worldspace = str_replace("[", "", $rowinfo['pos']);
					$Worldspace = str_replace("]", "", $Worldspace);
					$Worldspace = explode(",", $Worldspace);					
					if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
					if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}
					$dead = ($row['is_dead'] ? '_dead' : '');
					$inventory = substr($rowinfo['inventory'], 0, 40)."...";
					$backpack = substr($rowinfo['backpack'], 0, 40)."...";
					$name = $row['name'];
					$id = $row['id'];
					$uid = $row['unique_id'];
					$model = $rowinfo['model'];
					$KillsZ = $rowinfo['zombie_kills'];
					$KillsB = $rowinfo['bandit_kills'];
					$KillS = $rowinfo['survivor_kills'];
					$Duration = $rowinfo['survival_time'];
					$SurvivalKills = $rowinfo['survival_kills'];
					
				}				
				
				$description = "<h2><a href=\"admin.php?view=info&show=1&id=".$uid."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"".$path."images/models/".str_replace('"', '', $model).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \">PlayerID: ".$id."<p>CharatcerID: ".$uid."<p>Zed Kills: ".$KillsZ."<p>Survivor Kills: ".$SurvivorKills."<p>Bandit Kills: ".$KillsB."<p>Alive Duration: ".$Duration."<p></td></tr></table>";
				//$description = "<h2><a href=\"admin.php?view=info&show=1&id=".$uid."&cid=".$id."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"".$path."images/models/".str_replace('"', '', $model).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2>left:".round(($y/100))." top:".round(((15360-$x)/100))."</td></tr></table>";
				$markers .= "['".htmlspecialchars($name, ENT_QUOTES)."', '".$description."',".$y.", ".($x+1024).", ".$m++.", '".$path."images/icons/player".$dead.".png'],";				
			}
		}
		
	$queryvehicles = "SELECT * from objects where damage < 0.95 AND instance = " . $iid;
	$resvehicles = mysql_query($queryvehicles) or die(mysql_error());
	$k = 0;
	while ($rowvehicles=mysql_fetch_array($resvehicles)) {
		$Worldspace = str_replace("[", "", $rowvehicles['pos']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}

		$query = "SELECT * FROM object_classes WHERE Classname='".$rowvehicles['otype']."'";
		$result = mysql_query($query) or die(mysql_error());
		$class = mysql_fetch_assoc($result);		

		$description = "<h2><a href=\"index.php?view=info&show=4&id=".$rowvehicles['id']."\">".$rowvehicles['otype']."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"".$path."images/vehicles/".$rowvehicles['otype'].".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2>left:".round(($y/100))." top:".round(((15360-$x)/100))."</td></tr></table>";
		$markers .= "['".$rowvehicles['otype']."', '".$description."',".$y.", ".($x+1024).", ".$k++.", '".$path."images/icons/".$class['Type'].".png'],";
	};
	}
	$markers .= "['Edge of map', 'Edge of Chernarus', 0.0, 0.0, 1, '".$path."images/thumbs/null.png']];";
	include ('modules/gm.php');

?>