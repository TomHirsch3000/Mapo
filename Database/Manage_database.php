<?php
$hostname_physixjuly = "localhost";
$database_physixjuly = "test";
$username_physixjuly = "Tom";
$password_physixjuly = "blib";
$mysqli = new mysqli($hostname_physixjuly, $username_physixjuly , $password_physixjuly, $database_physixjuly);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// if ($mysqli->query("create table Bike_Parts
// (order_id int NOT NULL AUTO_INCREMENT
// ,title varchar(100)
// ,size int(3)
// ,unique_ID int(1)
// ,image varchar(67)
// ,link1 varchar(26)
// ,link2 varchar(26)
// ,link3 varchar(26)
// ,Text varchar(10000)
// ,x_position int(2)
// ,y_position int(2)
// ,primary key (order_id)
// )AUTO_INCREMENT = 101
// ") === TRUE) {
    // printf("Bike_Parts created blank.\n");}

  
if ($mysqli->query("drop table IF EXISTS physics") === TRUE) {printf("physics dropped.\n");}

/*merge sorted data with location values*/
// if ($mysqli->query("create table location_values_v3 as select
// (order_id+100) as order_id
// ,x_position
// ,y_position
// ,x_link_pos
// ,y_link_pos

// from 
 // location_values_v2 
 // ") === TRUE) {printf("done.\n");}
 
 
 //rename variables

 
if ($mysqli->query("create table physics as select
*
from backup_xi
where title is not null
  ") === TRUE) {printf("<BR> output created successfully.\n");}
else echo("output Statement failed: ". $mysqli->error . "<br>");

 
// if ($mysqli->query("create table physics as select
// order_id 
// ,title 
// ,unique_ID 
// ,image 

// ,link1
// ,link2 
// ,field
// ,type 

// ,Text
// ,x_position
// ,y_position
// ,case when size is null then FLOOR(RAND() * 401) + 100 else size end as size
// ,linked_x
// ,linked_y
// ,size_v1
// from backup_x
// where title is not null
  // ") === TRUE) {printf("<BR> output created successfully.\n");}
// else echo("output Statement failed: ". $mysqli->error . "<br>");

// if ($mysqli->query("

	// ALTER TABLE physics CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

// ") === TRUE) {
    // printf("physics set to utf8.\n");
// }

$mysqli->close();


