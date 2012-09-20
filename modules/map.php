<?php
include ('config.php');
if (isset($_SESSION['user_id']))
{

	switch ($show) {
		case 0:
			$pagetitle = "Online players";
			break;
		case 1:
			$query = "SELECT * FROM survivor WHERE is_dead = 0"; 
			$pagetitle = "Alive players";		
			break;
		case 2:
			$query = "SELECT * FROM survivor WHERE is_dead = 1"; 
			$pagetitle = "Dead players";	
			break;
		case 3:
			$query = "SELECT * FROM survivor"; 
			$pagetitle = "All players";	
			break;
		case 4:
			$query = "SELECT * FROM objects where instance = " . $iid ." AND oid = 0";
			$pagetitle = "Current Ingame vehicles";	
			break;
		case 5:
			$query = "SELECT * FROM spawns WHERE world = 'chernarus'";
			$pagetitle = "All Posiable Vehicle spawn locations";	
			break;
		case 6:
			$query = "SELECT * FROM objects WHERE otype = 'TentStorage' AND instance = " . $iid;
			$pagetitle = "Current All Tent locations";	
			break;
		case 7:
			$query = "SELECT * FROM objects WHERE otype = 'Wire_cat1' OR otype = 'Hedgehog_DZ' OR otype = 'TrapBear' OR otype = 'Sandbag1_DZ' AND instance = " . $iid;;
			$pagetitle = "Current Ingame Deployed Items";	
			break;
		case 8:
			$pagetitle = "Online Players and Vehicles";
			break;			
		default:
			$pagetitle = "Online players";
		};
	

?>
<div id="page-heading">
<?php
	echo "<title>".$pagetitle." - ".$sitename."</title>";
	echo "<h1>".$pagetitle."</h1>";
?>
</div>
<?php
	include ('/maps/'.$show.'.php');
}
else
{
	header('Location: admin.php');
}
?> 
