<script type="text/javascript">
        function listele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>admin/ajax.php',
              data: {type:'slideshowlist',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#slideshows").append(response);
              }
            });
        }


        $(function(){
            
        	var pC = 3;
            var aP = 1;

        	
            listele(pC,aP);

            $(window).scroll(function(){
            	if($(window).scrollTop() + $(window).height() >= $(document).height()){
            		aP++;
		            listele(pC,aP);
            	}
            });
            


        });

            function deleteslideshow(id){
            var slideid  = id;
 
                          $.ajax({       
                              type: "POST",
                              url:  "<?=$sitelink?>admin/ajax.php",
                              data : {type:'deleteslideshow', slideid:slideid},
                              success: function(sonuc){
                                if(sonuc == 1){
									UIkit.notification({message: 'Başarıyla Silindi...', status: 'success'});
									setInterval(function(){
                                  window.location.reload(false);
                                  },3000);

                                }else{
                                	alert(sonuc);
                                	UIkit.notification({message: 'Silinirken Hata Oluştu...', status: 'danger'});
                                }
                              }
                          })
          }
          $(document).on("submit","form", function () {
				var data = new FormData(this);
				$.ajax({
					url: "<?=$sitelink?>admin/ajax.php",
					method:"post",
					data:data,
					processData: false,
					contentType: false,
					success: function(cevap){
							$("#sonuc").html(cevap);
							setInterval(function(){
                            window.location.reload(false);
                            },3000);
					}
				});
		});	

</script>
<div class="uk-container">
	<h3>Slayt Ekle</h3>
	<form action="javascript:void(0);" method="post" enctype="multipart/form-data">
		<div class="js-upload uk-placeholder uk-text-center">
	    <span uk-icon="icon: cloud-upload"></span>
		    <div uk-form-custom>
		        <input type="file" name="file">
		    	<span class="uk-text-middle uk-link">Dosya Seçin</span>
		    </div>
		</div>
		<input type="hidden" name="type" value="addslideshow">
		<button class="uk-button uk-button-secondary" type="submit">Yükle</button>
	</form>
	<div id="sonuc"></div>
	<hr>
	<div class="uk-child-width-1-2@m" id="slideshows" uk-grid uk-lightbox="animation: scale">

	</div>
</div>
