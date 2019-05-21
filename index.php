<?php
session_start();
ob_start();
include("src/config.db.php");
include("src/functions.php");
include("pages.php");
IPKaydet();
addhit();

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$sitetitle?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="description" content="<?=$sitedescription?>" />
        <meta name="keywords" content="<?=$sitekeywords?>" />
        <meta name="title" content="<?=$sitetitle?>" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="language" content="turkish" />
        <meta name="robots" content="all, follow, noarchive" />
        <meta name="googlebot" content="all, follow, noarchive" />
        <meta name="distribution" content="global" />
        <meta name="revisit-after" content="1 days" />
        <meta name="rating" content="general" />
        <meta name="copyright" content="BaydoganMirac.net" />
        <meta name="author" content="Miraç Baydoğan" />
        <meta name="designer" content="Miraç Baydoğan" />
        <meta name="email" content="baydoganmirac@gmail.com" />
        <meta name="reply-to" content="baydoganmirac@gmail.com" />
        <link rel="stylesheet" href="<?=$sitelink?>css/uikit.min.css" />
        <script src="<?=$sitelink?>js/uikit.min.js"></script>
        <script src="<?=$sitelink?>js/uikit-icons.min.js"></script>
        <script src="<?=$sitelink?>js/jquery-3.3.1.min.js"></script>
    </head>
    <body>
      <nav class="uk-navbar uk-navbar-container uk-margin" style="position: relative; z-index: 980;">
          <div class="uk-navbar-left">
              <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-reveal" href="#"></a>
          </div>
        <div class="uk-navbar-center">
          <a class="uk-navbar-item uk-logo" href="<?=$sitelink?>anasayfa.html">&lt;/BaydoganMirac&gt;</a>
        </div>
      </nav>
      <div id="offcanvas-reveal" uk-offcanvas="mode: reveal; overlay: true">
            <div class="uk-offcanvas-bar uk-flex uk-flex-column">

                <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                    <li class="uk-active"><a href="#"><img src="<?=$sitelink?>/img/deneme.jpg" class="uk-border-circle"></a></li>
                    <li><a href="<?=$sitelink?>hakkimda.html"><span class="uk-margin-small-right" uk-icon="icon: user"></span> Hakkımda</a></li>
                    <li><a href="<?=$sitelink?>blog.html"><span class="uk-margin-small-right" uk-icon="icon: file-text"></span> Blog</a></li>
                    <li><a href="<?=$sitelink?>galeri.html"><span class="uk-margin-small-right" uk-icon="icon: image"></span> Galeri</a></li>
                    <li><a href="<?=$sitelink?>iletisim.html"><span class="uk-margin-small-right" uk-icon="icon:  info"></span> İletişim</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><?php
                        if(isset($_SESSION["kullanici"]) || isset($_SESSION["BaydoganMirac-Admin"])){
                      ?>
                <span class="uk-margin-small-right" uk-icon="icon: user"></span> Merhaba <?php if (@$_SESSION["BaydoganMirac-Admin"]) {
                    echo $_SESSION["BaydoganMirac-Admin"];
                } else {
                    echo $_SESSION["kullanici"];
                }
 ?><br><a href="<?=$sitelink?>cikis.html" >Çıkış Yap</a>   
                      <?php      
                        }else{
                      ?>
<a href="<?=$sitelink?>kayit-ol-giris-yap.html"><span class="uk-margin-small-right" uk-icon="icon: user"></span> Kayıt Ol/Giriş Yap</a>
                      <?php
                        }

                      ?>
                </li></ul>
            </div>
        </div>
        <?php 
            @$page = $_GET["page"];
            if($page){
                include($pages[$page]);
            }else{
                include($pages["anasayfa"]);
            }
        ?>
       <div class="uk-section-default">
            <div class="uk-section uk-section-secondary uk-light" style="margin-top: 50px;">
                <div class="uk-container">

                    <h3>&copy; BaydoganMirac.net</h3>

                    <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
                        <div>
                            <p><b style="padding: 5px;">Sosyal Medyada Ben</b><br>
                              <a href="http://facebook.com/baydoganmirac" style="padding: 5px;" uk-icon="icon: facebook"></a>
                              <a href="http://instagram.com/baydoganmirac" style="padding: 5px;" uk-icon="icon: instagram"></a>
                              <a href="https://github.com/baydoganmirac/" style="padding: 5px;" uk-icon="icon: github"></a>
                              <a href="https://plus.google.com/u/0/108463758787150180105"  style="padding: 5px;" uk-icon="icon: google-plus"></a>
                              <a href="http://twitter.com/baydoganmirac" style="padding: 5px;" uk-icon="icon: twitter"></a>
                            </p>
                        </div>
                        <div>
                            <p></p>
                        </div>
                        <div class="footer" ">
                            <p><b>En Çok Okunanlar</b></p>
                            <?php 
                            echo encok5();
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
