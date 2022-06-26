<?php
use PHPMailer\PHPMailer\PHPMailer;
require "src/config.db.php";
require "src/functions.php";
require "src/PHPMailer.php";
require "src/SMTP.php";
require "src/Exception.php";

session_start();
ob_start();
if($_POST){
  if(@$_POST["type"] == "bloglist"){
    $activePage = $_POST["activePage"];
    $pageCount = $_POST["pageCount"];
    $baslangic = ($activePage-1) * $pageCount;
    
    $sor = mysqli_query("SELECT * FROM article ORDER BY id DESC LIMIT {$baslangic},{$pageCount}");
        while($row=@mysqli_fetch_assoc($sor)){
    	
            $Article_seo            = $row["article_seo"];
            $Article_date           = $row["article_date"];
            $Article_title          = $row["article_title"];
            $Article_category       = $row["article_category"];
            $Article_content        = $row["article_content"];
            $Article_readcount      = $row["article_readcount"];
            ?>
            	<li data-category="<?=seo($Article_category)?>" class="uk-card uk-card-body uk-card-secondary" style="margin: 5px;" >
		            <h3 class="uk-card-title uk-text-uppercase"><?=$Article_title?></h3>
		            <a class="uk-text-small uk-link-reset"><?=$Article_category?></a>
		            <p class="uk-card-content"><?php echo substr($Article_content,0,100);?>...</pa>
		            <hr>
		            <a class="uk-card-footer uk-text-bold uk-link-reset" href="<?=$sitelink?><?php echo seo($Article_category);?>/<?=$Article_seo?>.html">Devamını Oku</a>
		         </li>
            <?php
	    
    }
    
  }
    if($_POST["type"] == "commentssave"){
		$commentcontent = $_POST["commentcontent"];
		$replycommentid = $_POST["replycommentid"];
		$articleid = $_POST["articleid"];
		if(isset($replycommentid) && isset($commentcontent) && isset($articleid)){
					$tarihdamgasi		=	time();
					$tarih				=	date("d.m.Y");
					$commentcontentedit	=	@trim(@strip_tags(@addslashes($_POST["commentcontent"])));
					$kullaniciadi 		= 	@$_SESSION["BaydoganMirac-Admin"];
					$kullaniciadi		= 	@$_SESSION["kullanici"];
						if(($commentcontent=="")){
							echo "HATA Yorum Alınamadı";
						}else{
							if(@$_SESSION["BaydoganMirac-Admin"]){
								$kayityap	=	@mysqli_query("INSERT INTO comments (comments_articleid, comments_usersid, comments_content, comments_date, comments_datestamp, comments_confirmation, comments_replyid) values ('$articleid', '0', '$commentcontentedit', '$tarih', '$tarihdamgasi', '0', '$replycommentid')");
								if($kayityap){
									echo "1";
								}else{
									echo "2";
								}
							}else{
							$kullanicibul = @mysqli_fetch_assoc(mysqli_query("SELECT * FROM users WHERE users_username='".$_SESSION["kullanici"]."' LIMIT 1"));
							$kayityap	=	@mysqli_query("INSERT INTO comments (comments_articleid, comments_usersid, comments_content, comments_date, comments_datestamp, comments_confirmation, comments_replyid) values ('$articleid', '".$kullanicibul["id"]."', '$commentcontentedit', '$tarih', '$tarihdamgasi', '0', '$replycommentid')");
								if($kayityap){
									$kaydetyorum = mysqli_query("UPDATE users SET users_numberofcomment=users_numberofcomment+1 WHERE 
										users_username='$kullaniciadi' ORDER BY id ASC LIMIT 1");
									if($kaydetyorum){
										echo "1";
									}else{
										echo "HATA YORUM KULLANICIYA EKLENMEDİ";
									}
								}else{
										echo "HATA Yorum Alınamadı";
									}							}
						}			
		}else{
			echo "HATA Yorum Alınamadı";

		}			
	}

		if($_POST["type"]=='signin'){
			$signin_email = trim(htmlspecialchars(addslashes($_POST["userin_email"])));
			$signin_pw = md5(trim(htmlspecialchars(addslashes($_POST["userin_password"]))));
			$baglan = mysqli_query("SELECT * FROM users WHERE users_email='$signin_email' and users_password='$signin_pw' ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($baglan)){
				$cekverileri = mysqli_fetch_assoc($baglan);
				$_SESSION["kullanici"] = $cekverileri["users_username"];
				echo "1";
			}else{
				echo "2";
			}
		}


		if($_POST["type"]=='signup'){
			$signup_email = trim(htmlspecialchars(addslashes($_POST["userup_email"])));
			$signup_username = trim(htmlspecialchars(addslashes($_POST["userup_username"])));
			$signup_pw = md5(trim(htmlspecialchars(addslashes($_POST["userup_password"]))));
			$signup_website = trim(htmlspecialchars($_POST["userup_website"]));
			$tarihdamgasi		=	time();
			$tarih				=	date("d.m.Y H:i:s");
			$ip = GetIP();
			$kullanicisor = mysqli_num_rows(mysqli_query("SELECT * FROM users WHERE users_username='$signup_username' and users_email='$signup_email'"));
			if($kullanicisor==0){
				$kaydet = mysqli_query("INSERT INTO users (users_username, users_password, users_datestamp, users_date, users_ipno, users_website, users_numberofcomment, users_email) VALUES ('$signup_username', '$signup_pw', '$tarihdamgasi', '$tarih', '$ip', '$signup_website', '0', '$signup_email')");
				if($kaydet){
					echo "1";
				}else{
					echo "2";
				}
			}else{
				echo "3";
			}
		}

		if($_POST["type"]=='contact'){
			$contactemail 	= trim(htmlspecialchars(addslashes($_POST["contact_email"])));
			$contactname 	= trim(htmlspecialchars(addslashes($_POST["contact_name"])));
			$contactcontent = trim(htmlspecialchars($_POST["contact_content"]));
			$contactheader 	= trim(htmlspecialchars($_POST["contact_header"]));
			$tarih			=	date("d.m.Y H:i:s");
			$mail = new PHPmailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = $encryption; // Güvenli baglanti icin ssl normal baglanti icin tls
			$mail->Host = $smtphost; // Mail sunucusuna ismi
			$mail->Port = $smtpport; // Gucenli baglanti icin 465 Normal baglanti icin 587
			$mail->IsHTML(true);
			$mail->SetLanguage("tr", "phpmailer/language");
			$mail->CharSet  ="utf-8";
			$mail->Username = $smtpusername; // Mail adresimizin kullanicı adi
			$mail->Password = $smtppassword; // Mail adresimizin sifresi
			$mail->SetFrom($contactemail, $contactname); // Mail attigimizda gorulecek ismimiz
			$mail->AddAddress($sitemail); // Maili gonderecegimiz kisi yani alici
			$mail->Subject = $contactheader."-".$sitetitle." İletişim Formundan Gelen Mesaj"; // Konu basligi
			$mail->Body = "Gelen Mail: ".$contactemail."<br>Gelen Ad Soyad : ".$contactname."<br>Gelen Mesaj :".$contactcontent."<br>"; // Mailin icerigi
			if($mail->Send()){
				echo "1";
			} else {
			    echo "2";
			}

		} 
}else{
  die();
}
