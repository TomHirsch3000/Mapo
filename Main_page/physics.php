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
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists.
&nbsp;For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain.
&nbsp;Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}

/*applies to all elements within a DIV*/
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 0px;
	padding-left: 0px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: black;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
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
	padding: 0 15px 15px 0px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
	list-style: none; /* this removes the list marker */
	/*border-top: 1px solid #666;*/ /* this creates the top border for the links - all others are placed using a bottom border on the LI */
	margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
text-align:center;
/*border-top: 1px solid #666;
	border-bottom: 1px solid #666;*/ /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
	padding: 5px 5px 5px 0px;
	display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
	width: 195px;  /*this width makes the entire button clickable for IE6. If you don't need to support IE6, it can be removed. Calculate the proper width by subtracting the padding on this link from the width of your sidebar container. */
	text-decoration: none;
	background: #87D86D
;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
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
	clear: both; /* this clear property forces the .container to understand where the columns end and contain them */
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as 
the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}

.container {
	width: 1210px;
	background:white;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
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
	left:3px;
	top:53px;
	overflow-y: hidden;
	overflow-x: hidden;
	z-index:5;
	
}
.node1
{
background:white;
//border-style:solid;
//rgba(135, 216, 109,0.6);
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
width:200px !important;
height:300px !important;
}



/*node1*/
	// style=overflow:hidden;
	// width:;
	// position:absolute;
	// left:;
	// top:;
	// z-index:100;
	
	/* node-header*/
		// text-align:center;
		// background:#5EBA41;
		// overflow:hidden;
		
		/*img-wrap*/
			// float:left;
			// margin-top:2px;
			// margin-bottom:0px;
			// width:100px;*/{}
			
			/*image*/
				.node1:hover #myimage
				{width:190px !important;}

		/*title*/
			.node1:hover .node-title
			{font-size:20px !important;
			width:190px !important;
			}

			// float:left;
			// margin-top:2px;
			// margin-bottom:
			// 0px;

			// font-size:;{}
	/*text*/

	.node1:hover .text-wrap1
	{width:190px !important;
	font-size:15px !important;
	overflow-y:scroll !important;
	height:80px !important;
	}
		// float:left;


	/*vote*/
		// float:top;
		// width:;
	
		/*arrow-upvote*/
			// style="float:left;
			// width: 0; height: 0; 
			// border-left: 
			// border-right: 
			// border-bottom:
			// font-size:

		/*boarder*/
			// float:left;
			// font-size:

		/*arrow-dvote*/
			// float:left;
			// width: 0; height: 0; 
			// border-left:  
			// border-right: 
			// border-top:   
			// font-size:;{}



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
				  <img src="../../images/Pale_Blue_Dot.jpg" alt="Logo" 
				  name="Insert_logo" width="180" height="80" id="Pale_Blue_Dot" 
				  style="background: #66FF33; display:block;" />
			  </p>
			  <h1 style="float:left;margin-left:10px;margin-top:5px;font-size:40px;">Map-O</h1>
		 </div>
		 <div style ="	position:fixed;	left: 300px;	right: 0px;	top: 0px;  width:810;">
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

