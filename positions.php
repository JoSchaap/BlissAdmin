<?php
session_start();
include ('config.php');

mysql_connect($hostname, $username, $password) or die (mysql_error());
mysql_select_db($dbName) or die (mysql_error());

if (isset($_SESSION['user_id'])) {
	if (!isset($_GET['type'])) {
		die("[]");
	}

	switch($_GET['type']) {
	case 0:
	$sql = "select s.id, p.name, 'Player' as type, s.worldspace as worldspace, s.survival_time as survival_time, s.model as model, s.survivor_kills as survivor_kills, s.zombie_kills as zombie_kills, s.bandit_kills as bandit_kills, '" . $iid . "' as instance, s.is_dead as is_dead, s.unique_id as unique_id from profile p join survivor s on p.unique_id = s.unique_id where s.is_dead = 0 and last_updated > now() - interval 1 minute";
	$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}
		$name = $row['name'];
		$id = $row['id'];
		$uid = $row['unique_id'];
		$model = $row['model'];
		$KillsZ = $row['zombie_kills'];
		$KillsB = $row['bandit_kills'];
		$KillS = $row['survivor_kills'];
		$Duration = $row['survival_time'];
		$icon = "images/icons/player".($row['is_dead'] ? '_dead' : '').".png";
		$description = "<h2><a href=\"admin.php?view=info&show=1&id=".$uid."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/models/".str_replace('"', '', $model).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \">PlayerID: ".$id."<p>CharatcerID: ".$uid."<p>Zed Kills: ".$KillsZ."<p>Bandit Kills: ".$KillsB."<p>Alive Duration: ".$Duration."<p></td></tr></table>";
		

		$output[] = array(
			$row['name'] . ', ' . $row['id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			$icon
		);
	}
		echo json_encode($output);	
		break;
	case 1:
$sql = "select s.id, p.name, 'Player' as type, s.worldspace as worldspace, s.survival_time as survival_time, s.model as model, s.survivor_kills as survivor_kills, s.zombie_kills as zombie_kills, s.bandit_kills as bandit_kills, '" . $iid . "' as instance, s.is_dead as is_dead, s.unique_id as unique_id from profile p join survivor s on p.unique_id = s.unique_id where s.is_dead = 0 and last_updated > now() - interval 24 hour";
	$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}
		$name = $row['name'];
		$id = $row['id'];
		$uid = $row['unique_id'];
		$model = $row['model'];
		$KillsZ = $row['zombie_kills'];
		$KillsB = $row['bandit_kills'];
		$KillS = $row['survivor_kills'];
		$Duration = $row['survival_time'];
		$icon = "images/icons/player".($row['is_dead'] ? '_dead' : '').".png";
		$description = "<h2><a href=\"admin.php?view=info&show=1&id=".$uid."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/models/".str_replace('"', '', $model).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \">PlayerID: ".$id."<p>CharatcerID: ".$uid."<p>Zed Kills: ".$KillsZ."<p>Bandit Kills: ".$KillsB."<p>Alive Duration: ".$Duration."<p></td></tr></table>";
				

		$output[] = array(
			$row['name'] . ', ' . $row['unique_id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			$icon
		);
	}
		echo json_encode($output);	
		break;
	case 2:
$sql = "select s.id, p.name, 'Player' as type, s.worldspace as worldspace, s.survival_time as survival_time, s.model as model, s.survivor_kills as survivor_kills, s.zombie_kills as zombie_kills, s.bandit_kills as bandit_kills, '" . $iid . "' as instance, s.is_dead as is_dead, s.unique_id as unique_id from profile p join survivor s on p.unique_id = s.unique_id where s.is_dead = 1 and last_updated > now() - interval 24 hour";
	$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}
		$name = $row['name'];
		$id = $row['id'];
		$uid = $row['unique_id'];
		$model = $row['model'];
		$KillsZ = $row['zombie_kills'];
		$KillsB = $row['bandit_kills'];
		$KillS = $row['survivor_kills'];
		$Duration = $row['survival_time'];
		$icon = "images/icons/player".($row['is_dead'] ? '_dead' : '').".png";
		$description = "<h2><a href=\"admin.php?view=info&show=1&id=".$uid."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/models/".str_replace('"', '', $model).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \">PlayerID: ".$id."<p>CharatcerID: ".$uid."<p>Zed Kills: ".$KillsZ."<p>Bandit Kills: ".$KillsB."<p>Alive Duration: ".$Duration."<p></td></tr></table>";
		

		$output[] = array(
			$row['name'] . ', ' . $row['unique_id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			$icon
		);
	}
		echo json_encode($output);	
		break;
	case 3:
$sql = "select s.id, p.name, 'Player' as type, s.worldspace as worldspace, s.survival_time as survival_time, s.model as model, s.survivor_kills as survivor_kills, s.zombie_kills as zombie_kills, s.bandit_kills as bandit_kills, '" . $iid . "' as instance, s.is_dead as is_dead, s.unique_id as unique_id from profile p join survivor s on p.unique_id = s.unique_id where last_updated > now() - interval 24 hour";
	$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}
		$name = $row['name'];
		$id = $row['id'];
		$uid = $row['unique_id'];
		$model = $row['model'];
		$KillsZ = $row['zombie_kills'];
		$KillsB = $row['bandit_kills'];
		$KillS = $row['survivor_kills'];
		$Duration = $row['survival_time'];
		$icon = "images/icons/player".($row['is_dead'] ? '_dead' : '').".png";
		$description = "<h2><a href=\"admin.php?view=info&show=1&id=".$uid."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/models/".str_replace('"', '', $model).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \">PlayerID: ".$id."<p>CharatcerID: ".$uid."<p>Zed Kills: ".$KillsZ."<p>Bandit Kills: ".$KillsB."<p>Alive Duration: ".$Duration."<p></td></tr></table>";
		

		$output[] = array(
			$row['name'] . ', ' . $row['unique_id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			$icon
		);
	}
		echo json_encode($output);
		break;		
	case 4:
		$sql = "select id, otype, type, pos, instance from objects o join object_classes oc on o.otype = oc.classname where o.instance = " . $iid ." and o.oid = 0";
		$pagetitle = "Current Ingame vehicles";
	$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}

		$output[] = array(
			$row['otype'] . ', ' . $row['instance'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row['id'] . '">' . $row['otype'] . '</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['type'] . ".png"
		);
	}
		echo json_encode($output);
		break;
	case 5:
		$sql = "select vehicle_id, otype, type, worldspace, world, '" . $iid . "' as instance from spawns s join object_classes oc on s.otype = oc.classname where world = '" . $map . "'";
			$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}

		$output[] = array(
			$row['otype'] . ', ' . $row['instance'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row['id'] . '">' . $row['otype'] . '</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['type'] . ".png"
		);
	}
			echo json_encode($output);
		break;
	case 6:
		$sql = "select id, otype, type, pos, instance from objects o join object_classes oc on o.otype = oc.classname where o.otype = 'TentStorage' and o.instance = " . $iid;
					$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}

		$output[] = array(
			$row['otype'] . ', ' . $row['instance'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row['id'] . '">' . $row['otype'] . '</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['type'] . ".png"
		);
	}
			echo json_encode($output);
		break;
	case 7:
		$sql = "select id, otype, type, pos, instance from objects o join object_classes oc on o.otype = oc.classname where o.otype in ('Sandbag1_DZ', 'TrapBear', 'Hedgehog_DZ', 'Wire_cat1') and o.instance = " . $iid;
					$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}

		$output[] = array(
			$row['otype'] . ', ' . $row['instance'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row['id'] . '">' . $row['otype'] . '</a><br><a href="admin.php?view=actions&delete='.$row['id'].'">Remove: '.$row['id'].'</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['type'] . ".png"
		);
	}
			echo json_encode($output);
		break;
	case 8;
	$sql = "select s.id, p.name, 'Player' as type, s.pos as pos, '" . $iid . "' as instance, s.is_dead as is_dead, s.unique_id as unique_id from profile p join survivor s on p.unique_id = s.unique_id where s.is_dead = 0 and last_update > now() - interval 1 minute";
	$result = mysql_query($sql);
	$output = array();
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$row = mysql_fetch_assoc($result);

		$Worldspace = str_replace("[", "", $row['worldspace']);
		$Worldspace = str_replace("]", "", $Worldspace);
		$Worldspace = str_replace(",", ",", $Worldspace);
		$Worldspace = explode(",", $Worldspace);
		$x = 0;
		$y = 0;
		if(array_key_exists(2,$Worldspace)){$x = $Worldspace[2];}
		if(array_key_exists(1,$Worldspace)){$y = $Worldspace[1];}

		$output[] = array(
			$row['name'] . ', ' . $row['id'],
			'<h2><a href="admin.php?view=info&show=1&id=' . $row['unique_id'] . '">' . $row['name'] . '</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/player.png"
		);
	}
		echo json_encode($output);
		
	$sql1 = "select id, otype, type, pos, instance from objects o join object_classes oc on o.otype = oc.classname where o.instance = " . $iid ." and o.oid = 0";
	$result1 = mysql_query($sql1);
	$output1 = array();
	for ($i1 = 0; $i1 < mysql_num_rows($result1); $i1++) {
		$row1 = mysql_fetch_assoc($result1);

		$Worldspace1 = str_replace("[", "", $row1['pos']);
		$Worldspace1 = str_replace("]", "", $Worldspace1);
		$Worldspace1 = str_replace(",", ",", $Worldspace1);
		$Worldspace1 = explode(",", $Worldspace1);
		$x1 = 0;
		$y1 = 0;
		if(array_key_exists(2,$Worldspace1)){$x = $Worldspace1[2];}
		if(array_key_exists(1,$Worldspace1)){$y = $Worldspace1[1];}

		$output1[] = array(
			$row1['otype'] . ', ' . $row1['instance'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row1['id'] . '">' . $row1['otype'] . '</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i1,
			"images/icons/" . $row1['type'] . ".png"
		);
	}
		echo json_encode($output1);
	break;
	default:
		die("[]");
	}	
}
?>

