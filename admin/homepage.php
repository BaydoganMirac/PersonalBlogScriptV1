<?php  
$userscount = mysqli_num_rows(mysqli_query("SELECT * FROM users"));
$articlecount = mysqli_num_rows(mysqli_query("SELECT * FROM article"));
$commentcount_confirmation = mysqli_num_rows(mysqli_query("SELECT * FROM comments WHERE comments_confirmation='1'"));
$commentcount = mysqli_num_rows(mysqli_query("SELECT * FROM comments WHERE comments_confirmation='0'"));
$admincount = mysqli_num_rows(mysqli_query("SELECT * FROM admins"));
$visitorcount = mysqli_num_rows(mysqli_query("SELECT * FROM hit"));
$categorycount = mysqli_num_rows(mysqli_query("SELECT * FROM category"));
$adminusername = $_SESSION["BaydoganMirac-Admin"];
$adminshares = mysqli_num_rows(mysqli_query("SELECT * FROM article WHERE article_author='$adminusername'"));
$firstofcommentuser =mysqli_fetch_assoc(mysqli_query("SELECT * FROM users ORDER BY users_numberofcomment DESC LIMIT 1"));
?>
<center>    <h1>İstatistikler</h1></center>
<hr>
<div class="uk-container uk-margin-small">
    <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: users">Üyeler </span></h3>
            <p>Sitede kayıtlı <span class="uk-badge"><?=$userscount?></span> kullanıcı var.</p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: file-text">Yazılar </span></h3>
            <p>Sitede <span class="uk-badge uk-badge-secondary"><?=$articlecount?></span> tane yayımlanmış yazınız bulunmaktadır.</p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: comments">Yorumlar </span></h3>
            <p>Sitede <span class="uk-badge uk-badge-secondary"><?=$commentcount_confirmation+$commentcount?></span> tane yorum bulunmaktadır. Bu yorumların <span class="uk-badge uk-badge-secondary"><?=$commentcount_confirmation?></span> tanesi onaylanmış, <span class="uk-badge uk-badge-secondary"><?=$commentcount?></span> taneside onay beklemektedir.</p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: user">Adminler </span></h3>
            <p>Sitede yetkili <span class="uk-badge uk-badge-secondary"><?=$admincount?></span> admin var.</p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: users">Ziyaretçi Sayısı </span></h3>
            <p>Toplam tekil ziyaretçi sayınız <span class="uk-badge"><?=$visitorcount?></span>. </p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: pencil">Paylaşımlarınız  </span></h3>
            <p><?=$adminusername?> Toplamda <span class="uk-badge"><?=$adminshares?></span> yazı paylaşmış.</p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: bookmark">Kategoriler  </span></h3>
            <p>Sitede toplamda <span class="uk-badge"><?=$categorycount?></span> kataegori var.</p>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
            <h3 class="uk-card-title"><span uk-icon="icon: comment">En Fazla Yorum Yapan Üye </span></h3>
            <p>En fazla yorum yapan üyemiz <span class="uk-badge"><?=$firstofcommentuser["users_username"]?></span>. <span class="uk-badge"><?=$firstofcommentuser["users_numberofcomment"]?></span> Yorum sayısı ile birincidir.</p>
        </div>
    </div>
    </div>
</div>
