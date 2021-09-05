<?php session_start();
$_SESSION['views']=1;
$_SESSION['size_min'] = 0;
$_SESSION['size_max'] = 2010;
$_SESSION['horizontal_min'] = -750;
$_SESSION['horizontal_max'] = 1250;
$_SESSION['vertical_min'] = -750;
$_SESSION['vertical_max'] = 1250;
$_SESSION['multiplier'] = 0.1;
$_SESSION['map_select'] = 'physics';
 ?>
 
 
 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MapO</title>
<style type="text/css">
<!--
body {
	font: 60%/1.4 Verdana, courier new, Helvetica, sans-serif;
	background: white;
	margin: 0;
	padding: 0;
	color: #001;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { 
	padding: 0;
	margin: 0;
}

/*applies to all elements within a DIV*/
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 
	padding-right: 0px;
	padding-left: 0px; /
}
a img { 
	border: none;
}


a:link {
	color: black;
	text-decoration: underline; 
}
a:visited {
	color: #739611;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 0px; 
}

ul.nav {
	list-style: none; 
	margin-bottom: 15px; 
}
ul.nav li {
text-align:center;

}
ul.nav a, ul.nav a:visited { 
	padding: 5px 5px 5px 0px;
	display: block; 
	width: 195px;  
	text-decoration: none;
	background: #87D86D
;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { 
	background: #527000;
	color: #739611;
}
/*label{
display:inline-block;
width:50px;
margin-right:10px;
text-align:right;
}*/

input{
border-color:#87D86D;
}
fieldset{
border:none;
width:1000px;
margin:0px;
}

#submit {
    background-color: #43A621;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
#submit:hover {
    border: none;
    background:#96CD82;
    box-shadow: 0px 0px 1px #777;
}
#zout {
    background-color: #43A621;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 15px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
#zout:hover {
    border: none;
    background:red;
    box-shadow: 0px 0px 1px #777;
}
/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background: #A1D290;
	position: relative;
	color:#186400;
	clear: both; 
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  
	float: right;
	margin-left: 8px;
}
.fltlft { 
	float: left;
	margin-right: 8px;
}
.clearfloat { 
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}

.container {
	width: 1210px;
	background:white;
	margin: 0 auto; 
}

.header {
	background: #43A621;
	z-index:100;
	overflow:hidden;
	position:fixed;
	left: 0px;
	right: 0px;
	top: 0px;
	height:70px;
	box-shadow: 0px 1px #FFF inset, 0px 1px 3px rgba(34, 25, 25, 0.4);
        color:#186400;
        padding: 0 0}


.sidebar1 {
    float: left;
	width: 200px;
    height: 450px;
	background: white;
	padding-bottom: 0px;
	border-radius: 10px;
	border-style:solid;
	border-color:#43A621;
	color:#186400;
	margin-top:50px;
	border-width:1px;
	box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.24);

} 



.content {
	padding: 0 0;
	width: 1000px;
	height:750px;
	position:relative;
	left:10px;
	top:53px;
	overflow-y: hidden;
	overflow-x: hidden;
	z-index:5;
	
}
.node1
{
background:white;
color:black;
border-radius: 10px;
border-style:solid;
border-color: #43A621;
border-width:1px;
box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.24);

}
.node-new
{
background:rgba(135, 216, 109,0.6);
color:black;
border-radius: 10px;
border-style:solid;
border-color: #43A621;
border-width:2px;

}
/*////////////////////////////////////////////////////////////////////////////////////////////*/
/*highlight selected node to enable easy reading*/
/*////////////////////////////////////////////////////////////////////////////////////////////*/

.node1:hover
{
//background:#5EBA41;
opacity: 1;
z-index:200 !important;
border-color:#186400;
width:350px !important;
height:500px !important;
}
			
/*image*/
	.node1:hover #myimage
	{width:290px !important;
	height:200px !important;
	margin-left: 20px !important;
	}

/*title*/
	.node1:hover .node-title
	{font-size:25px !important;
	width:290px !important;
	}
/*text*/
	.node1:hover .text-wrap1
	{width:330px !important;
	font-size:15px !important;
	overflow-y:scroll !important;
	height:180px !important;
	}






/*////////////////////////////////////////////////////////////////////////////////////////////*/

/*////////////////////////////////////////////////////////////////////////////////////////////*/

#map-tabs
{float:right;
width:150px;
border-radius: 10px;
background:#87D86D;
margin-right:5px;
margin-top:0px;
height:30px;
text-align:center;}
#map-tabs:hover
{
background:#186400;
color:#87D86D;
}

/* ~~ hover highlight the area to zoom in on ~~ */
.zarea:hover div{
    border:1px solid #ccc;
}

 .zarea {
    background: white;
	border-style:none;
	color:Lavender;
	width:250px;
	height:250px;
	position:absolute;
	z-index:-1;
}
 .zarea:hover {
    background: #eee;
    border-top: 1px solid #d0d0d0;
}
.arrow-left {width: 0; height: 0; border-top: 20px solid transparent;  border-bottom: 20px solid transparent; border-right:20px solid #43A621;	} 
.arrow-right{width: 0; height: 0; border-top: 20px solid transparent;  border-bottom: 20px solid transparent; border-left:20px solid #43A621;	  }
.arrow-up 	{width: 0; height: 0; border-left: 20px solid transparent; border-right: 20px solid transparent;  border-bottom:20px solid #43A621; }
.arrow-down {width: 0; height: 0; border-left: 20px solid transparent; border-right: 20px solid transparent;  border-top:20px solid #43A621;    }
.arrow-left:hover {border-right:20px solid #96CD82;}
.arrow-right:hover {border-left:20px solid #96CD82;}
.arrow-up:hover {border-bottom:20px solid #96CD82;}
.arrow-down:hover {border-top:20px solid #96CD82;}
.arrow-upvote:hover {border-color: #96CD82;}
.arrow-dvote:hover {border-top: 30px solid #96CD82;}

-->
</style></head>

<body>


  <div class="header" style="overflow:hidden">
	  <div style = "width:1210px; margin: 0px auto;">
		<div style = "width:400px;">
			  <p style="float:left;margin-top:5px">
				  <img src="../Images/Pale_Blue_Dot.jpg" alt="Logo" 
				  name="Insert_logo" width="180" height="80" id="Pale_Blue_Dot" 
				  style="background: #66FF33; display:block;" />
			  </p>
			  <h1 style="float:left;margin-left:10px;margin-top:5px;font-size:40px;">Map-O</h1>
		 </div>
		 <div style ="	position:fixed;	left: 800px;	right: 0px;	top: 0px;  width:810;">
		  <!-- search-->
				<form style = "float:top;font-size:10px;padding-left:150px;margin-top:5px;z-index:2000">
				<input type="text" size="5" name= "inputbox" onkeyup="showResult(this.value)" style = "float:left;font-size:20px;width:400px;margin-top:5px" >
				<div id="livesearch" style = "overflow:hidden;font-size:20px;z-index:200;background:#66FF33"></div>	
				<INPUT style = "float:top;margin-top:5px;" TYPE="button" id="submit" NAME="button" Value="Search" 
				onClick="searchResults(this.form)">
				</form>

		 </div>
		 <div style = "float:top;padding-top:48px;width;700px">
			 <div id="map-tabs" onclick =	"replace_content('81')">Map of physics</div>
			<div id="map-tabs" onclick =	"replace_content('82')" >Map of bike parts </div>
			<div id="map-tabs">Map of Vegetarian food</div>
			<div id="map-tabs">Map 2</div>
			<div id="map-tabs">Map 3</div>
			<div id="map-tabs">Search for other Maps</div>
			</div>
		</div>
    <!-- end .header --></div>
 <div 
class="container" style = "margin-top:30px;position:static;"
>   
  <div class="sidebar1">
    <ul class="nav" style = "margin-top:10px">
         <li><a href="#" style = "color:#186400"><b>Add new node</b></a></li>
	        <p style="margin-left:4px;margin-right:4px;text-align:center"> use the form to add more information to the map </p>
		<div class="node-new" style="margin-left:10px;margin-right:10px;overflow:hidden">
			<div class = "head-new" style = "background:#5EBA41;overflow:hidden">
				<div class = "node-title-new" style = "position:relative;width:150px;float:left;left:0px">	
					<form action="insert_v1004.php" method="post" enctype="multipart/form-data">
					<label style = "float:left;">Title:</label><input type="text" name="Title" style = "float:left;width:150;" 
					onkeyup="showResult(this.value)">
				</div>
				<div class="new-image" style="position:relative;float:left;width:170px;height:40px;">
				
						<label for="file">Image:</label>
						<input type="file" name="file" id="file" style = "font-size:10px;width:170px;">
				</div>
			</div>
			<div class="node-cont">	
				<label style="float:left"><span>Text:</span></label><textarea style = "width:140px;float:left" type="text" name="Text" rows=1></textarea><br>
				<label style="float:left">Size:</label><input style = "width:30px;float:left" type="text" name="Size"><br>
				<label style="float:left">Link to:</label><input style = "width:70px;float:left" type="text" name="Link1"onkeyup="showResult(this.value)"><br><p> </p>
				<label style="float:left;" for="se-field">Field:</label><select style="width:130px;" id="se-field" name="Field">
					<option>Classical Mechanics</option>
					<option>Thermodynamics and Statistical Mechanics</option>
					<option>Electromagnetism</option>
					<option>Relativity</option>
					<option>Quantum Mechanics</option>
					
					</select>
			</div>	
			<input style = "font-size:10px;left:100px;" type="submit" value="Submit" id="submit">
			</form>
		</div>
 <br>
 <li><a href="#" style = "color:#186400"><b>Zoom and scroll</b></a></li>
	
	<div class="arrow-up" style = "position:relative;   left:70px;	top:40px" onclick =	"replace_content('98')"></div>
	<div class="arrow-left" style = "position:relative; left:40px;	top:50px" onclick =	"replace_content('97')"></div>
	<div class="arrow-right" style = "position:relative;left:120px;	top:10px" onclick =	"replace_content('96')"></div>
	<div class="arrow-down" style = "position:relative; left:70px;	top:20px" onclick =	"replace_content('95')"></div>
	
		<button id="zout" style = "position:relative;left:65px;top:-50px;width:50px"
			onclick =	"replace_content('99')" > 
		zoom out		
		</button>
		
		<button id="zout" style = "position:relative;left:10px;top:40px;width:50px"
				 onclick =	"replace_content('0')" > 
		Reset		
		</button>
	    </ul>		
    <!-- end .sidebar1 --></div>
		
	<script>

		  
		function replace_content(str)
		{

		  if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			  document.getElementById("target").innerHTML=xmlhttp.responseText;
			}
		  }
		  xmlhttp.open("GET","content_zoom.php?q="+str,true);
		  xmlhttp.send();

		}

		  
		
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","search_go.php?a="+str,true);
  xmlhttp.send();
}
function searchResults (form) {
    var search_inp = form.inputbox.value;
    replace_content(search_inp);
}
</script>
	<div class="content" id="target">
			<?php 
			require('content_zoom.php'); 
			?>
			

	<!-- end .content --></div>
	



  <!-- end .container --></div>

</body>
</html>

