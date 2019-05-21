        <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="animation: fade" style="margin-top: -15px;">

            <ul class="uk-slideshow-items">
                <?php 
                $sqlslide = mysql_query("SELECT * FROM slideshow ORDER BY id DESC");
                    while($slide=@mysql_fetch_assoc($sqlslide)){
                ?>
                <li>
                    <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                        <img src="<?=$sitelink?>img/slideshow/<?=$slide['slideimage']?>" alt="" uk-cover>
                    </div>
                </li>
                <?php 
                }
                ?>
            </ul>

            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

        </div>        
        <div class="uk-container uk-margin-large">
            <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top" style="background-color: #333; height: 800px;">
                <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
                    <h1 uk-parallax="opacity: 0,1; y: -100,0; scale: 2,1; viewport: 0.5;">Becerilerim 🤓</h1>
                    <p uk-parallax="opacity: 0,1; y: 100,0; scale: 0.5,1; viewport: 0.5;">
                        <br>
                        PHP <progress class="uk-progress" value="90" max="100" ></progress><br>
                        HTML<progress class="uk-progress" value="100" max="100" ></progress><br>
                        CSS <progress class="uk-progress" value="95" max="100" ></progress><br>
                        JavaScript <progress class="uk-progress" value="40" max="100" ></progress><br>
                        Java <progress class="uk-progress" value="35" max="100" ></progress><br>
                        C <progress class="uk-progress" value="25" max="100" ></progress><br>
                    </p>
                </div>
            </div>
            <div class="uk-container uk-text-center uk-section-default uk-margin-large">
                                <h2>Neler Yapabilirim ?</h2>
Yepyeni Tasarım düzeniyle ve birbirinden farklı tasarımlarla hedeflerinize ulaşmanız için uğraşıyorum.
            </div>
            <div class="uk-child-width-expand@s uk-margin-large uk-text-center" uk-grid="masonart: true; parallax: 150">

                <div><span uk-icon="icon :  code; ratio: 4;" style="color: #F00;"></span><h3>Web Tasarım</h3><br>Birbirinden farklı tasarımlar ile yepyeni sayfalar sizi bekliyor</div>
                <div><span uk-icon="icon :  paint-bucket; ratio: 4;" style="color: #F00;"></span><h3>Logo Tasarım</h3><br>İşinizde hayal gücünü zorlayacak logolar sizi bekliyor</div>
                <div><span uk-icon="icon :  world; ratio: 4;" style="color: #F00;"></span><h3>SEO</h3><br>Tabi bir sitenin olmazsa olmazı SEO. Siteniz aktif olduktan sonra ilk sıralara çıkması için uğraşıyorum.</div>
            </div>
        </div>
        <div class="uk-container">
        <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-grid-match uk-grid-large" uk-grid>
            <?php
            $sor = mysql_query("SELECT * FROM article ORDER BY RAND() LIMIT 6 ");
                while($row=@mysql_fetch_assoc($sor)){
            
                $Article_image          = $row["article_image"];
                $Article_seo            = $row["article_seo"];
                $Article_date           = $row["article_date"];
                $Article_title          = $row["article_title"];
                $Article_category       = $row["article_category"];
                $Article_content        = $row["article_content"];
                $Article_readcount      = $row["article_readcount"];
            ?>
            <div class="uk-text-center"  uk-tooltip="Devamını Okumak İçin Tıklayınız">

                <a href="<?=$sitelink?><?php echo seo($Article_category);?>/<?=$Article_seo?>.html" class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <img src="<?=$sitelink?>img/article_img/<?=$Article_image?>" alt="<?=$Article_title?>">
                    <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                        <p class="uk-h4 uk-margin-remove">
                        <h4><?=$Article_title?></h4>
                        <?php echo substr($Article_content,0,100);?>...

                        </p>
                    </div>
                </a>
            </div>
            <?php 
            }
            ?>
        </div>
        </div>