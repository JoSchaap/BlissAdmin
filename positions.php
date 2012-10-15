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
		$sql = "select iv.id, v.class_name, 0 owner_id, iv.worldspace, iv.inventory, iv.instance_id, iv.parts, fuel, oc.type, damage from instance_vehicle iv inner join vehicle v on iv.vehicle_id = v.id inner join object_classes oc on v.class_name = oc.classname where iv.instance_id = '" . $iid . "'";
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
		$description = "<h2><a href=\"admin.php?view=info&show=4&id=".$row['id']."\">".$row['class_name']."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/vehicles/".$row['class_name'].".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2>left:".round(($y/100))." top:".round(((15360-$x)/100))."</td></td>Instance ID:".$row['instance_id']."</td></tr></table>";

		$output[] = array(
			$row['class_name'] . ', ' . $row['id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['type'] . ".png"
		);
	}
		echo json_encode($output);
		break;
	case 5:
		$sql = "select wv.*, v.*, oc.* from world_vehicle wv inner join vehicle v on wv.vehicle_id = v.id inner join object_classes oc on v.class_name = oc.classname where wv.world_id = '" . $world . "'";
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
		$description = "<h2><a href=\"admin.php?view=info&show=4&id=".$row['id']."\">".$row['class_name']."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/vehicles/".$row['class_name'].".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \">Position: left:".round(($y/100))." top:".round(((15360-$x)/100))."</td></td>World ID:".$row['world_id']."</td></tr></table>";

		$output[] = array(
			$row['class_name'] . ', ' . $row['world_id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['Type'] . ".png"
		);
	}
			echo json_encode($output);
		break;
	case 6:
		$sql = "select * from instance_deployable id inner join deployable d on id.deployable_id = d.id inner join object_classes oc on d.class_name = oc.classname where d.class_name = 'TentStorage' and id.instance_id = '" . $iid . "'";
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
			$row['class_name'] . ', ' . $row['instance_id'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row['id'] . '">' . $row['class_name'] . '</a></h2>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['Type'] . ".png"
		);
	}
			echo json_encode($output);
		break;
	case 7:
		$sql = "select * from instance_deployable id inner join deployable d on id.deployable_id = d.id inner join object_classes oc on d.class_name = oc.classname where d.class_name in ('Sandbag1_DZ', 'TrapBear', 'Hedgehog_DZ', 'Wire_cat1') and id.instance_id = '" . $iid . "'";
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
			$row['class_name'] . ', ' . $row['instance_id'],
			'<h2><a href="admin.php?view=info&show=4&id=' . $row['id'] . '">' . $row['class_name'] . '</a></h2><br><a href="admin.php?view=actions&delete='.$row['id'].'">Remove: '.$row['id'].'</a>',
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/" . $row['Type'] . ".png"
		);
	}
			echo json_encode($output);
		break;
	case 8;
	
	$sql = "select
  s.id,
  p.name class_name,
  'Player' as type,
  s.worldspace
from
  profile p
  join survivor s on p.unique_id = s.unique_id
  join world w on s.world_id = w.id
  join instance i on w.id = i.world_id and i.id = '" . $iid . "'
where
  s.is_dead = 0
  and s.last_updated > now() - interval 1 minute
union
select
  iv.id,
  v.class_name,
  oc.type,
  iv.worldspace
from
  instance_vehicle iv
  join vehicle v on iv.vehicle_id = v.id
  join object_classes oc on v.class_name = oc.classname
where iv.instance_id = '" . $iid . "'
union
select
  id.id,
  d.class_name,
  oc.type,
  id.worldspace
from
  instance_deployable id
  join deployable d on id.deployable_id = d.id
  join object_classes oc on d.class_name = oc.classname
where
  id.instance_id = '" . $iid . "'";

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
		$description = "<h2><a href=\"admin.php?view=info&show=4&id=".$row['id']."\">".$row['class_name']."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/vehicles/".$row['class_name'].".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2>left:".round(($y/100))." top:".round(((15360-$x)/100))."</td></td></tr></table>";

		$output[] = array(
			$row['class_name'] . ', ' . $row['id'],
			$description,
			trim($y),
			trim($x) + 1024,
			$i,
			"images/icons/everything/" . $row['type'] . ".png"
		);
	}
		echo json_encode($output);

		break;
	default:
		die("[]");
	}	
}
?>

