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
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_POST["user"]) && $_POST["user"] != "username") {
	$user  = $_POST['user'];
	$pass  = $_POST['pass'];
	$qry = "SELECT name FROM loveusers WHERE name = '$user'";
	$result = mysql_query($qry, $loveSQL) or die(mysql_error());;
	$totalRows =  mysql_numrows($result);
	if ($totalRows) {
		$message = "Your name is in use by someone else! Well at least your popular...";
	} else {
		$_POST['user'] = str_replace(" ", "_", $_POST['user']);
		$striparray = array("%","@","{","}","<",">","\"","'","\\","/","?",";",":","+","$","&");
		$_POST['user'] = str_replace($striparray, "", $_POST['user']);
		
	  	$insertSQL = sprintf("INSERT INTO loveusers (name,pass) VALUES (%s, %s)",
						   GetSQLValueString($_POST['user'], "text"),
						   GetSQLValueString($_POST['pass'], "text"));
	
	  	mysql_select_db($database_loveSQL, $loveSQL);
	  	$Result1 = mysql_query($insertSQL, $loveSQL) or die(mysql_error());
		
		$message = sprintf("Welcome to the team %s!<br><a href='%s'>Let's go home</a>.",$_POST['user'],"/lovesnips/");
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lovesnips -> Register.</title>
<style>
	#form, #msg {background-color:#a9d5f2; width:500px; margin-top:10px;}
	#formhead {margin-top:10px; background-image:url(formhead.png); width:500px; height:30px; }
	#formfoot {background-image:url(formfoot.png); width:500px; height:30px; }
</style>
<script type="text/javascript" src="/lovesnips/niftycube.js"></script> 
<script type="text/javascript">
window.onload=function(){
Nifty("div#form","big");
Nifty("div#msg","big");
}
function clearForm(ref)
	{
		if(ref.defaultValue == ref.value) { ref.value = ""; }
	}
</script>
</head>

<body>
<center>
<img src="banner.png" width="400" height="128" alt="Addsnip" />

<?php if (isset($message)) { ?>
<div id="msg">
<?php echo $message; ?>
</div>
<?php } ?>

<div id="form">
	<h1>Register</h1>
	<form id="register" name="register" action="register.php" method="post">
    <input type="text" name="user" value="username" size="17" onfocus="clearForm(this);"/> 
    <input type="password" name="pass" value="1111111" size="17" onfocus="clearForm(this);"/>
    <br />
    <input type="submit" value="Register me plz." />
    <br /><br />
    </form>
</div>
</center>

<p>&nbsp;</p>
</body>
</html>