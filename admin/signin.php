<?php 
session_start();
ob_start();
include("../src/config.db.php");
include("../src/functions.php");
?>
<!DOCTYPE html>
<html style="background-color: #222;">

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
        <link rel="stylesheet" href="<?=$sitelink?>css/uikit.min.css" />
        <script src="<?=$sitelink?>js/uikit.min.js"></script>
        <script src="<?=$sitelink?>js/uikit-icons.min.js"></script>
        <script src="<?=$sitelink?>js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
  function signin(){
            var admin_username  = $("#signin #adminusername").val();
            var admin_password  = $("#signin #adminpassword").val();


              if(admin_password == "")
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Şifrenizi Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if(admin_username == "")
              {   
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Emailinizi Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }else{
                          $.ajax({       
                              type: "POST",
                              url:  "<?=$sitelink?>admin/ajax.php",
                              data : {type:'signin', admin_username:admin_username,admin_password:admin_password},
                              success: function(sonuc){
                                if(sonuc == 1){
                                    var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Giriş Yapıldı</p></div>";   
                                   document.getElementById("uyari").innerHTML=newHTML;
                                   window.location = "<?=$sitelink?>admin/"
                                }else{
                                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Giriş Yapılamadı Lütfen Tekrar Deneyiniz</p></div>";   
                                    document.getElementById("uyari").innerHTML=newHTML;
                                }
                              }
                          })                                             
              }

          }

        </script>
    </head>

    <body>
        <div class="uk-flex uk-flex-center uk-container uk-text-center">
            <section class="uk-section-secondary" style="margin-top: 150px;" id="signin">
                <h1>BaydoganMirac.Net</h1>
            

                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input class="uk-input" id="adminusername" placeholder="Kullanıcı Adı" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                        <input class="uk-input" id="adminpassword" placeholder="Şifre" type="password">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <button class="uk-button uk-button-secondary" onclick="signin()">Giriş Yap</button>
                    </div>
                </div>
              
            <div id="uyari"></div>
            </section>          
        </div>
    </body>

</html>