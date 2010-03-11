<?php require_once('Connections/loveSQL.php'); session_start();?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
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
		
	  	$insertSQL = sprintf("INSERT INTO lovesnips (title, code, `description`, catagory, contributor) VALUES (%s, %s, %s, %s, '$user')",
						   GetSQLValueString($_POST['title'], "text"),
						   GetSQLValueString($_POST['code'], "text"),
						   GetSQLValueString($_POST['description'], "text"),
						   GetSQLValueString($_POST['catagory'], "text"));
	
	  	mysql_select_db($database_loveSQL, $loveSQL);
	  	$Result1 = mysql_query($insertSQL, $loveSQL) or $message = "Ooops: " . mysql_error();
		
		$thiscat = $_POST['catagory'];
		$sql = "UPDATE catagories SET snips=snips+1 WHERE catagory='$thiscat'";
		mysql_query($sql, $loveSQL) or $message = "Ooops: " . mysql_error();
		
		if (!isset($message)) {
			$ourFileName =  "snips/" . $_POST['title'] . ".lua";
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fwrite($ourFileHandle, $_POST['code']);
			fclose($ourFileHandle);
			$message = sprintf("Oooh, thanks! Your snip has been <a href='/lovesnips/%s'>snipped</a>.",$_POST['title'],"text");
		}
	} else {
		$message = "Hey mate, I can't find your username or password anywhere in my books.<br/> 
					You sure you've <a href='/lovesnips/register.php'>registered</a>?";
	}
}

$form = array();
$form['id'] = "";
$form['title'] = "Snip Title";
$form['catagory'] = "No Catagory";
$form['code'] = "Snip Code";
$form['desc'] = "Snip Description. BBCode allowed.";
if (isset($_SESSION['user']))
	$form['user'] = $_SESSION['user'];
	else
	$form['user'] = "Username";
if (isset($_SESSION['pass']))
	$form['pass'] = $_SESSION['pass'];
	else
	$form['pass'] = "1111111";

}

mysql_select_db($database_loveSQL, $loveSQL);
$query_Catagories = "SELECT catagory FROM catagories ORDER BY catagory ASC";
$Catagories = mysql_query($query_Catagories, $loveSQL) or die(mysql_error());
$row_Catagories = mysql_fetch_assoc($Catagories);
$totalRows_Catagories = mysql_num_rows($Catagories);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lovesnips -> Add snip.</title>
<style>
	#form {background-color:#a9d5f2; width:500px;}
	#formhead {margin-top:10px; background-image:url(formhead.png); width:500px; height:30px; }
	#formfoot {background-image:url(formfoot.png); width:500px; height:30px; }
</style>
<script type="text/JavaScript">
	function clearForm(ref)
	{
		if(ref.defaultValue == ref.value) { ref.value = ""; }
	}
</script>
</head>

<body>
<center>
<img src="banner-addsnip.png" width="400" height="128" alt="Addsnip" />

<?php if (isset($message)) { ?>
<div id="formhead"></div>
<div id="form">
<?php echo $message; ?>
</div>
<div id="formfoot"></div>
<?php } ?>

<div id="formhead"></div>
<div id="form">
<?php include("snipform.php"); ?>
</div>
<div id="formfoot"></div>
</center>

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Catagories);
?>
