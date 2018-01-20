<?php
//verson 3032
//removed size dependancy on positioning
//now nodes are positioned 'outside' linked node 
//removed x_llink_2_pos to ensure all linkes are added positive




//$hostname_physixjuly = "localhost";
//$database_physixjuly = "test";
//$username_physixjuly = "phptestuser";
//$password_physixjuly = "blib";
$hostname_physixjuly = "mysql14.000webhost.com";
$database_physixjuly = "a2568601_Physics";
$username_physixjuly = "a2568601_User";
$password_physixjuly = "Mendoza1";
$map_select = 'physics';
$mysqli = new mysqli($hostname_physixjuly, $username_physixjuly , $password_physixjuly, $database_physixjuly);
//$mysqli = mysql_pconnect($hostname_physixjuly, "root") or trigger_error(mysql_error(),E_USER_ERROR); 

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); 
}

/*drop sheet2*/
if ($mysqli->query("drop table IF EXISTS sheet2") === TRUE) {printf("sheet2 dropped.\n");}
/*drop sheet3*/
if ($mysqli->query("drop table IF EXISTS sheet3") === TRUE) {printf("sheet3 dropped.\n");}
/*drop sheet4*/
if ($mysqli->query("drop table IF EXISTS sheet4") === TRUE) {printf("sheet4 dropped.\n");}
/*drop upvote_x*/
if ($mysqli->query("drop table IF EXISTS upvote_x") === TRUE) {printf("upvote_x dropped.\n");}
/*drop sheet_5*/
if ($mysqli->query("drop table IF EXISTS sheet5") === TRUE) {printf("sheet5 dropped.\n");}
/*drop link_count*/
if ($mysqli->query("drop table IF EXISTS lag2_link_count") === TRUE) {printf("lag2_link_count dropped.\n");}
/*drop sheet_6*/
if ($mysqli->query("drop table IF EXISTS sheet6") === TRUE) {printf("sheet6 dropped.\n");}
/*drop depth count*/
if ($mysqli->query("drop table IF EXISTS depth_count") === TRUE) {printf("depth_count dropped.\n");}
/*drop linked_values */
if ($mysqli->query("drop table IF EXISTS linked_values") === TRUE) {printf("linked_values dropped.\n");}

if ($mysqli->query("drop table IF EXISTS output") === TRUE) {printf("output dropped.\n");}

if ($mysqli->query("drop table IF EXISTS calibrate_0") === TRUE) {printf("calibrate_1 dropped.\n");}
if ($mysqli->query("drop table IF EXISTS calibrate_1") === TRUE) {printf("calibrate_1 dropped.\n");}
if ($mysqli->query("drop table IF EXISTS calibrate_2") === TRUE) {printf("calibrate_2 dropped.\n");}
if ($mysqli->query("drop table IF EXISTS calibrate_3") === TRUE) {printf("calibrate_3 dropped.\n");}
if ($mysqli->query("drop table IF EXISTS calibrate_4") === TRUE) {printf("calibrate_4 dropped.\n");}
if ($mysqli->query("drop table IF EXISTS calibrate_5") === TRUE) {printf("calibrate_5 dropped.\n");}

/*create sheet 2 and order by size*/
if ($mysqli->query("create table sheet2 as select * from $map_select  order by size") === TRUE) {
    printf("sheet2 created and ordered.\n");
}

echo("<BR><BR> start code");

/*work out how many linked nodes a node has and give them an order*/
/*using lag function*/
if ($mysqli->query("
set @quot = 0,@lnk=NULL;
") === TRUE) {
    printf("<br> set variable .\n");
}
else echo(" lag Statement failed: ". $mysqli->error . "<br>");

if ($mysqli->query("
create table lag2_link_count

	SELECT  
		*
		,case when @lnk <> link1 or (@lnk is null and link1 is not null) then @quot:=1 
			else @quot:=@quot+1 end as this_count
		,@quot	as new_count
		,@lnk:=link1 lag_link

from sheet2
order by 
	link1
	,order_id

") === TRUE) {
    printf(" lag function lag2_link_count.\n");
}
else echo(" lag Statement failed: ". $mysqli->error . "<br>");

/*create blank table sheet 3 to allow order id to auto increment when populated*/
if ($mysqli->query("create table sheet3
(order_id int NOT NULL AUTO_INCREMENT
,title varchar(100)
,size int(3)
,unique_ID int(1)
,image varchar(67)
,link1 varchar(100)
,link2 varchar(26)
,Field varchar(100)
,Type varchar(26)
,Text varchar(10000)
,x_position int(2)
,y_position int(2)
,link_count int (2)
,primary key (order_id)
)AUTO_INCREMENT = 101
") === TRUE) {
    printf("sheet3 created blank.\n");
}
/*insert data into sheet 3 from sheet 2*/
if ($mysqli->query("insert into sheet3
(title ,size ,unique_ID ,image ,link1 ,link2 ,Field ,Type ,Text ,x_position ,y_position,link_count )
select
title ,size ,unique_ID ,image ,link1 ,link2 ,Field, Type ,Text ,x_position ,y_position,new_count+100 as link_count
from lag2_link_count") === TRUE) {
    printf("data inserted into sheet3.\n");
}
else echo("<br> failed to load data into sheet 3: ". $mysqli->error . "<br>");



/*merge sorted data with location values*/



if ($mysqli->query("create table sheet4 as select
a.order_id ,a.title ,a.size ,a.unique_ID ,a.image ,a.link1 ,a.link2 ,a.field ,a.Type ,a.Text ,a.link_count

,case when a.Type = 'Field' then b.x_position
		when a.link1 is not null then b.x_link_pos * 2
		else b.x_link_pos * 2 end as x_position 
,case when a.Type = 'Field' then b.y_position
		when a.link1 is not null then b.y_link_pos * 2
		else b.y_link_pos * 2 end as y_position
	
from 
sheet3 as a
	left join location_values_v4 as b
	on a.link_count = b.order_id
order by a.link1, a.link_count
 ") === TRUE) {printf("sorted data merged with location values.\n");}
else echo("failed to merge with location values: ". $mysqli->error . "<br>");

 
 
 //identify depth of node
 
 
 
if ($mysqli->query("
create table depth_count as select
node.order_id ,node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Field ,node.Type ,node.Text, node.size, 
node.x_position, node.y_position, 
node.link_count

	,case when node.link1 is null then 0
		when node.type = 'Field' then 0
	
		when node.link1 in
			(select linked1.title 
				from sheet4 as linked1
					where linked1.link1 is null)
			then 1
				when node.link1 in 
				(select linked1.title 
					from sheet4 as linked1
					right join sheet4 as linked2
						on linked1.link1 = linked2.title
						and linked1.link1 <> linked1.title
						and linked2.link1 is null)		
				then 2
					when node.link1 in 
					(select linked1.title 
						from sheet4 as linked1
						right join sheet4 as linked2
							on linked1.link1 = linked2.title
							and linked1.link1 <> linked1.title
								right join sheet4 as linked3
									on linked2.link1 = linked3.title
									and linked2.link1 <> linked2.title
									and linked3.link1 is null)
				then 3		
					when node.link1 in 
					(select linked1.title 
						from sheet4 as linked1
						right join sheet4 as linked2
							on linked1.link1 = linked2.title
							and linked1.link1 <> linked1.title
								right join sheet4 as linked3
									on linked2.link1 = linked3.title
									and linked2.link1 <> linked2.title
										right join sheet4 as linked4
											on linked3.link1 = linked4.title
											and linked3.link1 <> linked3.title								
											and linked4.link1 is null)
				then 4				
						when node.link1 in 
						(select linked1.title 
							from sheet4 as linked1
							right join sheet4 as linked2
								on linked1.link1 = linked2.title
								and linked1.link1 <> linked1.title
									right join sheet4 as linked3
										on linked2.link1 = linked3.title
										and linked2.link1 <> linked2.title
											right join sheet4 as linked4
												on linked3.link1 = linked4.title
												and linked3.link1 <> linked3.title		
													right join sheet4 as linked5
														on linked4.link1 = linked5.title
														and linked4.link1 <> linked4.title		
														and linked5.link1 is null)
				then 5				
	else 6 end as depth

from 
sheet4 as node

") === TRUE) {
    printf("<BR> depth count complete.\n");
}
else echo("depth count Statement failed: ". $mysqli->error . "<br>");
 
 
 //use node depth to determine which linked value to take as linked node value
 
 if ($mysqli->query("
create table linked_values as select
node.order_id ,node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Field ,node.Type ,node.Text, 
node.size, node.x_position, node.y_position,
node.link_count , node.depth

,case when node.depth = 0 then node.size
		when node.depth = 1 then linked1.size
		when node.depth = 2 then linked2.size
		when node.depth = 3 then linked3.size
		when node.depth = 4 then linked4.size
		when node.depth = 5 then linked5.size
		else node.size end as linked_node_size

,case when node.depth = 0 then node.x_position
		when node.depth = 1 then linked1.x_position
		when node.depth = 2 then linked2.x_position
		when node.depth = 3 then linked3.x_position
		when node.depth = 4 then linked4.x_position
		when node.depth = 5 then linked5.x_position
		else node.x_position end as linked_node_x_position		
		
,case when node.depth = 0 then node.y_position
		when node.depth = 1 then linked1.y_position
		when node.depth = 2 then linked2.y_position
		when node.depth = 3 then linked3.y_position
		when node.depth = 4 then linked4.y_position
		when node.depth = 5 then linked5.y_position
		else node.y_position end as linked_node_y_position	
				
from depth_count as node
left join depth_count as linked1
	on node.link1 = linked1.title
	and node.link1 <> node.title
		left join depth_count as linked2
			on linked1.link1 = linked2.title
			and linked1.link1 <> linked1.title
				left join depth_count as linked3
					on linked2.link1 = linked3.title
					and linked2.link1 <> linked2.title
						left join depth_count as linked4
							on linked3.link1 = linked4.title
							and linked3.link1 <> linked3.title		
								left join depth_count as linked5
									on linked4.link1 = linked5.title
									and linked4.link1 <> linked4.title		

 
 ") === TRUE) {
    printf("<BR> use depth to identify linked node properties complete.\n");
}
else echo("depth link Statement failed: ". $mysqli->error . "<br>");
 
 
 
 
//merge back into self to identify location of linked nodes

if ($mysqli->query("create table calibrate_0 as select
node.order_id ,node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Field ,node.Type ,node.Text, node.link_count, node.depth,
node.size, node.x_position, node.y_position

	,case when node.type = 'Field' then node.size
		when node.depth = 0 then node.size
		else null end as calibrated_size
	
	,case when node.type = 'Field' then node.x_position
		when node.depth = 0 then
			(case when linked.x_position > 0 then  (linked.x_position+(node.x_position))
			when linked.x_position <= 0 then (linked.x_position-(node.x_position))
			else null end)
		else null end as calibrated_x_position
		
	,case when node.type = 'Field' then node.y_position
		when node.depth = 0 then
			(case when linked.y_position > 0 then (linked.y_position+(node.y_position))
			when linked.x_position <= 0 then (linked.y_position-(node.y_position))
			else null end)
		else null end as calibrated_y_position

	,case when node.type = 'Field' then 0 
		when node.depth = 0 then linked.x_position 
		else 0 end as linked_x
	,case when node.type = 'Field' then 0 
		when node.depth = 0 then linked.y_position 
		else 0 end as linked_y	
		
	,case when node.type = 'Field' then 0 else linked.x_position end as Field_x
	,case when node.type = 'Field' then 0 else linked.y_position end as Field_y	
from 
depth_count as node
	left join depth_count as linked
	on node.field = linked.title
	and node.field <> node.title
 ") === TRUE) {printf("<BR> calibrate_0 created successfully .\n");}
else echo("<BR>calibrate_0 Statement failed: ". $mysqli->error . "<br>");
 

 
if ($mysqli->query("create table calibrate_1 as select
node.order_id ,node.title ,node.unique_ID ,node.image ,node.link1 ,node.link2 ,node.Field ,node.Type ,node.Text, node.link_count, node.depth, node.field_x, node.field_y,
node.size, node.x_position, node.y_position

	,case when node.depth = 0 then node.calibrated_size
		when node.type = 'Field' then node.calibrated_size
		when node.depth = 1 then 
			(case when node.size/linked.calibrated_size >0.9 and node.size/linked.calibrated_size <2 then node.size
			else (((node.size/linked.calibrated_size)/10) + (0.9*linked.calibrated_size))
			end )
		else null end as calibrated_size
	
	,case when node.depth = 0 then node.calibrated_x_position
		when node.type = 'Field' then node.calibrated_x_position
		when node.depth = 1 then 
			(case when linked.calibrated_x_position > 0 then (linked.calibrated_x_position+(node.x_position))
				when linked.calibrated_x_position <= 0 then (linked.calibrated_x_position-(node.x_position))
			else null end)
		else null end as calibrated_x_position
		
	,case when node.depth = 0 then node.calibrated_y_position
		when node.type = 'Field' then node.calibrated_y_position
		when node.depth = 1 then 
			(case when linked.calibrated_y_position > 0 then (linked.calibrated_y_position+(node.y_position))
			when linked.calibrated_y_position <= 0 then (linked.calibrated_y_position-(node.y_position))
			else null end)
		else null end as calibrated_y_position

	,case when node.type = 'Field' then node.linked_x 
		when node.depth = 0 then node.linked_x 
		when node.depth = 1 then linked.calibrated_x_position
		else 0 end as linked_x
	,case when node.type = 'Field' then node.linked_y
		when node.depth = 0 then node.linked_y
		when node.depth = 1 then linked.calibrated_y_position 
		else 0 end as linked_y	
from 
calibrate_0 as node
	left join calibrate_0 as linked
	on node.link1 = linked.title
	and node.link1 <> node.title
 ") === TRUE) {printf("<BR> calibrate_1 created successfully.\n");}
else echo("calibrate_1 Statement failed: ". $mysqli->error . "<br>");
 
 
 //rename variables
if ($mysqli->query("create table output as select
order_id 
,title 
,unique_ID 
,image 
,link1
,link2 
,Field 
,Type
,Text
,link_count
,depth
,x_position as original_x
,y_position as original_y
,size as original_size
,calibrated_x_position as x_position
,calibrated_y_position as y_position
,calibrated_size as size
,linked_x
,linked_y
from calibrate_1
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

