<?php 
require "../src/config.db.php";
require "../src/functions.php";
session_start();
ob_start();
if($_POST){
		if($_POST["type"]=='signin'){
			$admin_username = trim(htmlspecialchars(addslashes($_POST["admin_username"])));
			$admin_pw = md5(trim(htmlspecialchars(addslashes($_POST["admin_password"]))));
			$baglan = mysql_query("SELECT * FROM admins WHERE adminusername='$admin_username' and adminpassword='$admin_pw' ORDER BY id DESC LIMIT 1");
			if(mysql_num_rows($baglan)){
				$cekverileri = mysql_fetch_assoc($baglan);
				$_SESSION["BaydoganMirac-Admin"] = $cekverileri["adminusername"];
				echo "1";
			}else{
				echo "2";
			}
		}
	// Listeleme
  if(@$_POST["type"] == "bloglist"){
    $activePage = $_POST["activePage"];
    $pageCount = $_POST["pageCount"];
    $baslangic = ($activePage-1) * $pageCount;
    
    $sor = mysql_query("SELECT * FROM article ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
        while($row=@mysql_fetch_assoc($sor)){
    		$Article_id				= $row["id"];
	    	$Article_image          = $row["article_image"];
            $Article_seo            = $row["article_seo"];
            $Article_author          = $row["article_author"];
            $Article_date           = $row["article_date"];
            $Article_title          = $row["article_title"];
            $Article_category       = $row["article_category"];
            $Article_content        = $row["article_content"];
            $Article_readcount      = $row["article_readcount"];
            $Article_numberofcomment      = $row["numberofcomment"];

            ?>

			<div class="uk-section uk-section-secondary uk-margin-small uk-padding-large">
			    <div class="uk-container">
			        <h3><?=$Article_title?></h3>
			        <span class="uk-float-right">
			        	<ul class="uk-iconnav">
						    <li><a href="<?=$sitelink?>admin/3-yaziekle.html" uk-icon="icon: plus" uk-tooltip="Yeni Yazı Ekle"></a></li>
						    <li><a href="<?=$sitelink?>admin/index.php?id=<?=$Article_id?>&page=4" uk-icon="icon: file-edit" uk-tooltip="Yazıyı Düzenle"></a></li>
						    <li><a href="#" onclick="articledelete(<?=$Article_id?>);" uk-icon="icon: trash" uk-tooltip="Yazıyı Sil"></a></li>
						   
						</ul>

			        </span>
			        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
			            <div>
			                <p><img src="<?=$sitelink?>img/article_img/<?=$Article_image?>"></p>
			            </div>
			            <div>
			                <p><?php echo substr($Article_content,0,100);?>...</p>
			            </div>
			            <div>
			            	<span uk-icon="icon: user"><?=$Article_author?>  </span><span uk-icon="icon: calendar"><?=$Article_date?>  </span> <span uk-icon="icon: tag"><?=$Article_category?>  </span><span uk-icon="icon: users"><?=$Article_readcount?>  </span><span uk-icon="icon: comments"><?=$Article_numberofcomment?>  </span>
			            </div>
			        </div>
			    </div>
			</div>
            <?php
	    
   	 }
	}
	// Yazı Silme	
    if($_POST["type"]=='articledelete'){
			$gelenid		=	$_POST["article_id"];
			$kaydabak		=	mysql_fetch_assoc(mysql_query("SELECT * FROM article WHERE id='$gelenid'"));
			$makaleresmine	=	$kaydabak["article_image"];
			$dosyayolu		= 	"../img/article_img/".$makaleresmine;
			$resimsil		=	@unlink("$dosyayolu");
				if($resimsil){
					$kayitsil	=	mysql_query("DELETE FROM article WHERE id='$gelenid' ORDER BY id ASC LIMIT 1");
						if($kayitsil){
							echo "1";
						}else{
							echo "2";
						}
				}else{
					echo "Resim Silinirken Hata";
				}
		}
		// Yazı Güncelleme
		if($_POST["type"] == 'editarticle'){
			$articletitle 		= htmlspecialchars(addslashes($_POST["articletitle"]));
			$articleid 			= $_POST["articleid"];
			$articlecontent 	= $_POST["articlecontent"];
			$lastcategory	 	= htmlspecialchars(addslashes($_POST["lastcategory"]));
			$newcategory	 	= htmlspecialchars(addslashes($_POST["newcategory"]));
			$articleseo 		= seo($articletitle);
			$update				= mysql_query("UPDATE article SET article_title='$articletitle', article_content='$articlecontent', article_seo='$articleseo'  WHERE id='$articleid' ORDER BY id ASC LIMIT 1");
			if($update){
				if($lastcategory==$newcategory){
					echo "1";
				}else{
					$updatecategory = mysql_query("UPDATE article SET article_category='$newcategory' WHERE id='$articleid' ORDER BY id ASC LIMIT 1");
					if($updatecategory){
						echo "1";
					}else{
						echo "2 Kategori Güncellenmedi.";
					}
				}
			}else{
				echo "2 Başarısız Güncelleme";
			}

		}
    


/*
									$makaleyorumekle = mysql_query("UPDATE article SET numberofcomment=numberofcomment+1 WHERE id='$articleid' ORDER BY id ASC LIMIT 1");
										if($makaleyorumekle){
											echo "1";
										}else{
											echo "HATA MAKALEYE YORUM SAYISI EKLENMEDİ";
										}

*/
	// Kullanıcı Listeleme
  if(@$_POST["type"] == "userlist"){
    $activePage = $_POST["activePage"];
    $pageCount = $_POST["pageCount"];
    $baslangic = ($activePage-1) * $pageCount;
    
    $sor = mysql_query("SELECT * FROM users ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
        while($row=@mysql_fetch_assoc($sor)){
    		$users_id				= $row["id"];
	    	$users_username         = $row["users_username"];
            $users_password         = $row["users_password"];
            $users_date          	= $row["users_date"];
            $users_ipno             = $row["users_ipno"];
            $users_website          = $row["users_website"];
            $users_numberofcomment  = $row["users_numberofcomment"];
            $users_email     	    = $row["users_email"];

            ?>

			<div class="uk-section uk-section-secondary uk-margin-small uk-padding-large">
			    <div class="uk-container">
			        <h3><?=$users_username?></h3>
			        <span class="uk-float-right" style="list-style: none;">
						    <li><a href="#" onclick="usersdelete(<?=$users_id?>);" uk-icon="icon: trash" ratio="8" uk-tooltip="Kullanıcıyı Sil"></a></li>
			        </span>
			        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
			            <div>
			                <p><img src="<?=$sitelink?>img/avatar.jpg"></p>
			            </div>
			            <div style="text-align: right;">
			            	<span uk-icon="icon: calendar"><?=$users_date?>  </span>
			            	<span uk-icon="icon: location"><?=$users_ipno?>  </span>
			            	<span uk-icon="icon: code"><?=$users_website?>  </span>
			            	<span uk-icon="icon: comments"><?=$users_numberofcomment?>  </span>
			            	<span uk-icon="icon: mail"><?=$users_email?> </span>
			            </div>
			    	</div>
			    </div>

			</div>
            <?php
	    
   	 }
	}
	// Kullanıcı Silme	
    if($_POST["type"]=='usersdelete'){
			$gelenid		=	$_POST["userid"];
			$kayitsil	=	mysql_query("DELETE FROM users WHERE id='$gelenid' ORDER BY id ASC LIMIT 1");
				if($kayitsil){
					echo "1";
				}else{
					echo "2";
				}
		}
		if($_POST["type"] == 'editsettings'){
			$sitetitle			= htmlspecialchars(addslashes($_POST["sitetitle"]));      
			$sitedescription	= htmlspecialchars(addslashes($_POST["sitedescription"]));
			$sitekeywords   	= htmlspecialchars(addslashes($_POST["sitekeywords"]));
			$sitemail           = $_POST["sitemail"];
			$smtphost       	= $_POST["smtphost"];
			$smtpport       	= $_POST["smtpport"];
			$encryption     	= $_POST["encryption"];
			$smtpusername   	= $_POST["smtpusername"];
			$smtppassword   	= $_POST["smtppassword"];
			$aboutme			= addslashes($_POST["aboutme"]);
			$update				= mysql_query("UPDATE settings SET title='$sitetitle', description='$sitedescription', keywords='$sitekeywords', email='$sitemail' , smtphost='$smtphost', smtpport='$smtpport', encryption='$encryption', smtpusername='$smtpusername', smtppassword='$smtppassword', aboutme='$aboutme'  WHERE id=1 ORDER BY id ASC LIMIT 1");
			if($update){
				echo "1";
			}else{
				echo "2 Başarısız Güncelleme";
			}

		}
		// Admin Listeleme
		  if(@$_POST["type"] == "adminlist"){
		    $activePage = $_POST["activePage"];
		    $pageCount = $_POST["pageCount"];
		    $baslangic = ($activePage-1) * $pageCount;
		    
		    $sor = mysql_query("SELECT * FROM admins ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
		        while($row=@mysql_fetch_assoc($sor)){
		    		$adminid				= $row["id"];
			    	$adminname         		= $row["adminname"];
		            $adminusername        	= $row["adminusername"];
		            ?>

				    <li>
				    	<legend><b>Yönetici Bilgileri</b></legend>
				    	<span>Kullanıcı Adı <b><?=$adminusername?></b></span><br>
				    	<span>Adı Soyadı <b><?=$adminname?></b></span>
				    	<a class="uk-float-right" onclick="deleteadmin(<?=$adminid?>);" uk-icon="icon: trash"></a>
				    </li>
		            <?php
			    
		   	 }
			}
			// Admin Silme	
		    if($_POST["type"]=='admindelete'){
					$gelenid		=	$_POST["adminid"];
					if ($gelenid == 1) {
						echo "Silinemedi";
					}else{
						$kayitsil	=	mysql_query("DELETE FROM admins WHERE id='$gelenid' ORDER BY id ASC LIMIT 1");
						if($kayitsil){
							echo "1";
						}else{
							echo "2";
						}
					}
			}
			// Admin Ekleme
			if($_POST["type"]=="addadmin"){
				$adminusername = htmlspecialchars($_POST["adminusername"]);
				$adminname = htmlspecialchars($_POST["adminname"]);
				$adminpassword = md5(htmlspecialchars($_POST["adminpassword"]));
				$sorgu = mysql_num_rows(mysql_query("SELECT * FROM admins WHERE adminusername='$adminusername'"));
				if($sorgu==0){
					$kaydet = mysql_query("INSERT INTO admins (adminusername, adminname, adminpassword) VALUES ('$adminusername', '$adminname', '$adminpassword')");
					if($kaydet){
						echo "1";
					}else{
						echo "3";
					}
				}else{
					echo "2";
				}
			}
			// Kategori Ekle
			if($_POST["type"] == "addcategory"){
				$categoryname = htmlspecialchars(trim(addslashes($_POST["categoryname"])));
				$add = mysql_query("INSERT INTO category (categoryname) VALUES ('$categoryname')");
					if($add){
						echo "1";
					}else{
						echo "2";
					}
			}
		// Kategori Listeleme
		  if(@$_POST["type"] == "categorylist"){
		    $activePage = $_POST["activePage"];
		    $pageCount = $_POST["pageCount"];
		    $baslangic = ($activePage-1) * $pageCount;
		    
		    $sor = mysql_query("SELECT * FROM category ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
		        while($row=@mysql_fetch_assoc($sor)){
		    		$categoryid				= $row["id"];
		    		$categoryname			= $row["categoryname"];
		            ?>

				    <li>
				    	<span><?=$categoryname?><b>
				    		<?php 
				    		$say  = mysql_num_rows(mysql_query("SELECT * FROM article WHERE article_category='$categoryname'"));
				    		echo $say;
				    		?>
				    	</b></span>
				    	<a class="uk-float-right" onclick="deletecategory(<?=$categoryid?>);" uk-icon="icon: trash"></a>
				    </li>
		            <?php
			    
		   	 }
			}
			// Kategori Silme
			if($_POST["type"]=="deletecategory"){
				$categoryid = $_POST["categoryid"];
				$delete = mysql_query("DELETE FROM category WHERE id='$categoryid' ORDER BY id DESC LIMIT 1");
					if($delete){
						echo "1";
					}else{
						echo "2";
					}
			}
			// Resim Güncelleme
			if($_POST["type"]=="updateimage"){
				if($_FILES["file"]["tmp_name"] && $_FILES["file"]["name"]){
					$articleid = $_POST["article_id"];
					$maxSize = 2*1048576;
					$extension = substr($_FILES["file"]["name"],-4,4);
					$newFileName = rand(0,999999999).$extension;
					$filePath = "../img/article_img/".$newFileName;
						if ($_FILES["file"]["size"]>$maxSize) {
							echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>2 MB'dan Fazla Fotoğraf Yükleyemezsin</p></div>";
						}else{
							if($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/jpg" || $_FILES["file"]["type"]=="image/gif"){
									if(is_uploaded_file($_FILES["file"]["tmp_name"])){
										$ok = move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
										if ($ok) {
											$picture = mysql_fetch_assoc(mysql_query("SELECT * FROM article WHERE id='$articleid' ORDER BY id DESC LIMIT 1"));

											$oldpicdelete = unlink("../img/article_img/".$picture["article_image"]);
											if ($oldpicdelete) {
												$articleupdate = mysql_query("UPDATE article SET article_image='$newFileName' WHERE id='$articleid' ORDER BY id DESC LIMIT 1");
												if ($articleupdate) {
													echo "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Fotoğraf Güncellemesi Başarılı</p></div>";
												} else {
													echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Fotoğraf Güncellenemedi</p></div>";
												}
											} else {
												echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Eski Fotoğraf Silinemedi</p></div>";
											}
																						
										} else {
											echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Fotoğraf Yüklemesi Başarısız</p></div>";
										}
										
									}else{
										echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Dosya Seçiniz</p></div>";
									}
							}else{
								echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Sadece Resim Formatı Yükleyebilirsiniz</p></div>";
							}

						}
				}else{
					echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Dosya Seçiniz</p></div>";
				}
			}
			// Yazı Ekleme
			if($_POST["type"]== "addarticle"){
				/*
				Hata kodu     - Sonuc
				1				Başarılı
				2 				Fotoğraf Boyutu 2 MB Yüksek
				3 				Sadece Fotoğraf Yükleyebilirsiniz
				4				Lütfen Fotoğraf Seçiniz
				5				Yükleme Başarısız
				6				Veritabanına Kaydedilemedi
				*/
					$maxSize = 2*1048576;
					$extension = substr($_FILES["file"]["name"],-4,4); // 
					$newFileName = rand(0,999999999).$extension;
					$filePath = "../img/article_img/".$newFileName;
					if ($_FILES["file"]["size"]>$maxSize) {
						echo "2";
					}else{
						if($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/jpg" || $_FILES["file"]["type"]=="image/gif"){
							if(is_uploaded_file($_FILES["file"]["tmp_name"])){
								$upload = move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
									if($upload){
										$articletitle 	= @trim(@strip_tags(@addslashes($_POST["articletitle"])));
										$category  	  	= $_POST["category"];
										$articlecontent = @trim(addslashes($_POST["articlecontent"]));
										$datestamp 		= time();
										$date			=	date("d.m.Y H:i:s");
										$outhor 		= $_SESSION["BaydoganMirac-Admin"];
										$seo 			= seo($articletitle);
										$save = mysql_query("INSERT INTO article (article_title, article_author, article_content, article_image, article_datestamp, article_date, article_seo, article_category, article_readcount, numberofcomment) VALUES ('$articletitle', '$outhor', '$articlecontent', '$newFileName', '$datestamp', '$date', '$seo', '$category', 0, 0)");
											if($save){
												echo "1";
											}else{
												echo "6";
											}
									}else{
										echo "5";
									}
							}else{
								echo "4";
							}
						}else{
							echo "3";
						}
					}
			}
			// Slide Show Listeleme
			if(@$_POST["type"] == "slideshowlist"){
		    $activePage = $_POST["activePage"];
		    $pageCount = $_POST["pageCount"];
		    $baslangic = ($activePage-1) * $pageCount;
		    
		    $sor = mysql_query("SELECT * FROM slideshow ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
		        while($row=@mysql_fetch_assoc($sor)){
		    		$id				= $row["id"];
		    		$image			= $row["slideimage"];
		            ?>
					<div style="text-align: center;">
				        <a class="uk-inline" href="<?=$sitelink?>img/slideshow/<?=$image?>" data-caption='<a href="" class="uk-link-muted" onclick="deleteslideshow(<?=$id?>);" uk-icon="icon: trash; ratio: 3;"></a>'>
				            <img src="<?=$sitelink?>img/slideshow/<?=$image?>" alt="">
				        </a>
				    </div>

		            <?php
			    
		   	 }
			}
			// Slide Show Silme
			if($_POST["type"]=="deleteslideshow"){
				$slideid = $_POST["slideid"];
				$pic = mysql_fetch_assoc(mysql_query("SELECT * FROM slideshow WHERE id='$slideid' ORDER BY id DESC LIMIT 1"));
				$path = "../img/slideshow/".$pic["slideimage"];
				$deletepicture = unlink($path);
				if ($deletepicture) {
						$delete = mysql_query("DELETE FROM slideshow WHERE id='$slideid' ORDER BY id DESC LIMIT 1");
					if($delete){
						echo "1";
					}else{
						echo "2";
					}
				} else {
					echo "3";
				}
				
			}	
			// Slide Show Foto Ekleme
			if($_POST["type"]=="addslideshow"){
				if($_FILES["file"]["tmp_name"] && $_FILES["file"]["name"]){
					$maxSize = 2*1048576;
					$extension = substr($_FILES["file"]["name"],-4,4);
					$newFileName = rand(0,999999999).$extension;
					$filePath = "../img/slideshow/".$newFileName;
						if ($_FILES["file"]["size"]>$maxSize) {
							echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>2 MB'dan Fazla Fotoğraf Yükleyemezsin</p></div>";
						}else{
							if($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/jpg" || $_FILES["file"]["type"]=="image/gif"){
									if(is_uploaded_file($_FILES["file"]["tmp_name"])){
										$ok = move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
										if ($ok) {
											$DBSave = mysql_query("INSERT INTO slideshow (slideimage) VALUES ('$newFileName')");
												if ($DBSave) {
													echo "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Slayt Başarıyla Yüklendi</p></div>";
												} else {
													echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Slaty Yüklemesi Başarısız</p></div>";
												}																						
										} else {
											echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Fotoğraf Yüklemesi Başarısız</p></div>";
										}
										
									}else{
										echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Dosya Seçiniz</p></div>";
									}
							}else{
								echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Sadece Resim Formatı Yükleyebilirsiniz</p></div>";
							}
						}
				}else{
					echo "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Dosya Seçiniz</p></div>";
				}
			}
			// Onaylı Yorum Listeleme
		  if(@$_POST["type"] == "cofirmationcomments"){
		    $activePage = $_POST["activePage"];
		    $pageCount = $_POST["pageCount"];
		    $baslangic = ($activePage-1) * $pageCount;
		    
		    $sor = mysql_query("SELECT * FROM comments WHERE comments_confirmation=1 ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
		        while($row=@mysql_fetch_assoc($sor)){
		        	$commentid				= $row["id"];
		        	$comments_articleid		= $row["comments_articleid"];
		        	$article 				= mysql_fetch_assoc(mysql_query("SELECT * FROM article WHERE id='$comments_articleid' ORDER BY id DESC LIMIT 1"));
		        	$comments_usersid		= $row["comments_usersid"];
		        	$user 					= mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id='$comments_usersid' ORDER BY id DESC LIMIT 1"));
		        	$comments_content		= $row["comments_content"];
		        	$comments_date			= $row["comments_date"];
		        	$comments_datestamp			= $row["comments_datestamp"];
		        	$comments_replyid		= $row["comments_replyid"];
		        	$now 					= date("d.m.Y H:i:s");
		            ?>
						<div class="uk-comment uk-margin-small uk-comment-primary">
					    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
					        <div class="uk-width-auto">
					            <img class="uk-comment-avatar" src="<?php
                                if($user["id"]==0){
                                  echo $sitelink."img/admin.png";
                                }else{
                                  echo $sitelink."img/avatar.jpg";
                                }
                                ?>" width="80" height="80" alt="">
					        </div>
					        <div class="uk-width-expand">
					            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#"><?php 
					            	if ($comments_usersid==0) {
					            		echo "Admin";
					            	} else {
										echo $user["users_username"];
					            	}
					            	
					             ?></a></h4>
					            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
					                <li><a href="#"><?php if (tarihfarki($comments_datestamp) ==0) {
					                	echo "Bugün";
					                } else {
					                	echo tarihfarki($comments_datestamp)." Gün Önce";
					                }
					                ?></a></li>
					                <li><a href="#" uk-icon="close" onclick="unconfirmcomment(<?=$commentid?>,<?=$comments_articleid?>);" uk-tooltip="Yorum Onayını Kaldır" style="margin-right: 20px;"></a> <a href="#" uk-tooltip="Yorumu Sil" onclick="commentdelete(<?=$commentid?>,<?=$comments_articleid?>);" uk-icon="trash"></a></li>
					            </ul>
					        </div>
					    </header>
					    <div class="uk-comment-body">
					        <p><?=$comments_content?><br><b>Yorum Yapılan Makale Başlığı:</b> <?=$article["article_title"]?></p>
					    </div>
						</div>
		            <?php
			    
		   	 }
			}
			// Onaysız Yorum Listeleme
		  if(@$_POST["type"] == "comments"){
		    $activePage = $_POST["activePage"];
		    $pageCount = $_POST["pageCount"];
		    $baslangic = ($activePage-1) * $pageCount;
		    
		    $sor = mysql_query("SELECT * FROM comments WHERE comments_confirmation=0 ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
		        while($row=@mysql_fetch_assoc($sor)){
		        	$commentid				= $row["id"];
		        	$comments_articleid		= $row["comments_articleid"];
		        	$article 				= mysql_fetch_assoc(mysql_query("SELECT * FROM article WHERE id='$comments_articleid' ORDER BY id DESC LIMIT 1"));

		        	$comments_usersid		= $row["comments_usersid"];
		        	$user 					= mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id='$comments_usersid' ORDER BY id DESC LIMIT 1"));
		        	$comments_content		= $row["comments_content"];
		        	$comments_date			= $row["comments_date"];
		        	$comments_datestamp			= $row["comments_datestamp"];
		        	$comments_replyid		= $row["comments_replyid"];
		            ?>
						<div class="uk-comment uk-margin-small uk-comment-primary">
					    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
					        <div class="uk-width-auto">
					            <img class="uk-comment-avatar" src="<?php
                                if($user["id"]==0){
                                  echo $sitelink."img/admin.png";
                                }else{
                                  echo $sitelink."img/avatar.jpg";
                                }
                                ?>" width="80" height="80" alt="">
					        </div>
					        <div class="uk-width-expand">
					            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#"><?php 
					            	if ($comments_usersid==0) {
					            		echo "Admin";
					            	} else {
										echo $user["users_username"];
					            	}
					            	
					             ?></a></h4>
					            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
					                <li><a href="#"><?php if (tarihfarki($comments_datestamp) ==0) {
					                	echo "Bugün";
					                } else {
					                	echo tarihfarki($comments_datestamp)." Gün Önce";
					                }
					                ?></a></li>
					                <li><a href="#" uk-icon="check" onclick="confirmcomment(<?=$commentid?>,<?=$comments_articleid?>);" uk-tooltip="Yorumu Onayla" style="margin-right: 20px;"></a> <a href="#" uk-tooltip="Yorumu Sil" onclick="commentdelete(<?=$commentid?>,<?=$comments_articleid?>);" uk-icon="trash"></a></li>
					            </ul>
					        </div>
					    </header>
					    <div class="uk-comment-body">
					        <p><?=$comments_content?><br><b>Yorum Yapılan Makale Başlığı:</b> <?=$article["article_title"]?></p>
					    </div>
						</div>
		            <?php
			    
		   	 }
			}
			// Yorum Silme
			if($_POST["type"]=="commentdelete"){
				$commentid = $_POST["commentid"];
				$articleid = $_POST["articleid"];

			$sql = mysql_fetch_assoc(mysql_query("SELECT * FROM comments WHERE id='$commentid' ORDER BY id DESC LIMIT 1"));

					if($sql["comments_confirmation"]==1){
					$articleupdate = mysql_query("UPDATE article SET numberofcomment=numberofcomment+1 WHERE id='$articleid' ORDER BY id ASC LIMIT 1");
						if ($articleupdate) {
							$update = mysql_query("UPDATE comments SET comments_replyid='0' WHERE comments_replyid='$commentid'");
							if ($update) {
								$delete = mysql_query("DELETE FROM comments WHERE id='$commentid' ORDER BY id DESC LIMIT 1");
								if ($delete) {
									echo "1";
								} else {
									echo "4";
								}
							} else {
								echo "2";
							}
						} else {
							echo "6";
						}						
					}else{
						$update = mysql_query("UPDATE comments SET comments_replyid='0' WHERE comments_replyid='$commentid'");
						if ($update) {
							$delete = mysql_query("DELETE FROM comments WHERE id='$commentid' ORDER BY id DESC LIMIT 1");
							if ($delete) {
								echo "1";
							} else {
								echo "4";
							}
						} else {
							echo "2";
						}
					}
			}
			// Yorum Onaylama
			if($_POST["type"]=="confirmcomment"){
				$articleid = $_POST["articleid"];
				$commentid = $_POST["commentid"];
				$update = mysql_query("UPDATE comments SET comments_confirmation=1 WHERE id='$commentid' ORDER BY id DESC LIMIT 1");
				if ($update) {
					$articleupdate = mysql_query("UPDATE article SET numberofcomment=numberofcomment+1 WHERE id='$articleid' ORDER BY id ASC LIMIT 1");
						if ($articleupdate) {
							echo "1";
						} else {
							echo "3";
						}
				} else {
					echo "2";
				}
				
			}
			// Yorum Onay Kaldır
			if($_POST["type"]=="unconfirmcomment"){
				$commentid = $_POST["commentid"];
				$articleid = $_POST["articleid"];
				$update = mysql_query("UPDATE comments SET comments_confirmation=0 WHERE id='$commentid' ORDER BY id DESC LIMIT 1");
				if ($update) {
					$articleupdate = mysql_query("UPDATE article SET numberofcomment=numberofcomment-1 WHERE id='$articleid' ORDER BY id ASC LIMIT 1");
						if ($articleupdate) {
							echo "1";
						} else {
							echo "3";
						}
				} else {
					echo "2";
				}
				
			}

}
	?>
