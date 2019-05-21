<script type="text/javascript">
	$(document).on("submit","form", function () {
		var data = new FormData(this);
		$.ajax({
			url: "<?=$sitelink?>admin/ajax.php",
			method:"post",
			data:data,
			processData: false,
			contentType: false,
			success: function(cevap){
				if(cevap==1){
	                var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p> Blog Yazısı Başarıyla Eklendi</p></div>";   
	               document.getElementById("uyari").innerHTML=newHTML;
				}else if(cevap==2){
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>2 MB'dan Fazla Fotoğraf Yükleyemezsin</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}else if(cevap==3){
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Sadece Fotoğraf Yükleyebilirsin</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}else if(cevap==4){
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Fotoğraf Seçiniz</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}else if(cevap==5){
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Fotoğraf Yüklemesi Başarısız</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}else if(cevap==6){
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Bilgiler Veri Tabanına Kaydedilemedi</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}else{
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>FATAL ERROR !</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}
			}

		});
	});
</script>
<div class="uk-container">
	<form id="addarticle" action="javascript:void(0);" enctype="multipart/form-data" method="post">
	<div class="uk-margin-small">
	    <div class="uk-form-controls">

	        <input class="uk-input" name="articletitle" type="text" placeholder="Yazı Başlığı">
	    </div>
	</div>
		<select class="uk-select uk-margin-small" name="category">

	<?php 
	$kategorisor = mysql_query("SELECT * FROM category");
	while($kategori = mysql_fetch_assoc($kategorisor)){
		?>
        	<option name="category" value="<?=$kategori["categoryname"]?>"><?=$kategori["categoryname"]?></option>
	<?php
	} ?>
		</select>
	<div class="uk-container">
		<textarea id="id_cazary_full" name="articlecontent" placeholder="Yazı İçeriği" style="width: 100%; height: 500px;"></textarea>
	</div>	
	<div class="js-upload uk-placeholder uk-text-center">
	    <span uk-icon="icon: cloud-upload"></span>
	    <div uk-form-custom>
	    	<span class="uk-text-middle uk-link">Dosya Seçin</span>
	        <input type="file" name="file" multiple>
	    </div>
	</div>
	<input type="hidden" name="type" value="addarticle">
		 <button type="submit" class="uk-button uk-button-secondary uk-margin-small">Yükle</button>	
	</form>
	<div id="uyari"></div>
</div>