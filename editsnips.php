<?php
include("sharedphp.php");

if ( !isset($_SESSION['loggedin']) )
	die( "You need to be logged in to see this page" );

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_loveSQL, $loveSQL);
$query_Catagories = "SELECT catagory FROM catagories ORDER BY catagory ASC";
$Catagories = mysql_query($query_Catagories, $loveSQL) or die(mysql_error());
$row_Catagories = mysql_fetch_assoc($Catagories);
$totalRows_Catagories = mysql_num_rows($Catagories);

if (isset($_POST['delme2'])) {
	$thisid = $_POST['snip_id'];
	$thiscat = $_POST['snip_cat'];
	
	$message = "Snip gone. =[";
	
	$qry = "DELETE FROM lovesnips WHERE id=$thisid";
	mysql_query($qry, $loveSQL) or $message = "Ooops: " . mysql_error();
	$qry = "UPDATE catagories SET snips=snips-1 WHERE catagory='$thiscat'";
	mysql_query($qry, $loveSQL) or $message = "Ooops: " . mysql_error();
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addsnip")) {
	$user = $_POST['user'];
	$qry = "SELECT name FROM loveusers WHERE name = '$user'";
	$result = mysql_query($qry, $loveSQL);
	$totalRows =  mysql_num_rows($result);
	if ($totalRows) {
		$_POST['title'] = str_replace(" ", "_", $_POST['title']);
		$_POST['title'] = str_replace(".", "-", $_POST['title']);
		$striparray = array("%","@","{","}","<",">","\"","'","\\","/","?",";",":","+","$","&");
		$_POST['title'] = str_replace($striparray, "", $_POST['title']);
		
	  	$insertSQL = sprintf("UPDATE lovesnips SET title=%s, code=%s, description=%s, catagory=%s, contributor='$user' WHERE id=%d",
						   GetSQLValueString($_POST['title'], "text"),
						   GetSQLValueString($_POST['code'], "text"),
						   GetSQLValueString($_POST['description'], "text"),
						   GetSQLValueString($_POST['catagory'], "text"),
						   GetSQLValueString($_POST['snip_id'], "int"));
	
	  	mysql_select_db($database_loveSQL, $loveSQL);
	  	$Result1 = mysql_query($insertSQL, $loveSQL) or die(mysql_error());
		
		$thiscat = $_POST['snip_cat'];
		$sql = "UPDATE catagories SET snips=snips-1 WHERE catagory='$thiscat'";
		mysql_query($sql, $loveSQL) or $message = "Ooops: " . mysql_error();
		
		$thiscat = $_POST['catagory'];
		$sql = "UPDATE catagories SET snips=snips+1 WHERE catagory='$thiscat'";
		mysql_query($sql, $loveSQL) or $message = "Ooops: " . mysql_error();
		
		$ourFileName =  "snips/" . $_POST['title'] . ".lua";
		$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
		fwrite($ourFileHandle, $_POST['code']);
		fclose($ourFileHandle);
		$message = sprintf("Oooh, thanks! Your snip has been <a href='/lovesnips/%s'>updated</a>.",$_POST['title'],"text");
	} else {
		$message = "Hey mate, I can't find your username or password anywhere in my books.<br/> 
					You sure you've <a href='/lovesnips/register.php'>registered</a>?";
	}
}

$colname_Snippet = "-1";
$query_Snippet = "SELECT title, code, `description`, catagory, contributor, revised FROM lovesnips ORDER BY revised DESC";
if (isset($_GET['edit'])) {
  $editsnip = $_GET['edit'];
  $query_Snippet = "SELECT id, title, code, `description`, catagory, contributor, revised FROM lovesnips WHERE title = '$editsnip'";
}

mysql_select_db($database_loveSQL, $loveSQL);
$Snippet = mysql_query($query_Snippet, $loveSQL) or die(mysql_error());
$totalRows_Snippet = mysql_num_rows($Snippet);
if (isset($_GET['edit'])) { 
	$row = mysql_fetch_assoc($Snippet); 
	$form = array();
	$form['id'] = $row['id'];
	$form['title'] = $row['title'];
	$form['catagory'] = $row['catagory'];
	$form['code'] = $row['code'];
	$form['desc'] = $row['description'];
	$form['user'] = $_SESSION['user'];
	$form['pass'] = $_SESSION['pass'];
}
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
<!--
window.onload=function(){
Nifty("div#mainContent","big");
Nifty("div#sidebar1","big");
Nifty("div#msgbar1","big");
}
function clearForm(ref)
	{}
// -->
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
    <div align="center"><img src="/lovesnips/banner-editsnip.png" class="banner"/>
    <h1></h1>
    </div>
  <!-- end #header --></div>
  
  <?php include("sidebar.php"); ?>

  <div id="mainContent">
  <?php 
  		if (isset( $_GET['edit'] )) {
  ?>
  	<div id="form">
	<?php include("snipform.php"); ?>
	<center>
	<form id="delme" name="delme" action="editsnips.php" method="post" >
		<input type="submit" name="delme2" id="delme2" value="Delete Me!" />
		<input type="hidden" name="snip_id" value="<?php echo $form['id']; ?>" />
		<input type="hidden" name="snip_cat" value="<?php echo $form['catagory']; ?>" />
	</form>
	</center>
	</div>
  <?php } else {
  		$count = 0; 
		while( $row_Snippet = mysql_fetch_assoc($Snippet) ) { 
			$count++; ?>
    <h1> <a href="editsnips.php?edit=<?php echo $row_Snippet['title']; ?>"><?php echo $row_Snippet['title']; ?></a> </h1>
    <p class="timestamp">  <?php echo $row_Snippet['revised']; ?> </p>
  <?php }} ?>
  
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
