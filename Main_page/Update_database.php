<?php

$hostname_physixjuly = "localhost";
$database_physixjuly = "test";
$username_physixjuly = "phptestuser";
$password_physixjuly = "";

$map_select = 'physics';
$mysqli = new mysqli($hostname_physixjuly, $username_physixjuly , $password_physixjuly, $database_physixjuly);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); 
}

/*drop sheets*/
if ($mysqli->query("drop table IF EXISTS sheet2, sheet3, sheet4, upvote_x") === TRUE) {printf("upvote_x dropped.\n");}
if ($mysqli->query("drop table IF EXISTS sheet5, lag2_link_count, sheet6, depth_count, linked_values, output") === TRUE) {printf("output dropped.\n");}
if ($mysqli->query("drop table IF EXISTS calibrate_0, calibrate_1, calibrate_2, calibrate_3, calibrate_4, calibrate_5") === TRUE) {printf("calibrate_5 dropped.\n");}


/*create sheet 2 and order by size*/
if ($mysqli->query("create table IF NOT EXISTS physics as select * from sheet1 order by size") === TRUE) {
    printf("main table created and ordered.\n");
}

echo("<BR><BR> start code");


/*work out how many child nodes a parent node has and give them an order*/
/*merge sorted data with location values*/


if ($mysqli->query("create table relative_locations as 
select
	a.title ,a.size ,a.unique_ID ,a.image ,a.link1 ,a.link2 ,a.field ,a.Type ,a.Text

,case when a.Type = 'Field' then b.x_position
		when a.link1 is not null then b.x_link_pos * 2
		else b.x_position * 2 end as relative_x_position 
,case when a.Type = 'Field' then b.y_position
		when a.link1 is not null then b.y_link_pos * 2
		else b.y_position * 2 end as relative_y_position
	
from 
	physics a

left join 
	(SELECT  
		title
		,link1
		,ROW_NUMBER() OVER(PARTITION BY link1 order by size descending) AS child_node_order
	from 
		physics) child_nodes
on 
	a.title = child_nodes.title

left join 
	location_values_v2 as b
on 
	a.child_node_order = b.order_id

 ") === TRUE) {printf("sorted data merged with location values.\n");}
else echo("failed to merge with location values: ". $mysqli->error . "<br>");

 
 
 //identify depth of node and calculate level 0 and 1 node locations
 
 if ($mysqli->query("

create table depth_count as select
	node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, relative_x_position, relative_y_position

	case 
		when node.link1 is null then 1
		when deep1.title is null then 2
		when deep2.title is null then 3
		when deep3.title is null then 4
		when deep4.title is null then 5
		else NULL end as depth


	,case 
		when node.link1 is null then 1000
		when deep1.title is null then 800
		when deep2.title is null then 600
		when deep3.title is null then 400
		when deep4.title is null then 200
	else NULL end as size

	,case when node.link1 is null then node.relative_x_position	else null end as x_position
	,case when node.link1 is null then node.relative_y_position else null end as y_position

	 
from 
	relative_locations as node
left join relative_locations as deep1 on node.link1 = deep1.title
left join relative_locations as deep2 on deep1.link1 = deep2.tite
left join relative_locations as deep3 on deep2.link1 = deep3.tite
left join relative_locations as deep4 on deep3.link1 = deep4.tite

") === TRUE) {
    printf("<BR> depth count complete.\n");
}
else echo("depth count Statement failed: ". $mysqli->error . "<br>");

 
// level 2 nodes


if ($mysqli->query("

create table level_2_nodes as select
	node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth

	,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
			when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
			else null end as x_position
	,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
				  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
			else null end as y_position


	(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = 2) as node	
left join
	(select	 title ,unique_ID ,image ,link1 ,link2 ,Text, size, depth, x_position, y_position	from depth_count where depth = 1) as parent_node	
on
	node.link1 = parent_node.title

") === TRUE) {
    printf("<BR> depth level 2 complete.\n");
}
else echo("depth level 2 Statement failed: ". $mysqli->error . "<br>");

 

 // level 3 nodes


if ($mysqli->query("

create table level_3_nodes as select
	node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth
	,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
			when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
			else null end as x_position
	,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
				  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
			else null end as y_position


	(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = 3) as node	
left join
	(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, x_position, y_position	from depth_count where depth = 2) as parent_node	
on
	node.link1 = parent_node.title

") === TRUE) {
    printf("<BR> depth level 3 complete.\n");
}
else echo("depth level 3 Statement failed: ". $mysqli->error . "<br>");


 // level 4 nodes
if ($mysqli->query("

create table level_4_nodes as select
	node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth
	,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
			when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
			else null end as x_position
	,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
				  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
			else null end as y_position


	(select	title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = 4) as node	
left join
	(select	title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, x_position, y_position	from depth_count where depth = 3) as parent_node	
on
	node.link1 = parent_node.title

") === TRUE) {
    printf("<BR> depth level 4 complete.\n");
}
else echo("depth level 4 Statement failed: ". $mysqli->error . "<br>");



 //rename variables
if ($mysqli->query("create table output as select
title 
,unique_ID 
,image 
,link1
,link2 
,Text

,depth
,x_position as original_x
,y_position as original_y
,size as original_size
,calibrated_x_position as x_position
,calibrated_y_position as y_position
,calibrated_size as size
,linked_x
,linked_y

from
	(select * from depth_count where depth in (0,1)) level_1_nodes
union all
	level_2_nodes
union all
	level_3_nodes
union all
	level_4_nodes

  ") === TRUE) {printf("<BR> output created successfully.\n");}
else echo("output Statement failed: ". $mysqli->error . "<br>");
 
 
 //create backup
  
if ($mysqli->query("create table backup1 as select * from $map_select ") === TRUE) {printf("<BR><BR>$map_select  backed up.\n");}
/*drop sheet1*/
if ($mysqli->query("drop table IF EXISTS $map_select ") === TRUE) {printf("$map_select  dropped.\n");}

/*create sheet1 from sheet4*/
if ($mysqli->query("create table $map_select as select * 
,floor(size/10) as size_v1
from output
order by order_id") === TRUE) {
    printf("$map_select created and ordered.\n");
}

if ($mysqli->query("ALTER TABLE $map_select ADD UNIQUE (order_id)
") === TRUE) {
    printf("order id set to unique.\n");
}
if ($mysqli->query("

	ALTER TABLE physics CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

") === TRUE) {
    printf("physics set to utf8.\n");
}

if ($mysqli->query("drop table IF EXISTS check_xml ") === TRUE) {printf("check_xml  dropped.\n");}

if ($mysqli->query("
create table check_xml as select title from physics 
/* where title = 'Black Holes' */
/* or title = 'Doppler effect' */
order by title
") === TRUE) {
    printf("<br> check_xml created.\n");
}

/* close connection */

$mysqli->close();

//create an xml document to allow pop up searching
 $mysqli_2 = mysql_connect($hostname_physixjuly, $username_physixjuly , $password_physixjuly);
 if (!$mysqli_2) {
        die('Could not connect to mysqli_2: ' . mysql_error());
    }
    //Select the Database
    mysql_select_db("test",$mysqli_2);
 
    $result = mysql_query("select title from check_xml", $mysqli_2);  
 
    //Create SimpleXMLElement object
    $xml = new SimpleXMLElement('<xml/>');
 
    //Add each column value a node of the XML object
    while($row = mysql_fetch_assoc($result)) {
        $mydata = $xml->addChild('mydata');
        $mydata->addChild('title',$row['title']);
			}
 
    mysql_close($mysqli_2);
    //Create the XML file
    $fp = fopen("search_list_$map_select.xml","wb");
 
    //Write the XML nodes
    fwrite($fp,$xml->asXML());
 
    //Close the database connection
    fclose($fp);
 

?>

