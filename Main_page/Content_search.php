
<?php
session_start();
if(isset($_SESSION['size_min']))
$_SESSION['size_min']=$_SESSION['size_min'];
else $_SESSION['size_min']=0;

if(isset($_SESSION['size_max']))
$_SESSION['size_max']=$_SESSION['size_max'];
else $_SESSION['size_max'] = 600;

if(isset($_SESSION['horizontal_min']))
$_SESSION['horizontal_min']=$_SESSION['horizontal_min'];
else $_SESSION['horizontal_min'] = -375;

if(isset($_SESSION['horizontal_max']))
$_SESSION['horizontal_max']=$_SESSION['horizontal_max'];
else $_SESSION['horizontal_max'] = 375;

if(isset($_SESSION['vertical_min']))
$_SESSION['vertical_min']=$_SESSION['vertical_min'];
else $_SESSION['vertical_min'] = -375;

if(isset($_SESSION['vertical_max']))
$_SESSION['vertical_max']=$_SESSION['vertical_max'];
else $_SESSION['vertical_max'] = 375;

if(isset($_SESSION['multiplier']))
$_SESSION['multiplier']=$_SESSION['multiplier'];
else $_SESSION['multiplier'] = 1;

 ?>
	<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_physixjuly = "localhost";
$database_physixjuly = "test";
$username_physixjuly = "phptestuser";
$password_physixjuly = "blib";
$physixjuly = mysql_pconnect($hostname_physixjuly, "root") or trigger_error(mysql_error(),E_USER_ERROR); 
?>
 <?php
		$z_num =  intval($_GET['q']);
		if ($z_num == 99 ) {
			$_SESSION['size_min'] 		= $_SESSION['size_min'];	
			$_SESSION['size_max'] 		= $_SESSION['size_max']+100;	
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/20)	;	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/20)	;
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/20)	;
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/20)	;	
			$_SESSION['multiplier']		= $_SESSION['multiplier']/2;			
			}
		elseif ($z_num == 1 ) {
			$_SESSION['size_min'] 		= $_SESSION['size_min']-100;			
			$_SESSION['size_max'] 		= $_SESSION['size_max']-100;		
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/11);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'];		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/11)	;	
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*2;	
			}
		elseif ($z_num == 2 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-100;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/11);		
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*2;			
			}
	elseif ($z_num == 3 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-100;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/11);	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/11);		
			$_SESSION['multiplier']		= $_SESSION['multiplier']*2;			
			}
	elseif ($z_num == 4 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-100;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];	 	
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/11);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*2;			
			}			
	elseif ($z_num == 5 ) {
					
			$_SESSION['size_min'] 		= $_SESSION['size_min']-100;				
			$_SESSION['size_max'] 		= $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['multiplier'] 	= $_SESSION['multiplier']*2;			
			}				
	elseif ($z_num == 6 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-100;				
			$_SESSION['size_max'] = $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/11);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['multiplier'] = $_SESSION['multiplier']*2;			
			}	
	elseif ($z_num == 7 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-100;				
			$_SESSION['size_max'] = $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];		
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/11);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/11);		
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier']*2;			
			}
	elseif ($z_num == 8 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-100;				
			$_SESSION['size_max'] = $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);	
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/11);		
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier']*2;			
			}
	elseif ($z_num == 9 ) {
					
			$_SESSION['size_min'] = $_SESSION['size_min']-100;				
			$_SESSION['size_max'] = $_SESSION['size_max']-100;				
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/11);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/11);		
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier']*2;			
			}	
	elseif ($z_num == 98 ) {
					//up
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'];		
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'];		
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] - (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}
	elseif ($z_num == 97 ) {
					//left
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] - (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);
			$_SESSION['vertical_min'] = $_SESSION['vertical_min'];			
			$_SESSION['vertical_max'] = $_SESSION['vertical_max'];			
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}
	elseif ($z_num == 96 ) {
					//right
			$_SESSION['size_min'] = $_SESSION['size_min'];					
			$_SESSION['size_max'] = $_SESSION['size_max'];					
			$_SESSION['horizontal_min'] = $_SESSION['horizontal_min'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);
			$_SESSION['horizontal_max'] = $_SESSION['horizontal_max'] + (($_SESSION['horizontal_max']-$_SESSION['horizontal_min'])/22);
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
			$_SESSION['vertical_min'] 	= $_SESSION['vertical_min'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['vertical_max'] 	= $_SESSION['vertical_max'] + (($_SESSION['vertical_max']-$_SESSION['vertical_min'])/22);		
			$_SESSION['multiplier'] = $_SESSION['multiplier'];				
			}			
	
	//set php variables from session variables
			$size_min =  $_SESSION['size_min'];
			$size_max =  $_SESSION['size_max'];
			$horizontal_min =  $_SESSION['horizontal_min'];
			$horizontal_max =  $_SESSION['horizontal_max'];
			$vertical_min =  $_SESSION['vertical_min'];
			$vertical_max =  $_SESSION['vertical_max'];
			$multiplier =  $_SESSION['multiplier'];	
	
	
	
	
	mysql_select_db($database_physixjuly, $physixjuly);
	$query_getexperiment = "SELECT title, text, size, image, x_position, y_position, linked_x, linked_y
		 FROM sheet1
		 where size >= '$size_min' 
		 and size <= '$size_max'
		 and x_position <= '$horizontal_max'
		 and x_position >= '$horizontal_min'
		 and y_position <= '$vertical_max'
		 and y_position >= '$vertical_min'
		 ";
	$getexperiment = mysql_query($query_getexperiment, $physixjuly) or die(mysql_error());
	$row_getexperiment = mysql_fetch_assoc($getexperiment);
	$totalRows_getexperiment = mysql_num_rows($getexperiment);
 ?>
 
<div id="node1" style = "
width:<?php echo (200*$multiplier)."px";  ?>;
position:absolute;
left:<?php echo (((350-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px";  ?>;
top:<?php echo (((350-$vertical_min)/($vertical_max - $vertical_min))*750)."px"; ?>;
z-index:10">
<p style="font-size:<?php echo (20*$multiplier)."px"; ?>"> PHYSICS </p>
<p style="text-align:center;z-index:-1"><img id="myimage" 
src="images/Two_skaters.jpg"
width=105% alt="images/Two_skaters.jpg"
longdesc="images/Two_skaters.jpg">
</p> 

</div>

	<?php do { ?>
<div id="node1" style="
width:<?php echo ($row_getexperiment['size']/8*$multiplier)."px"; ?>;
position:absolute;
left:<?php echo (((($row_getexperiment['x_position'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px"; ?>;
top:<?php echo (((($row_getexperiment['y_position'])-$vertical_min)/($vertical_max - $vertical_min))*750)."px"; ?>;
z-index:10"
>
<p style="font-size:<?php echo ($row_getexperiment['size']*$multiplier / (70))."px"; ?>"><?php echo $row_getexperiment['title']; ?></p>
<p style="text-align:center;z-index:-1"><img id="myimage" 
src=<?php echo "images/".$row_getexperiment['image'];?> 
width=105% alt=<?php echo "images/".$row_getexperiment['image'];?> 
longdesc=<?php echo "images/".$row_getexperiment['image'];?> />  
</p> 
<p style="font-size:<?php echo ($row_getexperiment['size']*$multiplier / 120)."px"; ?>"><?php echo $row_getexperiment['text']; ?></p> 



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

<div class="arrow-downvote" 
	style="float:left;
	width: 0; height: 0; 
	border-left:  <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid transparent; 
	border-right: <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid transparent; 
	border-top:   <?php echo ($row_getexperiment['size']*$multiplier/100)."px"; ?> solid #43A621;
	font-size:<?php echo ($row_getexperiment['size']*$multiplier / 200)."px"; ?>">
	Downvote
</div>



</div>

<?php } while ($row_getexperiment = mysql_fetch_assoc($getexperiment)); ?>

	
		<?php 	require('zoom_buttons_v3001.php'); ?>
<?php 	mysql_data_seek( $getexperiment, 0 ); ?>
 
<svg height="750" width="1000" style="float:left;pointer-events:none">
	<style>
		rect:hover {
			fill:#eee;
		}
	</style>
	<?php do { ?>	  
		<line 
		  x1="<?php echo (((($row_getexperiment['x_position'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px";?>"
		  y1="<?php echo (((($row_getexperiment['y_position'])-$vertical_min)/($vertical_max - $vertical_min))*750)."px";?>"
			x2="<?php echo (((($row_getexperiment['linked_x'])-$horizontal_min)/($horizontal_max - $horizontal_min))*1000)."px";?>"
			y2="<?php echo (((($row_getexperiment['linked_y'])-$vertical_min)/($vertical_max - $vertical_min))*750)."px";?>"
		   style="stroke:rgb(200,200,200);stroke-width:2" />
<?php } while ($row_getexperiment = mysql_fetch_assoc($getexperiment));
 ?>
	
</svg>  



