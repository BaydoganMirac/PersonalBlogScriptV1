<?php
$host               = "localhost";
$username           = "root";
$password           = "";
$database           = "blogum";
$baglan 			= mysql_connect($host,$username,$password, false, 2) or die ("MySQL Bağlantı Hatası!");
$db                 = mysql_select_db($database);
@mysql_query("SET NAMES 'utf-8'");
@mysql_query("SET CHARACTER SET utf-8");
@mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
$ayarlar	=	@mysql_fetch_assoc(@mysql_query("SELECT * FROM settings WHERE id='1' LIMIT 1"));
	$sitetitle			=	@stripslashes($ayarlar["title"]);
	$sitedescription	=	@stripslashes($ayarlar["description"]);
	$sitekeywords		=	@stripslashes($ayarlar["keywords"]);
	$sitelink			=	@stripslashes($ayarlar["link"]);
	$aboutme			=	$ayarlar["aboutme"];
	$sitemail			=	@stripslashes($ayarlar["email"]);
	$smtphost			= 	$ayarlar["smtphost"];
	$smtpport			= 	$ayarlar["smtpport"];
	$encryption			= 	$ayarlar["encryption"];
	$smtpusername		= 	$ayarlar["smtpusername"];
	$smtppassword		= 	$ayarlar["smtppassword"];
?>
