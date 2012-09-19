<?
if (isset($_SESSION['user_id']))
{	
	//if (isset($_GET["url"])){
		if (isset($_GET["kick"])){
			$cmd = "kick ".$_GET["kick"];
			$query = "INSERT INTO `logs`(`action`, `user`, `timestamp`) VALUES ('Player Kicked','{$_SESSION['login']}',NOW())";
			$sql2 = mysql_query($query) or die(mysql_error());
				
			$answer = rcon($serverip,$serverport,$rconpassword,$cmd);
			?>
			<script type="text/javascript">
				window.location = 'admin.php?view=table&show=0';
			</script>
			<?
		}
		if (isset($_GET["ban"])){
			$cmd = "ban ".$_GET["ban"];
			$query = "INSERT INTO `logs`(`action`, `user`, `timestamp`) VALUES ('Player Banned','{$_SESSION['login']}',NOW())";
			$sql2 = mysql_query($query) or die(mysql_error());
				
			$answer = rcon($serverip,$serverport,$rconpassword,$cmd);
			?>
			<script type="text/javascript">
				window.location = 'admin.php?view=table&show=0';
			</script>
			<?
		}	
		if (isset($_POST["say"])){
			$id = "-1";
			if (isset($_GET["id"])){
				$id = $_GET["id"];
			}
			$cmd = "Say ".$id." ".$_POST["say"];
			$query = "INSERT INTO `logs`(`action`, `user`, `timestamp`) VALUES ('Used Global','{$_SESSION['login']}',NOW())";
			$sql2 = mysql_query($query) or die(mysql_error());
				
			$answer = rcon($serverip,$serverport,$rconpassword,$cmd);
			?>
			<script type="text/javascript">
				window.location = 'admin.php';
			</script>
			<?
		}
		if (isset($_GET["delete"])){

			$remquery = "Delete FROM objects WHERE id=".$_GET["delete"];
			$result = mysql_query($remquery) or die(mysql_error());
			$class = mysql_fetch_assoc($result);
			$query = "INSERT INTO `logs`(`action`, `user`, `timestamp`) VALUES ('Removed Object ".$_GET["delete"]."','{$_SESSION['login']}',NOW())";
			$sql2 = mysql_query($query) or die(mysql_error());
			?>
			<script type="text/javascript">
				window.location = 'admin.php?view=map&show=7';
			</script>
			<?
		}
		if (isset($_GET["deletecheck"])){

			$remquery = "Delete FROM survivor WHERE CharacterID='".$_GET["deletecheck"]."'";
			$result = mysql_query($remquery) or die(mysql_error());
			$class = mysql_fetch_assoc($result);
			?>
			<script type="text/javascript">
				window.location = 'admin.php?view=check';
			</script>
			<?
		}
		if (isset($_GET["deletespawns"])){

			$remquery = "Delete FROM spawns WHERE ObjectID=".$_GET["deletespawns"];
			$result = mysql_query($remquery) or die(mysql_error());
			$class = mysql_fetch_assoc($result);
			?>
			<script type="text/javascript">
				window.location = 'admin.php?view=map&show=8';
			</script>
			<?
		}
		if (isset($_GET["resetlocation"])){

			$remquery = "update survivor set pos = '[]' WHERE id='".$_GET["resetlocation"]."'";
			$result = mysql_query($remquery) or die(mysql_error());
			$class = mysql_fetch_assoc($result);
			$query = "INSERT INTO `logs`(`action`, `user`, `timestamp`) VALUES ('Reset Player Location of ID:".$_GET["resetlocation"]."','{$_SESSION['login']}',NOW())";
			$sql2 = mysql_query($query) or die(mysql_error());
			?>
			<script type="text/javascript">
				window.location = 'admin.php?view=table&show=0';
			</script>
			<?
		}		
	//}
	?>
	<script type="text/javascript">
		window.location = 'admin.php';
	</script>
	<?

	
	
}
else
{
	header('Location: admin.php');
}
?>