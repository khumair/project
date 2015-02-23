<?php
session_start();
mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("gallery")or die(mysql_error());
error_reporting('e_all^e_notice');
?>