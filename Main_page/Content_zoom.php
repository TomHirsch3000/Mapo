
<?php
/* version control */

// version 3043
//change mysql_pconnect as its depricated
// version 3042
//change zoom impact from 10% to 20% to move nodes out of field of view more quickly
//zoom out = +20%
//zoom out = 120%-20% = 1/6 = 0.16666
// to zoom out, change one axis by 20%, need to take 10% off max and 10% off min, so divide (max-min) by 10
//to zoom in half, change one axis by 25%, need to take 12.5% off max and 12.5% off min, so divide (max-min) by 8
//to zoom in full, change one axis by 25%, need to take 25% off max, so divide (max-min) by 4

// version 3041
// minimum node width, font size and title width reduced - require node to be 100px when multiplier = 0.1 and node size =200
// minimum and maximum size after clicked node changed to accomodate larger field size of 200;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['size_min']))
$_SESSION['size_min']=$_SESSION['size_min'];
else $_SESSION['size_min']=0;

if(isset($_SESSION['size_max']))
$_SESSION['size_max']=$_SESSION['size_max'];
else $_SESSION['size_max'] = 1000;

if(isset($_SESSION['horizontal_min']))
$_SESSION['horizontal_min']=$_SESSION['horizontal_min'];
else $_SESSION['horizontal_min'] = -1400;

if(isset($_SESSION['horizontal_max']))
$_SESSION['horizontal_max']=$_SESSION['horizontal_max'];
else $_SESSION['horizontal_max'] = 1400;

if(isset($_SESSION['vertical_min']))
$_SESSION['vertical_min']=$_SESSION['vertical_min'];
else $_SESSION['vertical_min'] = -1000;

if(isset($_SESSION['vertical_max']))
$_SESSION['vertical_max']=$_SESSION['vertical_max'];
else $_SESSION['vertical_max'] = 1700;

if(isset($_SESSION['multiplier']))
$_SESSION['multiplier']=$_SESSION['multiplier'];
else $_SESSION['multiplier'] = 0.1;

if(isset($_SESSION['map_select']))
$_SESSION['map_select']=$_SESSION['map_select'];
else $_SESSION['map_select'] = 'physics';
 ?>

	<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_physixjuly = "localhost";
$database_physixjuly = "test";
$username_physixjuly = "root";
$password_physixjuly = "";
$physixjuly = mysqli_connect("p:".$hostname_physixjuly, "root", $password_physixjuly, $database_physixjuly); 
$mysqli = mysqli_connect("p:".$hostname_physixjuly, "root", $password_physixjuly, $database_physixjuly); 

// Check connection
if ($physixjuly->connect_error) {
  die("Connection failed: " . $physixjuly->connect_error);
}
echo "Connected successfully";


$result = $mysqli->query("SELECT title FROM physics LIMIT 10");
printf("Select returned %d rows.\n", $result->num_rows);

$map_select = $_SESSION['map_select'];
?>
 <?php
	if(isset($_GET['q'])) $z_num =  ($_GET['q']);
	else $z_num =0;
	$zoom_out_half = 10;//was 20;
	$zoom_out_full = 10;//never used;
	$zoom_in_full = 6;//was 11;
	$zoom_in_half = 12;//was 22;
	if (is_numeric($z_num)) {
		if ($z_num == 0 ) {
					$_SESSION['views']=1;
					$_SESSION['size_min'] = 0;
					$_SESSION['size_max'] = 230;
					$_SESSION['horizontal_min'] = -1400;
					$_SESSION['horizontal_max'] = 1400;
					$_SESSION['vertical_min'] = -1100;
					$_SESSION['vertical_max'] = 1700;
					$_SESSION['multiplier'] = 0.1;}
		elseif ($z_num == 99 ) {
			$_SESSION['size_min'] 		= $_SESSION['size_min']+5;	
			$_SESSION['size_max'] 		= $_SESSION['size_max']+5;	
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_out_half)	;	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_out_half)	;
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_out_half)	;
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_out_half)	;	
			$_SESSION['multiplier']		= $_SESSION['multiplier']/1.5;			
			}
		elseif ($z_num == 1 ) {
			$_SESSION['size_min'] 		= $_SESSION['size_min']-5;			
			$_SESSION['size_max'] 		= $_SESSION['size_max']-5;		
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_full);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'];		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_full)	;	
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*1.5;	
			}
		elseif ($z_num == 2 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-5;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_full);		
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*1.5;			
			}
	elseif ($z_num == 3 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-5;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_full);	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_full);		
			$_SESSION['multiplier']		= $_SESSION['multiplier']*1.5;			
			}
	elseif ($z_num == 4 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-5;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];	 	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_full);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*1.5;			
			}			
	elseif ($z_num == 5 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-5;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*1.5;			
			}				
	elseif ($z_num == 6 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-5;				
			$_SESSION['size_max'] = $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_full);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['multiplier'] = $_SESSION['multiplier']*1.5;			
			}	
	elseif ($z_num == 7 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-5;				
			$_SESSION['size_max'] = $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];		
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_full);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_full);		
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier']*1.5;			
			}
	elseif ($z_num == 8 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-5;				
			$_SESSION['size_max'] = $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_full);		
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier']*1.5;			
			}
	elseif ($z_num == 9 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-5;				
			$_SESSION['size_max'] = $_SESSION['size_max']-5;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_full);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_full);		
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier']*1.5;			
			}	
	elseif ($z_num == 98 ) {
					//up
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];		
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}
	elseif ($z_num == 97 ) {
					//left
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);
			$_SESSION['vertical_min'] = $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}
	elseif ($z_num == 96 ) {
					//right
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/$zoom_in_half);
			$_SESSION['vertical_min'] = $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}
	elseif ($z_num == 95 ) {
					//down
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];		
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/$zoom_in_half);		
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}	
	//select a different map
					//map of physics
		elseif ($z_num == 81 ) {
					$_SESSION['views']=1;
					$_SESSION['size_min'] = 0;
					$_SESSION['size_max'] = 100;
					$_SESSION['horizontal_min'] = -1000;
					$_SESSION['horizontal_max'] = 1000;
					$_SESSION['vertical_min'] = -1000;
					$_SESSION['vertical_max'] = 1000;
					$_SESSION['multiplier'] = 0.1;
					$_SESSION['map_select'] = 'Physics';}
				//map of bike parts
		elseif ($z_num == 82 ) {
					$_SESSION['views']=1;
					$_SESSION['size_min'] = 0;
					$_SESSION['size_max'] = 100;
					$_SESSION['horizontal_min'] = -1000;
					$_SESSION['horizontal_max'] = 1000;
					$_SESSION['vertical_min'] = -1000;
					$_SESSION['vertical_max'] = 1000;
					$_SESSION['multiplier'] = 0.1;
					$_SESSION['map_select'] = 'Bike_Parts';}
		
						
	//if user has clicked on a node then centre map on it
	elseif ($z_num > 100) {
		//pull coordinates for the selected node
		//mysql_select_db($database_physixjuly, $physixjuly);
		$query_getnode = "SELECT size, link1, x_position, y_position, linked_x, linked_y, order_id
		 FROM $map_select
		 where order_id = '$z_num' 
		 ";
		$getnode = mysqli_query($physixjuly, $query_getnode);
		printf("Select returned %d rows.\n", $getnode->num_rows);
		$row_getnode = mysqli_fetch_assoc($getnode);
		$totalRows_getnode = mysqli_num_rows($getnode);
	
			$_SESSION['multiplier'] = 200 / $row_getnode['size'];	
			$_SESSION['size_min'] = $row_getnode['size']-200;					
			$_SESSION['size_max'] = $row_getnode['size']+30; 					
			$_SESSION['horizontal_min'] = $row_getnode['x_position']-(1000*pow(0.9,$_SESSION['multiplier']));
			$_SESSION['horizontal_max'] = $row_getnode['x_position']+(1000*pow(0.9,$_SESSION['multiplier']));	
			$_SESSION['vertical_min'] 	= $row_getnode['y_position']-(1000*pow(0.9,$_SESSION['multiplier']));		
			$_SESSION['vertical_max'] 	= $row_getnode['y_position']+(1000*pow(0.9,$_SESSION['multiplier']));	
	
	}}
	else {
		//pull coordinates for the selected node character string
		//mysql_select_db($database_physixjuly, $physixjuly);
		$query_getnode = "SELECT title, size, link1, x_position, y_position, linked_x, linked_y, order_id
		 FROM $map_select
		 where title = '$z_num' 
		 ";
		$getnode = mysqli_query($physixjuly, $query_getnode);
		printf("Select returned %d rows.\n", $getnode->num_rows);

		$row_getnode = mysqli_fetch_assoc($getnode);
		$totalRows_getnode = mysqli_num_rows($getnode);
		
			$_SESSION['multiplier'] = 200 / $row_getnode['size'];	
			$_SESSION['size_min'] = $row_getnode['size']-200;					
			$_SESSION['size_max'] = $row_getnode['size']+30; 			
			$_SESSION['horizontal_min'] = $row_getnode['x_position']-(1000*pow(0.9,$_SESSION['multiplier']));
			//(((($row_getexperiment['x_position'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)
			// 200/size = 1.5^ number of times click to reach 200 px
			//each click is 10% off starting = 0.9 ^ number of clicks
			//200/size=1.5^x = 0.9^x = 
			//e.g. 200/20 = 10 = 1.5^2.5...0.9^6 = 0.53
			//e.g.2 200/90 = 2.1 = 1.5^1.8...9.9^1.9 = 0.81
			$_SESSION['horizontal_max'] = $row_getnode['x_position']+(1000*pow(0.9,$_SESSION['multiplier']));	
			$_SESSION['vertical_min'] 	= $row_getnode['y_position']-(1000*pow(0.9,$_SESSION['multiplier']));		
			$_SESSION['vertical_max'] 	= $row_getnode['y_position']+(1000*pow(0.9,$_SESSION['multiplier']));	
		
			
			//$_SESSION['horizontal_min'] = $row_getnode['x_position']-500;
			//(((($row_getexperiment['x_position'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)
			//(size/200)/1.5 = number of times click to reach 200 px
			//each click is 10% off starting = 0.9 ^ number of clicks
			//$_SESSION['horizontal_max'] = $row_getnode['x_position']+500;	
			//$_SESSION['vertical_min'] 	= $row_getnode['y_position']-200;		
			//$_SESSION['vertical_max'] 	= $row_getnode['y_position']+550;	
		
	}
	//set php variables from session variables
			$size_min =  $_SESSION['size_min'];
			$size_max =  $_SESSION['size_max'];
			$horizontal_min =  $_SESSION['horizontal_min'];
			$horizontal_max =  $_SESSION['horizontal_max'];
			$vertical_min =  $_SESSION['vertical_min'];
			$vertical_max =  $_SESSION['vertical_max'];
			$multiplier =  $_SESSION['multiplier'];	
			$map_select = $_SESSION['map_select'];
	
	
	
	
	//mysql_select_db($database_physixjuly, $physixjuly);
	$query_getexperiment = "SELECT title, text, size, image, x_position, y_position, linked_x, linked_y, order_id
		 FROM sheet1
		 where size >= '$size_min' 
		 and size <= '$size_max'
		 and x_position <= '$horizontal_max'
		 and x_position >= '$horizontal_min'
		 and y_position <= '$vertical_max'
		 and y_position >= '$vertical_min'
		 ";
	$getexperiment = mysqli_query($physixjuly, $query_getexperiment);
		printf("Select returned %d rows.\n", $getexperiment->num_rows);

	$row_getexperiment = mysqli_fetch_assoc($getexperiment);
	$totalRows_getexperiment = mysqli_num_rows($getexperiment);
 ?>
 <div class="node1" style = "
width:150px;
position:fixed;
left:1100px;
top:550px;
z-index:200">
<p style="font-size:10px"> <?php echo "mult:",$multiplier
		 ,"min:",$size_min," max:",$size_max
		 ," hmax:",$horizontal_max
		 ," hmin:",$horizontal_min
		 ," vmax:",$vertical_max
		 ," vmin:",$vertical_min ?></p>

</div>
<div class="node1" style = "
width:50px;
position:absolute;
left:<?php echo (((-25-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px";  ?>;
top:<?php echo (((-25-$vertical_min)/($vertical_max - $vertical_min))*750)."px"; ?>;
z-index:10">
<p style="font-size:10px"> <?php echo $map_select; ?></p>

</div>

	<?php do { ?>
<!-- whole node-->
<!--at multiplier 0.1 the node should be 100 px wide for a node size 200, 0.1*200 * x = 100-->
<div class="node1" onclick ="replace_content('<?php echo $row_getexperiment['order_id']; ?>')"
	style="overflow:hidden;
	width:<?php echo min(max(($row_getexperiment['size']*$multiplier*10),10),150)."px"; ?>;
	height:<?php echo min(max(($row_getexperiment['size']*$multiplier*15),0),200)."px"; ?>;	
	position:absolute;
	left:<?php echo (((($row_getexperiment['x_position'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px"; ?>;
	top:<?php echo (((($row_getexperiment['y_position'])-$vertical_min)/($vertical_max - $vertical_min))*750)."px"; ?>; 
	z-index:100"
>

<!-- header-->
<div class="node-header" style = "text-align:center;background:#5EBA41;overflow:hidden;">
<!-- image-->
<div class= "img-wrap" style = "float:left;margin-top:2px;margin-bottom:0px;margin-left:4px;
	width:<?php echo min(max(($row_getexperiment['size']*$multiplier*7),10),150)."px"; ?>;
">
	<p style="text-align:center;z-index:-1"><img id="myimage" 
	src=<?php echo "../Images/".$row_getexperiment['image'];?> 
	width=98% alt=<?php echo "../Images/".$row_getexperiment['image'];?> 
	longdesc=<?php echo "../Images/".$row_getexperiment['image'];?> />  
	</p> 


	<!-- title-->
	<p class="node-title" style="float:left;margin-top:2px;margin-bottom:0px;
	width:<?php echo min(max(($row_getexperiment['size']*$multiplier*7),9),150)."px"; ?>;
	font-size:<?php echo min(max(($row_getexperiment['size']*$multiplier),4),14)."px"; ?>"><?php echo $row_getexperiment['title']; ?></p>
	</div>
</div>	


<!-- text-->
<div class = "text-wrap1" style = "float:left;margin-top:2px;margin-left:4px;z-index:-1;
	width:<?php echo min(max(($row_getexperiment['size']*$multiplier*7),10),150)."px"; ?>;
	font-size:<?php echo min(max(($row_getexperiment['size']*$multiplier),0),8)."px"; ?>;
	height:<?php echo min(max(($row_getexperiment['size']*$multiplier),0),50)."px"; ?>;
	overflow:hidden;
">
	<p><?php echo $row_getexperiment['text']; ?></p> 
</div>
<!-- vote-->
<div class="vote-wrap" style="float:top;	width:<?php echo max(($row_getexperiment['size']/6*$multiplier),20)."px"; ?>;">
	<div class="arrow-upvote" 
		style="float:left;
		width: 0; height: 0; 
		border-left: <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid transparent; 
		border-right: <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid transparent;  
		border-bottom:<?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid #43A621;
		font-size:<?php echo ($row_getexperiment['size']*$multiplier/200)."px"; ?>; "
		>
		Upvote
	</div>
	<p style="float:left;font-size:<?php echo ($row_getexperiment['size']*$multiplier / 100)."px"; ?>"> ------------------</p>

	<div class="arrow-dvote" 
		style="float:left;
		width: 0; height: 0; 
		border-left:  <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid transparent; 
		border-right: <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid transparent; 
		border-top:   <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid #43A621;
		font-size:<?php echo ($row_getexperiment['size']*$multiplier / 200)."px"; ?>">
		Downvote
	</div>
</div>


</div>

<?php } while ($row_getexperiment = mysqli_fetch_assoc($getexperiment)); ?>

	
		<?php 	require('zoom_buttons_v3001.php'); ?>
<?php 	mysqli_data_seek( $getexperiment, 0 ); ?>
 
<svg height="750" width="1000" style="float:left;pointer-events:none;">
	<style>
		rect:hover {
			fill:#eee;
		}
	</style>
	<?php do { ?>	  
		<line stroke-dasharray="5, 1"
		  x1="<?php echo (((($row_getexperiment['x_position'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px";?>"
		  y1="<?php echo (((($row_getexperiment['y_position'])-$vertical_min)/($vertical_max - $vertical_min))*750)."px";?>"
			x2="<?php echo (((($row_getexperiment['linked_x'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px";?>"
			y2="<?php echo (((($row_getexperiment['linked_y'])-$vertical_min)/($vertical_max - $vertical_min))*750)."px";?>"
		   style="stroke:rgb(200,200,200);stroke-width:0.5;" />
<?php } while ($row_getexperiment = mysqli_fetch_assoc($getexperiment));
 ?>
	
</svg>  



