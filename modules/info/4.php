<?php
$id = '';
if (isset($_GET['id'])){
	$id = " AND id ='".$_GET['id']."'";
}

$query = "SELECT * FROM objects WHERE id = ".$_GET["id"]." LIMIT 1"; 
$res = mysql_query($query) or die(mysql_error());
$number = mysql_num_rows($res);
while ($row=mysql_fetch_array($res)) {
	$Worldspace = str_replace("[", "", $row['pos']);
	$Worldspace = str_replace("]", "", $Worldspace);
	$Worldspace = str_replace(",", ",", $Worldspace);
	$Worldspace = explode(",", $Worldspace);
	/* $Inventory = $row['inventory'];
	$Inventory = str_replace("[", "", $Inventory);
	$Inventory = str_replace("]", "", $Inventory);
	$Inventory = str_replace('"', "", $Inventory);
	$Inventory = str_replace("|", ",", $Inventory);
	$Inventory = explode(",", $Inventory); */
	
	$Backpack  = $row['inventory'];
	$Backpack = str_replace("|", ",", $Backpack);
	//$Backpack  = str_replace('"', "", $Backpack );
	$Backpack  = json_decode($Backpack);

	
	
	$owner = "";
	$ownerid = "";
	$owneruid = "";
	if ($row['oid'] != "0"){
		$query = "SELECT * FROM survivor WHERE id = ".$row['oid']." LIMIT 1"; 
		$res2	= mysql_query($query) or die(mysql_error());
		while ($row2=mysql_fetch_array($res2)) {
			$owner = $row2['unique_id'];
			$ownerid = $row2['id'];
			$owneruid = $row2['unique_id'];
		}
	}
	
	$Hitpoints  = $row['health'];
	//$Hitpoints  ='[["wheel_1_1_steering",0.2],["wheel_2_1_steering",0],["wheel_1_4_steering",1],["wheel_2_4_steering",1],["wheel_1_3_steering",1],["wheel_2_3_steering",1],["wheel_1_2_steering",0],["wheel_2_2_steering",1],["motor",0.1],["karoserie",0.4]]';
	$Hitpoints = str_replace("|", ",", $Hitpoints);
	//$Backpack  = str_replace('"', "", $Backpack );
	$Hitpoints  = json_decode($Hitpoints);
	
	$xml = file_get_contents('/items.xml', true);
	require_once('/modules/xml2array.php');
	$items_xml = XML2Array::createArray($xml);
	
	$xml = file_get_contents('/vehicles.xml', true);
	require_once('/modules/xml2array.php');
	$vehicles_xml = XML2Array::createArray($xml);
?>	
	<div id="page-heading">
		<h1><?php echo "<title>".$row['otype']." - ".$sitename."</title>"; ?></h1>
		<h1><?php echo $row['otype']; ?> - <?php echo $row['id']; ?> - Last save: <?php echo $row['lastupdate']; ?></h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				<div id="gear_vehicle">
					<div class="gear_info">
						<img class="playermodel" src='images/vehicles/<?php echo $row['otype']; ?>.png'/>
						<div id="gps" style="margin-left:46px;margin-top:54px">
							<div class="gpstext" style="font-size: 22px;width:60px;text-align: left;margin-left:47px;margin-top:13px">
							<?php
								echo round(($Worldspace[0]/100));
							?>
							</div>
							<div class="gpstext" style="font-size: 22px;width:60px;text-align: left;margin-left:47px;margin-top:34px">
							<?php
								echo round(($Worldspace[3]/100));
							?>
							</div>
							<div class="gpstext" style="width:120px;margin-left:13px;margin-top:61px">
							<?php
								echo sprintf("%03d",round($Worldspace[1]/100)).sprintf("%03d",round((154-($Worldspace[2]/100))));
							?>
							</div>							
						</div>
						<?php if($row['oid'] != "0"){?>
						<div class="statstext" style="width:180px;margin-left:205px;margin-top:-115px">
							<?php echo 'Owner:&nbsp;<a href="admin.php?view=info&show=1&id='.$owneruid.'&cid='.$ownerid.'">'.$owner.'</a>';?>
						</div>
						<div class="statstext" style="width:180px;margin-left:205px;margin-top:-95px">
							<?php echo 'Damage:&nbsp;'.$row['damage'];?>
						</div>
						<div class="statstext" style="width:180px;margin-left:205px;margin-top:-75px">
							<?php echo 'Fuel:&nbsp;'.$row['fuel'];?>
						</div>
						<div class="statstext" style="width:180px;margin-left:205px;margin-top:-55px">
							<?php echo 'Owner ID:&nbsp;'.$row['oid'];?>
						</div>
						<?php } ?>
					</div>
					<!-- Backpack -->
					<div class="vehicle_gear">	
						<div id="vehicle_inventory">	
						<?php
							
							$maxmagazines = 24;
							$maxweaps = 3;
							$maxbacks = 0;
							$freeslots = 0;
							$freeweaps = 0;
							$freebacks = 0;
							$BackpackName = $row['otype'];
							if(array_key_exists('s'.$row['otype'],$vehicles_xml['vehicles'])){
								$maxmagazines = $vehicles_xml['vehicles']['s'.$row['otype']]['transportmaxmagazines'];
								$maxweaps = $vehicles_xml['vehicles']['s'.$row['otype']]['transportmaxweapons'];
								$maxbacks = $vehicles_xml['vehicles']['s'.$row['otype']]['transportmaxbackpacks'];
								$BackpackName = $vehicles_xml['vehicles']['s'.$row['otype']]['Name'];
							}
							if (count($Backpack) >0){
							$bpweaponscount = count($Backpack[0][0]);
							$bpweapons = array();
							for ($m=0; $m<$bpweaponscount; $m++){
									for ($mi=0; $mi<$Backpack[0][1][$m]; $mi++){
										$bpweapons[] = $Backpack[0][0][$m];
									}
							}							

							
							$bpitemscount = count($Backpack[1][0]);
							$bpitems = array();
							for ($m=0; $m<$bpitemscount; $m++){
								for ($mi=0; $mi<$Backpack[1][1][$m]; $mi++){
									$bpitems[] = $Backpack[1][0][$m];
								}
							}
							
							$bpackscount = count($Backpack[2][0]);
							$bpacks = array();
							for ($m=0; $m<$bpackscount; $m++){
								for ($mi=0; $mi<$Backpack[2][1][$m]; $mi++){
									$bpacks[] = $Backpack[2][0][$m];
								}
							}
							
							$Backpack = (array_merge($bpweapons, $bpacks, $bpitems));
							$freebacks = $maxbacks;
							$backpackslots = 0;
							$backpackitem = array();
							$bpweapons = array();
							for ($i=0; $i<count($Backpack); $i++){
								if(array_key_exists('s'.$Backpack[$i],$items_xml['items'])){
									switch($items_xml['items']['s'.$Backpack[$i]]['Type']){
										case 'binocular':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											break;
										case 'rifle':
											$bpweapons[] = array('image' => '<img style="max-width:84px;max-height:84px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											break;
										case 'pistol':
											$bpweapons[] = array('image' => '<img style="max-width:84px;max-height:84px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											break;
										case 'backpack':
											$bpweapons[] = array('image' => '<img style="max-width:84px;max-height:84px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											$freebacks = $freebacks - 1;
											break;
										case 'heavyammo':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											break;
										case 'smallammo':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											break;
										case 'item':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $items_xml['items']['s'.$Backpack[$i]]['Slots']);
											break;
										default:
											$s = '';
									}
								}
							}	
							
							$weapons = count($bpweapons);
							$magazines = $maxmagazines;
							$freeslots = $magazines;
							$freeweaps = $maxweaps;
							$jx = 1;
							$jy = 0;
							$jk = 0;
							$jl = 0;
							$numlines = 0;
							for ($j=0; $j< $weapons; $j++){
								if ($jk > 3){ $jk = 0;$jl++;}
								echo '<div class="gear_slot" style="margin-left:'.($jx+(86*$jk)).'px;margin-top:'.($jy+(86*$jl)).'px;width:84px;height:84px;">'.$bpweapons[$j]['image'].'</div>';
								//$magazines = $magazines - $bpweapons[$j]['slots'];	
								$freeweaps = $freeweaps - 1;
								$jk++;
							}
							
							if ($jl > 0){
								$numlines = $jl+1;
							}
							if ($jl == 0){
								if ($weapons > 0){
									$numlines++;
								}
							}
							//if ($weapons == 1){$numlines = 1;}
							$jx = 1;
							$jy = (86*$numlines);
							$jk = 0;
							$jl = 0;

							for ($j=0; $j<$magazines; $j++){
								if ($jk > 6){ $jk = 0;$jl++;}
								if ($j<count($backpackitem)){
									echo '<div class="gear_slot" style="margin-left:'.($jx+(49*$jk)).'px;margin-top:'.($jy+(49*$jl)).'px;width:47px;height:47px;">'.$backpackitem[$j]['image'].'</div>';
									//$jk = $jk - 1 + $backpackitem[$j]['slots'];
									//$backpackslots = $backpackslots + $backpackitem[$j]['slots'];
									$freeslots = $freeslots - 1;
								} else {
									//if($backpackslots==$maxmagazines){
										//break;
									//}
									//$backpackslots++;
									echo '<div class="gear_slot" style="margin-left:'.($jx+(49*$jk)).'px;margin-top:'.($jy+(49*$jl)).'px;width:47px;height:47px;"></div>';
								}								
								$jk++;
							}	
							}
							//$freeslots = $freeslots - $magazines;							
						?>
						</div>
						<div class="backpackname">
						<?php
							echo 'Mags:&nbsp;'.$freeslots.'&nbsp;/&nbsp;'.$maxmagazines.'&nbsp;Weaps:&nbsp;'.$freeweaps.'&nbsp;/&nbsp;'.$maxweaps.'&nbsp;Backs:&nbsp;'.$freebacks.'&nbsp;/&nbsp;'.$maxbacks.'&nbsp;';
						?>
						</div>
					</div>
					<!-- Backpack -->
					
					<!-- Hitpoints -->
					<div class="vehicle_hitpoints">	
						<?php
							$jx = 1;
							$jy = 48;
							$jk = 0;
							$jl = 0;
							for ($i=0; $i<count($Hitpoints); $i++){
								if ($jk > 3){ $jk = 0;$jl++;}
								$hit = '<img style="max-width:90px;max-height:90px;" src="images/hits/'.$Hitpoints[$i][0].'.png" title="'.$Hitpoints[$i][0].' - '.round(100 - ($Hitpoints[$i][1]*100)).'%" alt="'.$Hitpoints[$i][0].' - '.round(100 - ($Hitpoints[$i][1]*100)).'%"/>';
								//$hit = $Hitpoints[$i][0].' - '.$Hitpoints[$i][1];
								echo '<div class="hit_slot" style="margin-left:'.($jx+(93*$jk)).'px;margin-top:'.($jy+(93*$jl)).'px;width:91px;height:91px;background-color: rgba(100,'.round((255/100)*(100 - ($Hitpoints[$i][1]*100))).',0,0.8);">'.$hit.'</div>';
								$jk++;
							}							
						?>						
						<div class="backpackname">
						<?php
							echo 'Hitpoints';
						?>
						</div>
					</div>
					<!-- Hitpoints -->
			
				</div>
			</div>
			<!--  end table-content  -->
	
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
<?php } ?>
	<div class="clear">&nbsp;</div>