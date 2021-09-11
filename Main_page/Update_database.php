<?php

$hostname_physixjuly = "localhost";
$database_physixjuly = "test";
$username_physixjuly = "root";
$password_physixjuly = "";

$map_select = 'physics';
$mysqli = new mysqli($hostname_physixjuly, $username_physixjuly , $password_physixjuly, $database_physixjuly);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); 
}

/*drop sheets*/
if ($mysqli->query("drop table IF EXISTS physics, relative_locations, sheet2, sheet3, sheet4, upvote_x, sheet5, lag2_link_count, sheet6, depth_count, linked_values,
 output, calibrate_0, calibrate_1, calibrate_2, calibrate_3, calibrate_4, calibrate_5") === TRUE) {printf("dropped tables.\n");}


/*create sheet 2 and order by size*/
if ($mysqli->query("create table IF NOT EXISTS physics as select * from sheet1 order by size") === TRUE) {
    printf("main table created and ordered.\n");
}

echo("<BR><BR> start code\n");


/*merge sorted data with location values*/
/*work out how many child nodes a parent node has and give them an order*/



if ($mysqli->query("create table relative_locations as 
select
	a.title ,a.size ,a.unique_ID ,a.image ,a.link1 ,a.link2 ,a.Text

,case when a.link1 is not null then b.x_link_pos
		else b.x_position end as relative_x_position 
,case when a.link1 is not null then b.y_link_pos
		else b.y_position end as relative_y_position
	
from 
	physics a

left join 
	(SELECT  
		title
		,link1
		,ROW_NUMBER() OVER(PARTITION BY link1 order by size desc) as child_node_order
	from 
		physics) child_nodes
on 
	a.title = child_nodes.title

left join 
	location_values_v2 as b
on 
	child_nodes.child_node_order = b.order_id

 ") === TRUE) {printf("<BR>sorted data merged with location values.\n");}
else echo("<BR>failed to merge with location values: ". $mysqli->error . "<br>");

 
 
 //identify depth of node and calculate level 0 and 1 node locations
 
 if ($mysqli->query("

create table depth_count as select
	node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.relative_x_position, node.relative_y_position

	,case 
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
left join relative_locations as deep1 on node.link1 = deep1.title and node.title != deep1.link1
left join relative_locations as deep2 on deep1.link1 = deep2.title and deep1.title != deep2.link1
left join relative_locations as deep3 on deep2.link1 = deep3.title and deep2.title != deep3.link1
left join relative_locations as deep4 on deep3.link1 = deep4.title and deep3.title != deep4.link1


") === TRUE) {
    printf("<BR> depth count complete.\n");
}
else echo("depth count Statement failed: ". $mysqli->error . "<br>");

 
// level 2 nodes
/*drop sheets*/
if ($mysqli->query("drop table IF EXISTS level_2_nodes, level_3_nodes, level_4_nodes") === TRUE) {printf("dropped tables.\n");}


if ($mysqli->query("
	create table level_2_nodes as select
		node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth

		,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
				when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
				else null end as x_position
		,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
					  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
				else null end as y_position

	from
		(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = 2) as node	
	left join
		(select	 title ,unique_ID ,image ,link1 ,link2 ,Text, size, depth, x_position, y_position from depth_count where depth = (1)) as parent_node	
	on
		node.link1 = parent_node.title
") === TRUE) {
    printf("<BR> depth 2 complete.\n");
}
else echo("depth 2 Statement failed: ". $mysqli->error . "<br>");

if ($mysqli->query("
	create table level_3_nodes as select
		node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth

		,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
				when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
				else null end as x_position
		,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
					  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
				else null end as y_position

	from
		(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = 3) as node	
	left join
		(select	 title ,unique_ID ,image ,link1 ,link2 ,Text, size, depth, x_position, y_position from depth_count where depth = (2)) as parent_node	
	on
		node.link1 = parent_node.title
") === TRUE) {
    printf("<BR> depth 3 complete.\n");
}
else echo("depth 3 Statement failed: ". $mysqli->error . "<br>");

if ($mysqli->query("
	create table level_4_nodes as select
		node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth

		,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
				when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
				else null end as x_position
		,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
					  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
				else null end as y_position

	from
		(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = 4) as node	
	left join
		(select	 title ,unique_ID ,image ,link1 ,link2 ,Text, size, depth, x_position, y_position from depth_count where depth = (4)) as parent_node	
	on
		node.link1 = parent_node.title
") === TRUE) {
    printf("<BR> depth 4 complete.\n");
}
else echo("depth 4 Statement failed: ". $mysqli->error . "<br>");


if ($mysqli->query("drop table IF EXISTS physics, staging") === TRUE) {printf("physics  dropped.\n");}

 //rename variables
if ($mysqli->query("
create table staging as

	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from depth_count where depth in (0,1)
union all
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from level_2_nodes
union all
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from level_3_nodes
union all
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from level_4_nodes;

  ") === TRUE) {printf("<BR> output created successfully.\n");}
else echo("output Statement failed: ". $mysqli->error . "<br>");
 
 //rename variables
if ($mysqli->query("
create table physics as select
main.title ,main.unique_ID ,main.image ,main.link1, main.link2 ,main.Text ,main.depth ,main.x_position ,main.y_position ,main.size,
  case when link.x_position is NULL then 0 else link.x_position end as linked_x,
  case when link.y_position is NULL then 0 else link.y_position end as linked_y, 
  ROW_NUMBER() OVER(order by size desc) as order_id

from

staging as main
left join
staging as link
on main.link1 = link.title

  ") === TRUE) {printf("<BR> output created successfully.\n");}
else echo("output Statement failed: ". $mysqli->error . "<br>");
 
if ($mysqli->query("
create table for_search as select * from physics
  ") === TRUE) {printf("<BR> search file created successfully.\n");}
else echo("search Statement failed: ". $mysqli->error . "<br>");
 
if ($mysqli->query("ALTER TABLE physics ADD UNIQUE (order_id)
") === TRUE) {
    printf("order id set to unique.\n");
}
if ($mysqli->query("

	ALTER TABLE for_search CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

") === TRUE) {
    printf("physics set to utf8.\n");
}

if ($mysqli->query("drop table IF EXISTS check_xml ") === TRUE) {printf("check_xml  dropped.\n");}

if ($mysqli->query("
create table check_xml as select title from for_search 
/* where title = 'Black Holes' */
/* or title = 'Doppler effect' */
order by title
") === TRUE) {
    printf("<br> check_xml created.\n");
}



//create an xml document to allow pop up searching


$result = $mysqli->query("select title from check_xml");  
//Create SimpleXMLElement object
$xml = new SimpleXMLElement('<xml/>');

//Add each column value a node of the XML object
while($row = $result -> fetch_row()) {
	printf ("%s\n", $row[0]);

    #$mydata = $xml->addChild('mydata');
    #$mydata->addChild('title',$row['title']);

		}

mysqli_close($mysqli);
//Create the XML file
$fp = fopen("search_list_$map_select.xml","wb");

//Write the XML nodes
fwrite($fp,$xml->asXML());

//Close the database connection
fclose($fp);
 

?>

