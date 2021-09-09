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
if ($mysqli->query("drop table IF EXISTS sheet2, sheet3, sheet4, upvote_x, sheet5, lag2_link_count, sheet6, depth_count, linked_values,
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
left join relative_locations as deep1 on node.link1 = deep1.title
left join relative_locations as deep2 on deep1.link1 = deep2.title
left join relative_locations as deep3 on deep2.link1 = deep3.title
left join relative_locations as deep4 on deep3.link1 = deep4.title

") === TRUE) {
    printf("<BR> depth count complete.\n");
}
else echo("depth count Statement failed: ". $mysqli->error . "<br>");

 
// level 2 nodes
$i = 2;
do {
	
	$stmt = $mysqli->prepare("

	create table level_?_nodes as select
		node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Text, node.size, node.depth

		,case when parent_node.x_position > 0 then  (parent_node.x_position + (node.relative_x_position))
				when parent_node.x_position <= 0 then (parent_node.x_position - (node.relative_x_position))
				else null end as x_position
		,case when parent_node.y_position > 0 then (parent_node.y_position + (node.relative_y_position))
					  when parent_node.y_position <= 0 then (parent_node.y_position - (node.relative_y_position))
				else null end as y_position


		(select	 title ,unique_ID ,image ,link1 ,link2  ,Text, size, depth, relative_x_position, relative_y_position from depth_count where depth = ?) as node	
	left join
		(select	 title ,unique_ID ,image ,link1 ,link2 ,Text, size, depth, x_position, y_position from depth_count where depth = (?-1)) as parent_node	
	on
		node.link1 = parent_node.title

	") or trigger_error($mysqli->error, E_USER_ERROR);
	$stmt->bind_param("iii", $i, $i, $i);
	$stmt->execute() or trigger_error($statement->error, E_USER_ERROR);

	{echo "<BR> depth level {$i} complete.\n";}

	$i= $i+1;
} while ($i < 5);

 

if ($mysqli->query("drop table IF EXISTS $map_select ") === TRUE) {printf("$map_select  dropped.\n");}

 //rename variables
if ($mysqli->query("
drop table IF EXISTS physics;
create table physics as select
	title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size

from
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from depth_count where depth in (0,1)) level_1_nodes
union all
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from level_2_nodes
union all
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from level_3_nodes
union all
	select title ,unique_ID ,image ,link1, link2 ,Text ,depth ,x_position ,y_position ,size from level_4_nodes;

  ") === TRUE) {printf("<BR> output created successfully.\n");}
else echo("output Statement failed: ". $mysqli->error . "<br>");
 


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

