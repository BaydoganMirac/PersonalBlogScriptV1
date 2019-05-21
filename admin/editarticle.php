<script type="text/javascript">
	$(document).on("submit","form", function(){
		var data = new FormData(this);
		$.ajax({
			url:"<?=$sitelink?>admin/ajax.php",
			data:data,
			contentType: false,
			processData: false,
			type: "POST",
			success: function(cevap){
				$("#sonuc").html(cevap);
			}
		});
	});
</script>
<script type="text/javascript">
	function editarticle(){
		var articletitle 	= $("#articletitle").val();
		var articleid 		= $("#articleid").val();
		var articlecontent  = $("#id_cazary_full").val();
		var lastcategory 	= $("#lastcategory").val();
		var newcategory 	= $("#newcategory option:selected").val();
		$.ajax({
			type: "POST",
			url: "<?=$sitelink?>admin/ajax.php",
			data:{type:'editarticle', articletitle:articletitle, articlecontent:articlecontent, lastcategory:lastcategory, newcategory:newcategory, articleid:articleid},
			success: function(cevap){
				if(cevap == 1){
	                var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Başarıyla Güncellendi</p></div>";   
	               document.getElementById("uyari").innerHTML=newHTML;
	               location.reload();
				}else{
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Güncelleme Başarısız</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
				}
			}
		})
	}
</script>
<script type="text/javascript">

</script>
<?php 
$articleid = $_GET["id"];
                $sor = mysql_query("SELECT * FROM article WHERE id='$articleid' LIMIT 1");
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
    			$kategorisor = mysql_query("SELECT * FROM category");
 ?>
<div class="uk-container">
	<input class="uk-input uk-margin" type="text" id="articletitle" name="articletitle" value="<?=$Article_title?>">
		<select class="uk-select uk-margin" id="newcategory">
	<?php while($kategori = mysql_fetch_assoc($kategorisor)){
		?>
        	<option
        	<?php 
        	if($kategori["categoryname"]==$Article_category){
        		echo "selected";
        	}
        	?>
        	 value="<?=$kategori["categoryname"]?>"><?=$kategori["categoryname"]?></option>
	<?php
	} ?>
		</select>
	<textarea id="id_cazary_full" placeholder="full mode" id="articlecontent" style="width: 100%; height:500px;"><?=$Article_content?></textarea>
	<input type="hidden" name="lastcategory" id="lastcategory" value="<?=$Article_category?>">
	<input type="hidden" name="articleid" id="articleid" value="<?=$articleid?>">
	<button onclick="editarticle()" type="submit" class="uk-button uk-button-secondary uk-margin">Kaydet</button>
		<div id="uyari"></div>

	<hr>
	<h1>Yazı Resmini Güncelle</h1>
	<form method="post" enctype="multipart/form-data" action="javascript:void(0);" style="text-align: center;">
	<div class="js-upload uk-placeholder uk-text-center">
	    <span uk-icon="icon: cloud-upload"></span>
	    <div uk-form-custom>
	    		    <span class="uk-text-middle uk-link">Dosya Seçin</span>

	        <input type="file" name="file" multiple>
	    </div>
	</div>
	 <input type="hidden" name="type" value="updateimage">
	 <input type="hidden" name="article_id" value="<?=$Article_id?>">
	 <button type="submit" class="uk-button uk-button-secondary uk-margin-small">Yükle</button>	
	</form>
	<div id="sonuc"></div>
</div>
