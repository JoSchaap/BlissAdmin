<?php
	ini_set( "display_errors", 0);
	error_reporting (E_ALL ^ E_NOTICE);
	
session_start();
include ('config.php');

mysql_connect($hostname, $username, $password) or die (mysql_error());
mysql_select_db($dbName) or die (mysql_error());

				    $query = "SELECT * FROM survivor";
				    $res = mysql_query($query) or die(mysql_error());	
					//KillsZ
					if (mysql_num_rows($res) > 0) {
						//KillsZ
						$KillsZ = array (); // initialize 
						//KillsB
						$KillsB = array (); // initialize
						//KillsH
						$KillsH = array (); // initialize
						//Alive
						$Alive = array (); // initialize
						//HeadshotsZ
						$HeadshotsZ = array (); // initialize
						while ($row=mysql_fetch_array($res))
						{
							//KillsZ
							$KillsZ[] = $row['zombie_kills']; // sum 
							$totalKillsz = $row['zombie_kills'];
							//KillsB
							$KillsB[] = $row['bandit_kills']; // sum 
							$totalKillsB = $row['bandit_kills'];
							//KillsH
							$KillsH[] = $row['survivor_kills']; // sum 
							$totalKillsH = $row['survivor_kills'];
							//HeadshotsZ
							$HeadshotsZ[] = $row['headshots']; // sum 
							$totalHeadshotsZ = $row['headshots'];
							//print "<li>$totalKillsz</li>"; //debug
						}
						//Alive
						//$Alive[] = $row['is_dead']; // sum 
						$Alive = mysql_query("SELECT count(*) FROM survivor WHERE is_dead=0");
						$totalAlive = mysql_fetch_array($Alive);
						//KillsZ
						$KillsZ = array_sum($KillsZ);
						//KillsB
						$KillsB = array_sum($KillsB);
						//KillsH
						$KillsH = array_sum($KillsH);
						//Alive
						$Alive = array_sum($Alive);
						//HeadshotsZ
						$HeadshotsZ = array_sum($HeadshotsZ);
						
						$totalplayers= mysql_query("SELECT count(*) FROM profile");
						$num_totalplayers = mysql_fetch_array($totalplayers);
						
						$playerdeaths = mysql_query("SELECT count(*) FROM survivor WHERE is_dead=1");
						//$num_deaths = mysql_num_rows($playerdeaths);
						$num_deaths = mysql_fetch_array($playerdeaths);
						
						$alivebandits = mysql_query("SELECT count(*) FROM survivor WHERE is_dead=0 And Model like 'Bandit1_DZ'");
						$num_alivebandits = mysql_fetch_array($alivebandits);
						
						$totalVehicles = mysql_query("SELECT count(*) FROM objects WHERE oid=0 AND instance = " . $iid);
						$num_totalVehicles = mysql_fetch_array($totalVehicles);
						
						$Played24h = mysql_query("SELECT count(*) from survivor WHERE last_update > now() - INTERVAL 1 DAY");
						$num_Played24h = mysql_fetch_array($Played24h);
					}
					
					//$KillsB = $rowid['KillsB'];
					$DistanceFoot = $rowid['DistanceFoot'];
					$Duration = $rowid['survival_time'];
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $sitename ?></title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body id="stats-bg"> 

 
<div id="stats-holder">

	<div id="logo-login">
		<a href="index.php"><img src="images/logo.png" width="451px" height="218px" alt="" /></a>
	</div>
	
	<div class="clear"></div>
	<form action="index.php" method="post">

		<a href="http://www.gametracker.com/server_info/<?php echo $serverip?>:<?php echo $serverport?>/" target="_blank"><img src="http://cache.www.gametracker.com/server_info/<?php echo $serverip?>:<?php echo $serverport?>/b_560_95_1.png" border="0" width="560" height="95" alt=""/></a>

		<div id="statsbox">	
			<div id="login-inner">
				<table border="0" cellpadding="4" cellspacing="0">
<td width="26"><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-unique.gif" width="36" height="27" /></td>
    <td width="184"><strong>Total Players:</strong></td>
    <td width="129" align="right"><?php echo $num_totalplayers[0];?></td>
  </tr>
  <tr>
    <td><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-24hr.gif" width="36" height="27" /></td>
    <td><strong> Players in Last 24h:</strong></td>
    <td align="right"><?php echo $num_Played24h[0];?></td>
  </tr>
  <tr>
    <td><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-alive.gif" width="36" height="27" /></td>
    <td><strong>Alive Characters:</strong></td>
    <td align="right"><?php echo $totalAlive[0];?></td>
  </tr>
  <tr>
      <td><img src="./images/playerdeaths.png" width="24" height="24" /></td>
    <td><strong>Player Deaths:</strong></td>
    <td align="right"><?php echo $num_deaths[0];?></td>
  </tr>
  <tr>
    <td><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-zombies.gif" width="36" height="27" /></td>
    <td><strong>Zombies Killed:</strong></td>
    <td align="right"><?php echo $KillsZ;?></td>
  </tr>
  <tr>
    <td><img src="images/zombiehs.png" width="24" height="24" /></td>
    <td><strong>Zombies Headshots:</strong></td>
    <td align="right"><?php echo $HeadshotsZ;?></td>
  </tr>
  <tr>
    <td><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-murders.gif" width="36" height="27" /></td>
    <td><strong>Murders:</strong></td>
    <td align="right"><?php echo $KillsH;?></td>
  </tr>
  <tr>
    <td><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-bandits.gif" width="36" height="27" /></td>
    <td><strong>Bandits Alive:</strong></td>
    <td align="right"><?php echo $num_alivebandits[0];?></td>
  </tr>
  <tr>
    <td><img src="http://www.dayzmod.com/images/icons/sidebar/staticon-banditskilled.gif" width="36" height="27" /></td>
    <td><strong>Bandits Killed:</strong></td>
    <td align="right"><?php echo $KillsB;?></td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td><img src="./images/vehicles.png" width="24" height="24" /></td>
    <td><strong>Vehicles:</strong></td>
    <td align="right"><?php echo $num_totalVehicles[0];?></td>
  </tr>
				</table>
			</div>
			<div class="clear"></div>
		</div>
	</form>
</div>
</body>
</html>

</div>
<!--  end content -->
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	<a href="admin.php"><?php echo $sitename ?> &copy; Copyright 2006-2012</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>