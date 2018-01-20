<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("search_list_physics.xml");

$x=$xmlDoc->getElementsByTagName('mydata');

//get the q parameter from URL
$a=$_GET["a"];

//lookup all links from the xml file if length of q>0
if (strlen($a)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('title');
    if ($y->item(0)->nodeType==1) {
      //find a link matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$a)) {
        if ($hint=="") {
          $hint="<a> ". $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        } else {
          $hint=$hint . "<br /><a> ".   $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?> 
