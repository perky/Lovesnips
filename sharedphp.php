<?php
require_once('Connections/loveSQL.php');
include_once 'geshi.php';
$current_folder = basename(dirname("viewsnips.php"));

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

mysql_select_db($database_loveSQL, $loveSQL);
$query_catagories = "SELECT catagory,snips FROM catagories ORDER BY catagory ASC";
$catagories = mysql_query($query_catagories, $loveSQL) or die(mysql_error());
$totalRows_catagories = mysql_num_rows($catagories);


if (!isset($_SESSION['loggedin']))
	session_start();

if (isset($_POST['user']) && isset($_SESSION['loggedin']) && !isset($_POST['MM_insert'])){
	unset($_SESSION['loggedin']);
	unset($_SESSION['user']);
	unset($_SESSION['pass']);
	$_SESSION = array();
	session_destroy();
	$message = "Goodbye";
}

if (isset($_POST['user']) && !isset($_SESSION['loggedin']) && $_POST['user'] != "username"){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$qry = "SELECT name, pass FROM loveusers WHERE name = '$user'";
	$result = mysql_query($qry, $loveSQL) or die(mysql_error());
	$totalrows = mysql_num_rows($result);
	$row = mysql_fetch_assoc($result);
	if (strcmp( $row['pass'], $pass) == 0) {
		$_SESSION['loggedin'] = 1;
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		$message = "Hoorah! You've logged in.";
	} else {
		$message = "Do I know you?";
	}
}


// author: Louai Munajim
// website: http://elouai.com
// date: 2004/Apr/18
function bb2html($text)
{
  $bbcode = array("<", ">",
                "[list]", "[*]", "[/list]", 
                "[img]", "[/img]", 
                "[b]", "[/b]", 
                "[u]", "[/u]", 
                "[i]", "[/i]",
                '[color="', "[/color]",
                "[size=\"", "[/size]",
                '[url="', "[/url]",
                "[mail=\"", "[/mail]",
                "[code]", "[/code]",
                "[quote]", "[/quote]",
                '"]');
  $htmlcode = array("&lt;", "&gt;",
                "<ul>", "<li>", "</ul>", 
                "<img src=\"", "\">", 
                "<b>", "</b>", 
                "<u>", "</u>", 
                "<i>", "</i>",
                "<span style=\"color:", "</span>",
                "<span style=\"font-size:", "</span>",
                '<a href="', "</a>",
                "<a href=\"mailto:", "</a>",
                "<code>", "</code>",
                "<table width=100% bgcolor=lightgray><tr><td bgcolor=white>", "</td></tr></table>",
                '">');
  $newtext = str_replace($bbcode, $htmlcode, $text);
  $newtext = nl2br($newtext);//second pass
  return $newtext;
}
?>