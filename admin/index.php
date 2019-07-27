<?php 
session_start();
ob_start();
include("../src/config.db.php");
include("../src/functions.php");
include("pages.php");
if(!isset($_SESSION["BaydoganMirac-Admin"])){
	header("location: signin.php");
}
?>
<!DOCTYPE>
<html>
<head>
	<title>BaydoganMirac.net Blog Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="content-language" content="TR" />
	<meta http-equiv="content-script-type" content="text/javascript" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="Pragma" content="no-cache" />
    <meta name="copyright" content="BaydoganMirac.net" />
    <meta name="author" content="Miraç Baydoğan" />
    <meta name="designer" content="Miraç Baydoğan" />
    <meta name="email" content="baydoganmirac@gmail.com" />
    <meta name="reply-to" content="baydoganmirac@gmail.com" />
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/themes/flat/style.css" />
    <script type="text/javascript" src="../js/cazary.min.js"></script>

	<script type="text/javascript">
		(function($, window)
		{
			$(function($)
			{
				$("textarea#id_cazary_full").cazary({
					commands: "FULL"
				});
			});
		})(jQuery, window);
			</script>
</head>
<body>
  <nav class="uk-navbar uk-navbar-container uk-margin" uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky"  style="position: relative; z-index: 980;">
          <div class="uk-navbar-left">
              <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-nav" href="#"></a>
          </div>
        <div class="uk-navbar-center">
          <a class="uk-navbar-item uk-logo" href="<?=$sitelink?>admin/">&lt;?=$BaydoganMirac?&gt;</a>
        </div>
      </nav>
		<div id="offcanvas-nav" uk-offcanvas="overlay: true; mode: reveal">
		    <div class="uk-offcanvas-bar">

		        <ul class="uk-nav uk-nav-default">
		            <li class="uk-nav-header">Hoşgeldiniz <?=$_SESSION["BaydoganMirac-Admin"]?></li>
		            <li><a href="<?=$sitelink?>admin/1-anasayfa.html"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Dashboard</a></li>
		            <li><a href="<?=$sitelink?>admin/2-yazilar.html"><span class="uk-margin-small-right" uk-icon="icon: file-text"></span> Yazılar</a></li>
		            <li><a href="<?=$sitelink?>admin/8-kategoriler.html"><span class="uk-margin-small-right" uk-icon="icon: tag"></span> Kategoriler</a></li>
		            <li><a href="<?=$sitelink?>admin/5-uyeler.html"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Üyeler</a></li>
		            <li><a href="<?=$sitelink?>admin/11-yorumlar.html"><span class="uk-margin-small-right" uk-icon="icon: comments"></span> Yorumlar</a></li>
		            <li><a href="<?=$sitelink?>admin/9-slideshows.html"><span class="uk-margin-small-right" uk-icon="icon: image"></span> Slide Shows</a></li>
		            <li><a href="<?=$sitelink?>admin/7-yoneticiler.html""><span class="uk-margin-small-right" uk-icon="icon: user"></span> Yöneticiler</a></li>
		            <li><a href="<?=$sitelink?>admin/6-ayarlar.html"><span class="uk-margin-small-right" uk-icon="icon: settings"></span> Site Ayarları</a></li>
		            <li class="uk-nav-divider"></li>
		            <li><a href="<?=$sitelink?>admin/10-cikisyap.html"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Çıkış Yap</a></li>
		        </ul>

		    </div>
		</div>
<div style="margin-top: 20px;">
<?php 
	@$page = $_GET["page"];
	if($page){
		include($pages[$page]);
	}else{
		include($pages[1]);
	}
?>
</div>
</body>
</html>
