<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_connecti = "localhost";
$database_connecti = "gallery";
$username_connecti = "root";
$password_connecti = "";
$connecti = mysql_pconnect($hostname_connecti, $username_connecti, $password_connecti) or trigger_error(mysql_error(),E_USER_ERROR); 
?>