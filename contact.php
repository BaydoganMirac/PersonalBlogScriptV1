        <script type="text/javascript">
            function contact(){
            var contact_email  = $("#contact #contactemail").val();
            var contact_name  = $("#contact #contactname").val();
            var contact_content  = $("#contact #contactcontent").val();
            var contact_header  = $("#contact #contactheader").val();

              var atpos=contact_email.indexOf("@");
              var dotpos=contact_email.lastIndexOf(".");
              if(contact_name == "" && contact_header=="")
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Boş Alan Bırakmayınız</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if(contact_email == "")
              {   
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Email Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }else if(contact_content == "")
              {   
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Mesaj Kısmını Boş Bırakmayınız.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }
              else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=contact_email.length)
              {
                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Geçerli Bir Email Giriniz.</p></div>";   
                document.getElementById("uyari").innerHTML=newHTML;  
              }else{
                          $.ajax({       
                              type: "POST",
                              url:  "<?=$sitelink?>ajax.php",
                              data : {type:'contact', contact_email:contact_email,contact_name:contact_name,contact_content:contact_content,contact_header:contact_header},
                              success: function(sonuc){
                                if(sonuc == 1){
                                    var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Mesajınız Alınmıştır. En Kısa Zamanda Geri Dönüş Yapılacaktır...</p></div>";   
                                   document.getElementById("uyari").innerHTML=newHTML;
                                }else if(sonuc==2){
                                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Mesaj Alınırken Sorun Oluştu !</p></div>";   
                                    document.getElementById("uyari").innerHTML=newHTML;
                                }else{
                                  alert(sonuc);
                                }
                              }
                          })                                             
              }

          }

        </script>
        <div id="uyari" class="uk-container"></div>
        <div class="uk-container">
        <div class="uk-grid-divider uk-child-width-expand@s" uk-grid>
              <div id="contact">
                <div><h2>İletişim</h2>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input" id="contactname" placeholder="Adınız Soyadınız" type="text">
                        </div>
                    </div>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            <input class="uk-input" id="contactemail" placeholder="Email" type="text">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: pencil"></span>
                            <input class="uk-input" id="contactheader" placeholder="Mesaj Başlığı" type="text">
                        </div>
                    </div>
                   <div class="uk-margin">
                        <div class="uk-inline">
                            <textarea id="contactcontent" class="uk-textarea" placeholder="Mesajınız..." rows="10" cols="80"></textarea>
                        </div>
                    </div>
                    <button onclick="contact()" class="uk-button uk-button-secondary">Gönder</button>
                </div>
             </div>

             <div>
               <h2>Sosyal Medyada Ben 😉</h2>
                  <ul class="uk-grid-small uk-child-width-1-2 uk-child-width-1-1@s uk-text-center" uk-sortable="handle: .uk-sortable-handle" uk-grid>
                      <li>
                          <div class="uk-card uk-card-default uk-card-body" style="background-color: #3b5998; color: #FFF;">
                              <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: facebook"></span><a href="http://facebook.com/baydoganmirac" class="uk-link-reset">Facebook</a>
                          </div>
                      </li>
                      <li>
                          <div class="uk-card uk-card-default uk-card-body" style="background-color:#00aced; color: #FFF;">
                              <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: twitter"></span><a href="http://twitter.com/baydoganmirac" class="uk-link-reset">Twitter</a>
                          </div>
                      </li>
                      <li>
                          <div class="uk-card uk-card-default uk-card-body" style="background-color:#9b6954; color: #FFF;">
                              <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: instagram"></span><a href="http://instagram.com/baydoganmirac" class="uk-link-reset">Instagram</a>
                          </div>
                      </li>
                      <li>
                          <div class="uk-card uk-card-default uk-card-body" style="background-color:#9cdaf1; color: #FFF;">
                              <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: github"></span><a href="https://github.com/baydoganmirac/" class="uk-link-reset">Github</a>
                          </div>
                      </li>
                      <li>
                          <div class="uk-card uk-card-default uk-card-body" style="background-color:#DB4437; color: #FFF;" >
                              <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: google-plus"></span><a href="https://plus.google.com/u/0/108463758787150180105" class="uk-link-reset">Google+</a>
                          </div>
                      </li>
                      <li>
                  </ul>               
             </div>
            </div>
            </div>