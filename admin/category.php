<script type="text/javascript">
        function listele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>admin/ajax.php',
              data: {type:'categorylist',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#categories").append(response);
              }
            });
        }


        $(function(){
            
        	var pC = 15;
            var aP = 1;

        	
            listele(pC,aP);

            $(window).scroll(function(){
            	if($(window).scrollTop() + $(window).height() >= $(document).height()){
            		aP++;
		            listele(pC,aP);
            	}
            });
            


        });
	function addcategory(){
		var categoryname = $("#categoryname").val();
			$.ajax({
				url: '<?=$sitelink?>admin/ajax.php',
				type: 'POST',
				data:{type:'addcategory', categoryname:categoryname},
				success: function(cevap){
					if(cevap == 1){

                        var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Kategori Başarıyla Eklendi</p></div>";   
                       document.getElementById("uyari").innerHTML=newHTML;
                      setInterval(function(){
                      window.location.reload(false);
                      },3000);
					}else{
                        var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Kategori Eklenirken Hata Oluştu</p></div>";   
                        document.getElementById("uyari").innerHTML=newHTML;
					}
				}
			})
	}
	function deletecategory(id){
		var categoryid = id;
		$.ajax({
			url: '<?=$sitelink?>admin/ajax.php',
			type: 'POST',
			data: {type:'deletecategory', categoryid:categoryid},
			success: function(cevap){
				if(cevap == 1){

	                var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Kategori Başarıyla Silindi</p></div>";   
	               document.getElementById("uyari").innerHTML=newHTML;
	              setInterval(function(){
	              window.location.reload(false);
	              },3000);
				}else{
	                var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Kategori Silinirken Hata Oluştu</p></div>";   
	                document.getElementById("uyari").innerHTML=newHTML;
				}
		}
		})
	}
</script>
<div class="uk-container"  style="margin-top: 20px;">
	<h3>Kategori Ekle</h3>
	<div class="uk-form-control">
			<input class="uk-input" type="text" id="categoryname" placeholder="Kategori Başlığı">
	</div>
	<button onclick="addcategory();" class="uk-margin uk-button uk-button-secondary">Kaydet</button>
	<div id="uyari"></div>
	<hr>
    <ul id="categories" class="uk-list uk-list-striped">
     </ul>
</div> 