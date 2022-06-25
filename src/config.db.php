<?php
$host               = "localhost";
$username           = "root";
$password           = "";
$database           = "blogum";
$conn    			= mysqli_connect($host,$username,$password, $database) or die ("mysqli Bağlantı Hatası!");
// $db                 = mysqlii_select_db($database);
@mysqli_query("SET NAMES 'utf-8'");
@mysqli_query("SET CHARACTER SET utf-8");
@mysqli_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
$query = "SELECT * FROM settings WHERE id='1' LIMIT 1";
$result = $conn->query($query);
$ayarlar = $result->fetch_assoc();
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
