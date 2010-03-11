<?php

include("sharedphp.php");

$colname_Snippet = "-1";
if (isset($_GET['snip'])) {
  $colname_Snippet = $_GET['snip'];
}

mysql_select_db($database_loveSQL, $loveSQL);
$query_Snippet = sprintf("SELECT code, `description`, catagory, contributor, revised FROM lovesnips WHERE title = %s", GetSQLValueString($colname_Snippet, "text"));
$Snippet = mysql_query($query_Snippet, $loveSQL) or die(mysql_error());
$row_Snippet = mysql_fetch_assoc($Snippet);
$totalRows_Snippet = mysql_num_rows($Snippet);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lovesnips 
<?php 
	if ( isset($_GET['snip']) )
		echo "-> " . $_GET['snip'];
?>
</title>
<link href="/lovesnips/viewsnips.css" rel="stylesheet" type="text/css" />
<link href="/lovesnips/lua.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://localhost/lovesnips/niftycube.js"></script> 
<script type="text/javascript">
window.onload=function(){
Nifty("div#mainContent","big");
Nifty("div#sidebar1","big");
}
</script>
<style type="text/css">
<!--
.style2 {	color: #666666;
	font-size: xx-small;
	font-family: monospace;
}
-->
</style>
</head>

<body class="twoColElsRtHdr">

<div id="container">
   
  <div id="header">
    <div align="center"><img src="/lovesnips/banner.png" class="banner"/>
    <h1></h1>
    </div>
  <!-- end #header --></div>
  
  <?php include("sidebar.php"); ?>

  <div id="mainContent">
    <h1 class="mainh1"> <?php 
	if ( isset($_GET['snip']) )
		echo $_GET['snip'];
?> </h1>
    <p><?php echo bb2html($row_Snippet['description']); ?></p>
    <div class="code" id="code">
	  	<?php 
			$geshi = new GeSHi($row_Snippet['code'], 'lua');
			$geshi->enable_classes();
			$geshi->set_header_type(GESHI_HEADER_PRE);
			$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
			echo $geshi->parse_code();
		?>
     </div>
     <img src="/lovesnips/image/pencil.png" /><?php echo $row_Snippet['contributor']; ?><br />
     <a href="/lovesnips/snips/<?php echo $_GET['snip'];?>.lua" class="downloadlink"><img src="/lovesnips/image/page_white_put.png" />View / Download (right click)</a>
     <br />
      <!-- end #mainContent -->
    </div>

	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
   <div id="footer">
    <p align="center"><span class="style2">Blah blah blah, made by Luke Perkin. Visit <a href="http://locofilm.co.uk" target="_blank">locofilm.co.uk</a>.</span></p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
<?php
mysql_free_result($Snippet);
?>
