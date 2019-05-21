<?php
if(isset($_SESSION["kullanici"])){
  header("location:".$sitelink."anasayfa.html");
}
?>
        <script type="text/javascript">
            function signin(){
            var userin_email  = $("#signin #signinemail").val();
            var userin_password  = $("#signin #signinpw").val();

              var atpos=userin_email.indexOf("@");
              var dotpos=userin_email.lastIndexOf(".");
              if(userin_password == "")
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Şifrenizi Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if(userin_email == "")
              {   
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Emailinizi Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=userin_email.length)
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Geçerli Bir Email Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }else{
                          $.ajax({       
                              type: "POST",
                              url:  "<?=$sitelink?>ajax.php",
                              data : {type:'signin', userin_email:userin_email,userin_password:userin_password},
                              success: function(sonuc){
                                if(sonuc == 1){
                                    var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Giriş Yapıldı</p></div>";   
                                   document.getElementById("uyari").innerHTML=newHTML;
                                   window.location = "<?=$sitelink?>"
                                }else{
                                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Giriş Yapılamadı Lütfen Tekrar Deneyiniz</p></div>";   
                                    document.getElementById("uyari").innerHTML=newHTML;
                                }
                              }
                          })                                             
              }

          }

            function signup(){
            var userup_email  = $("#signup #signupemail").val();
            var userup_password  = $("#signup #signuppw").val();
            var userup_username  = $("#signup #signupusername").val();
            var userup_website  = $("#signup #signupwebsite").val();

              var atpos=userup_email.indexOf("@");
              var dotpos=userup_email.lastIndexOf(".");
              if(userup_password == "")
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Şifre Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if(userup_email == "")
              {   
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Email Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }else if(userup_username == "")
              {   
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Kullanıcı Adı Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=userup_email.length)
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Geçerli Bir Email Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }else{
                          $.ajax({       
                              type: "POST",
                              url:  "<?=$sitelink?>ajax.php",
                              data : {type:'signup', userup_email:userup_email,userup_password:userup_password,userup_username:userup_username,userup_website:userup_website},
                              success: function(sonuc){
                                if(sonuc == 1){
                                    var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Kaydınız Yapıldı Lütfen Giriş Yapınız</p></div>";   
                                   document.getElementById("uyari").innerHTML=newHTML;
                                }else if(sonuc==3){
                                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Kullanıcı Adı/Email Zaten Kullanılıyor</p></div>";   
                                    document.getElementById("uyari").innerHTML=newHTML;
                                }else{
                                  alert(sonuc);
                                }
                              }
                          })                                             
              }

          }

        </script>
        <div class="uk-container">
            <div class="uk-grid-divider uk-child-width-expand@s" uk-grid>
              <div id="signin" >
                <div><h2>Giriş Yap</h2>
                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            <input class="uk-input" name="email" id="signinemail" placeholder="Email" type="text">
                        </div>
                    </div>    
                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input class="uk-input" id="signinpw" name="password" placeholder="Şifreniz" type="password">
                        </div>
                    </div>
                    <button onclick="signin()" class="uk-button uk-button-secondary">Giriş Yap</button>
                </div>
              </div>
              <div id="signup">
                <div><h2>Kayıt Ol</h2>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input" id="signupusername" placeholder="Kullanıcı Adı" type="text">
                        </div>
                    </div>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            <input class="uk-input" id="signupemail" placeholder="Email" type="text">
                        </div>
                    </div>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input class="uk-input" id="signuppw" placeholder="şifre" type="password">
                        </div>
                    </div>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: link"></span>
                            <input class="uk-input" id="signupwebsite" placeholder="Website (http:// Etiketi ile)" type="text">
                        </div>
                    </div>
                    <button onclick="signup()" class="uk-button uk-button-secondary">Kayıt Ol</button>
                </div>
             </div>
            </div>
                <div id="uyari" class="uk-container"></div>
        </div>