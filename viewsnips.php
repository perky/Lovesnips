<?php 
include("sharedphp.php");

$colname_Snippet = "-1";
$query_Snippet = "SELECT title, code, `description`, catagory, contributor, revised FROM lovesnips ORDER BY revised DESC LIMIT 10";
if (isset($_GET['snip'])) {
  $colname_Snippet = $_GET['snip'];
}

if (isset($_GET['cat'])) {
  $searchcat = $_GET['cat'];
  $query_Snippet = "SELECT title, code, `description`, catagory, contributor, revised FROM lovesnips WHERE catagory = '$searchcat' ORDER BY title ASC";
}
mysql_select_db($database_loveSQL, $loveSQL);

$Snippet = mysql_query($query_Snippet, $loveSQL) or die(mysql_error());
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
<script type="text/javascript" src="/lovesnips/niftycube.js"></script> 
<script type="text/javascript">
window.onload=function(){
Nifty("div#mainContent","big");
Nifty("div#sidebar1","big");
Nifty("div#msgbar1","big");
}
function clearForm(ref)
	{
		if(ref.defaultValue == ref.value) { ref.value = ""; }
	}
</script>
<style type="text/css">
<!--
.style2 {
	color: #666666;
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
  <?php if ( isset( $_GET['cat'] ) ) { ?>
  <h1 class="mainh1"><?php echo $_GET['cat']; ?></h1>
  <?php } else { ?>
  <h1 class="mainh1">Latest Snips</h1>
  <?php } ?>
  <?php $count = 0; while( $row_Snippet = mysql_fetch_assoc($Snippet) ) { $count++; ?>
    <h1> <a href="/lovesnips/<?php echo $row_Snippet['title']; ?>"><?php echo $row_Snippet['title']; ?></a> </h1>
    <p class="timestamp">  <?php echo $row_Snippet['revised']; ?> - By: <?php echo $row_Snippet['contributor']; ?> </p>
    <?php } ?>
      <!-- end #mainContent -->
    </div>

	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
   <div id="footer">
    <p align="center" class="style2">Blah blah blah, made by Luke Perkin. Visit <a href="http://locofilm.co.uk" target="_blank">locofilm.co.uk</a>.</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
<?php
mysql_free_result($catagories);

mysql_free_result($Snippet);
?>
