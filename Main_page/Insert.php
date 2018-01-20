

<head>
<meta http-equiv="refresh" content="3;url=physics.php"> 
<title>insert_v1004</title>
</head>

<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['map_select']))
$_SESSION['map_select']=$_SESSION['map_select'];
else $_SESSION['map_select'] = 'Physics';
 ?>

<?php
$hostname_physixjuly = "localhost";
$database_physixjuly = "a2568601_Tom";
$username_physixjuly = "a2568601_Tom";
$password_physixjuly = "Mendoza1";
	$map_select = $_SESSION['map_select'];	
	$physixjuly = mysql_pconnect($hostname_physixjuly, "a2568601_Tom") or trigger_error(mysql_error(),E_USER_ERROR); 

	if(isset($_FILES["name"]))	{$filename =  ($_FILES["name"]).".jpg";}
	else {$filename = "Two_skaters.jpg";}
	mysql_select_db($database_physixjuly) or die ("no database");        
	$sql=
		"INSERT INTO $map_select (Title, Text, Size, Image, Link1)
		VALUES('$_POST[Title]','$_POST[Text]','$_POST[Size]','$filename','$_POST[Link1]')";
	$query=mysql_query($sql) or die(mysql_error());

?> 

<?php
if(isset($_FILES["file"])) {
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 500000)
	&& in_array($extension, $allowedExts)) {
	  if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	  } else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
		if (file_exists("Images/" . $_FILES["file"]["name"])) {
		  echo $_FILES["file"]["name"] . " already exists. ";
		} else {
		  move_uploaded_file($_FILES["file"]["tmp_name"],
		  "Images/" . $_FILES["file"]["name"]);
		  echo "Stored in: " . "Images/" . $_FILES["file"]["name"];
		}
	  }
	}} else {
	  echo "Invalid file";
	}
	;
?> 
			<?php 
			require('update_database.php'); 
			?>

</body>
</html>
