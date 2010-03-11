<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_loveSQL = "hostname";
$database_loveSQL = "database name";
$username_loveSQL = "user name";
$password_loveSQL = "password";
$loveSQL = mysql_pconnect($hostname_loveSQL, $username_loveSQL, $password_loveSQL) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_loveSQL, $loveSQL);
?>