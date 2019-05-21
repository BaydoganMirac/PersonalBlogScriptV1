<?php
                $gelensef   = $_GET["sef"];
                $sor = mysql_query("SELECT * FROM article WHERE article_seo='$gelensef' LIMIT 1");
                $kayitlar=@mysql_fetch_assoc($sor);
                    $Article_image          = $kayitlar["article_image"];
                    $Article_seo            = $kayitlar["article_seo"];
                    $Article_date           = $kayitlar["article_date"];
                    $Article_title          = $kayitlar["article_title"];
                    $Article_category       = $kayitlar["article_category"];
                    $Article_content        = $kayitlar["article_content"];
                    $Article_readcount      = $kayitlar["article_readcount"];
                    $Article_numberofcomment= $kayitlar["numberofcomment"];
                    $Article_author         = $kayitlar["article_author"];
                    $Article_id             = $kayitlar["id"];
                    okunmaekle($Article_id);
?>
        <script type="text/javascript">
          $(function(){
            $(".cevapla").click(function(e){
              e.preventDefault();
              $("#yorumlar #commentcontent").focus();
              var yorumID = $(this).attr("comment-id");
              $("#yorumlar #replycommentid").val(yorumID);
            });
          });
        </script>
        <script type="text/javascript">
          function kayit(){
            var commentcontent  = $("#yorumlar #commentcontent").val();
            var replycommentid  = $("#yorumlar #replycommentid").val();
            var articleid  = $("#yorumlar #articleid").val();


                 if(commentcontent == "")
                  {
                   UIkit.notification({message: 'Lütfen Boş Alan Bırakmayınız...', status: 'danger'});

                  }else{
                          $.ajax(
                          {       
                              type: "POST",
                              url:  "<?=$sitelink?>ajax.php",
                              data : {type:'commentssave', commentcontent:commentcontent,replycommentid:replycommentid,articleid:articleid},
                              success: function(sonuc){
                                  if(sonuc == 1)
                                  {
                                      var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Yorumunuz Kaydedildi. Onaylanınca Yayımlanacaktır.</p></div>";   
                                     document.getElementById("uyari").innerHTML=newHTML;
                                  }else{
                                      var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Yorumunuz Kaydedilirken Hata Oluştu</p></div>";   
                                      alert(sonuc);
                                      document.getElementById("uyari").innerHTML=newHTML;                                      
                                  }  
                              }
                          })                                             
                  }

          }
        </script>
        <div class="uk-container">
          <ul class="uk-breadcrumb">
              <li><a href="<?=$sitelink?>">Ana Sayfa</a></li>
              <li><a href="<?=$sitelink?>blog.html"><?=$Article_category?></a></li>
              <li><span><?=$Article_title?></span></li>
          </ul>


          <article class="uk-article">

            <h1 class="uk-article-title"><a class="uk-link-reset" href=""><?=$Article_title?></a></h1>

            <p class="uk-article-meta"><span uk-icon="icon: user"></span> <a href="#"><?=$Article_author?></a> <span uk-icon="icon: calendar"></span><?=$Article_date?> <span uk-icon="icon: tag"></span> <a href="<?=$sitelink?>blog.html"><?=$Article_category?></a>              <span uk-icon="icon: users"></span><?=$Article_readcount?> Okunma <span uk-icon="icon: comments"></span> <?=$Article_numberofcomment?> Yorum</p>
                <div class="uk-panel">
                  <img class="uk-align-left uk-margin-remove-adjacent" src="<?=$sitelink?>img/article_img/<?=$Article_image?>" width="500" height="300" alt="<?=$Article_title?>">
                  <p class="uk-dropcap"><?=$Article_content?></p>
              </div>

        </article>
      </div>
        <div class="uk-container" style="margin-top: 40px;">
          <?php
          $soryorum = mysql_query("SELECT * FROM comments WHERE comments_articleid='$Article_id' && comments_confirmation=1 && comments_replyid=0 ORDER BY comments_datestamp DESC");
          while($yorum=@mysql_fetch_assoc($soryorum)){
              $Comments_usersid          = $yorum["comments_usersid"];
              $Comments_id          = $yorum["id"];
              $Comments_content           = $yorum["comments_content"];
              $Comments_date         = $yorum["comments_date"];
              $Comments_replyid       = $yorum["comments_replyid"];
              $kullanicicek = @mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id='$Comments_usersid' LIMIT 1"));

          ?>
        <ul class="uk-comment-list">
            <li>
                <article class="uk-comment uk-comment-primary uk-visible-toggle">
                    <header class="uk-comment-header uk-position-relative">
                        <div class="uk-grid-medium uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-comment-avatar uk-border-circle" src="
                                <?php
                                if($Comments_usersid==0){
                                  echo $sitelink."img/admin.png";
                                }else{
                                  echo $sitelink."img/avatar.jpg";
                                }
                                ?>" width="80" height="80" alt="">
                            </div>
                            <div class="uk-width-expand">
                                <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">
                                  <?php 
                                  if ($kullanicicek["id"]==0) {
                                    echo "Admin";
                                  } else {
                                    echo  $kullanicicek["users_username"];
                                  }
                                  
                                  ?>
                                </a></h4>
                                <p class="uk-comment-meta uk-margin-remove-top"><a class="uk-link-reset" href="#"><?=$Comments_date?></a></p>
                            </div>
                        </div>
                        <div class="uk-position-top-right uk-position-small uk-hidden-hover"><a comment-id="<?=$Comments_id?>" class="uk-link-muted cevapla" href="javascript:void(0)">Cevapla</a></div>
                    </header>
                    <div class="uk-comment-body">
                        <p><?=$Comments_content?></p>
                    </div>
                </article>
                <?php
                  $soraltyorum = mysql_query("SELECT * FROM comments WHERE comments_articleid='$Article_id' && comments_confirmation=1 && comments_replyid='$Comments_id' ORDER BY comments_datestamp DESC");
                  while($altyorum=@mysql_fetch_assoc($soraltyorum)){
                      $Commentss_usersid          = $altyorum["comments_usersid"];
                      $Commentss_id          = $altyorum["id"];
                      $Commentss_content           = $altyorum["comments_content"];
                      $Commentss_date         = $altyorum["comments_date"];
                      $Commentss_replyid       = $altyorum["comments_replyid"];
                      $kullanicicekalt = @mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id='$Commentss_usersid' LIMIT 1"));

                ?>
                <ul>
                    <li>
                        <article class="uk-comment uk-comment-primary uk-visible-toggle" style="margin-top: -50px;">
                            <header class="uk-comment-header uk-position-relative">
                                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto">
                                        <img class="uk-comment-avatar uk-border-circle" src="<?php
                                if($Commentss_usersid==0){
                                  echo $sitelink."img/admin.png";
                                }else{
                                  echo $sitelink."img/avatar.jpg";
                                }
                                ?>" width="80" height="80" alt="">
                                    </div>
                                    <div class="uk-width-expand">
                                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">                                  <?php 
                                  if ($Commentss_usersid==0) {
                                    echo "Admin";
                                  } else {
                                    echo  $kullanicicekalt["users_username"];
                                  }
                                  
                                  ?></a></h4>
                                        <p class="uk-comment-meta uk-margin-remove-top"><a class="uk-link-reset" href="#"><?=$Commentss_date?></a></p>
                                    </div>
                                </div>
                                <div class="uk-position-top-right uk-position-small uk-hidden-hover"><a comment-id="<?=$Commentss_id?>" class="uk-link-muted cevapla" href="javascript:void(0)">Cevapla</a></div>
                            </header>
                            <div class="uk-comment-body">
                                <p><?=$Commentss_content?></p>
                            </div>
                        </article>
                    </li>
                </ul>
                <?php
                  }
                ?>
            </li>
        </ul>
        <?php
        }
        ?>
      </div>

      <br/>
      <?php
       if(isset($_SESSION["kullanici"]) || isset($_SESSION["BaydoganMirac-Admin"])){
      ?>
      <div id="yorumlar" class="yorumlar uk-container uk-section uk-section-secondary uk-padding-small">
            <h1>Yorum Yapın</h1>
            <input id="replycommentid"  type="hidden" name="replycommentid" value="0">
            <input id="articleid"  type="hidden" name="articleid" value="<?=$Article_id?>">
            <textarea id="commentcontent" class="uk-textarea uk-margin-small" placeholder="Yorumunuz..." name="commentcontent"></textarea>
            <button onclick="kayit()" id="commentsubmit" class="uk-button uk-button-secondary">Gönder</button>
      </div>
        <div id="uyari" class="uk-container"></div>


      
      <?php
       }else{
        ?>
      <div uk-alert class="uk-container uk-alert-danger">Yorum Yapabilmek İçin Üye Olmanız Veya Giriş Yapmanız Gerekmektedir. <a href="<?=$sitelink?>kayit-ol-giris-yap.html">Kayıt Ol/Giriş Yap</a></div>


      <?php
     }
      ?>
