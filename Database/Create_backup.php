<?php
$hostname_physixjuly = "mysql14.000webhost.com";
$database_physixjuly = "a2568601_Physics";
$username_physixjuly = "a2568601_User";
$password_physixjuly = "Mendoza1";
$mysqli = new mysqli($hostname_physixjuly, $username_physixjuly , $password_physixjuly, $database_physixjuly);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

  
if ($mysqli->query("drop table IF EXISTS backup_x") === TRUE) {printf("backup_x dropped.\n");}


 
if ($mysqli->query("create table backup_x as select
*
from backup1
where title is not null
  ") === TRUE) {printf("<BR> output created successfully.\n");}
else echo("output Statement failed: ". $mysqli->error . "<br>");

 

$mysqli->close();


