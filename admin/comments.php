<script type="text/javascript">
	        function listele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>admin/ajax.php',
              data: {type:'cofirmationcomments',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#cofirmationcomments").append(response);
              }
            });
        }
	    function onaysızlistele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>admin/ajax.php',
              data: {type:'comments',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#comments").append(response);
              }
            });
        }

        $(function(){
            
        	var pC = 5;
            var aP = 1;

        	
            listele(pC,aP);
		    onaysızlistele(pC,aP);

            $(window).scroll(function(){
            	if($(window).scrollTop() + $(window).height() >= $(document).height()){
            		aP++;
		            listele(pC,aP);
		            onaysızlistele(pC,aP);
            	}
            });
            


        });
        function commentdelete(id, articleid){
        	var commentid = id;
        	$.ajax({
        		url: "<?=$sitelink?>admin/ajax.php",
        		type: "post",
        		data: {type:'commentdelete', commentid:commentid, articleid:articleid},
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
        function confirmcomment(id, articleid){
        	var commentid = id;
        	$.ajax({
        		url: "<?=$sitelink?>admin/ajax.php",
        		type: "post",
        		data: {type:'confirmcomment', commentid:commentid, articleid:articleid},
        		success: function(sonuc){
	                if(sonuc == 1){
						UIkit.notification({message: 'Başarıyla Onaylandı...', status: 'success'});
						setInterval(function(){
	                  window.location.reload(false);
	                  },3000);

	                }else{
	                	alert(sonuc);
	                	UIkit.notification({message: 'Onaylanamadı...', status: 'danger'});
	                }
        		}
        	})

        }
        function unconfirmcomment(id, articleid){
            var articleid = articleid;
        	var commentid = id;
        	$.ajax({
        		url: "<?=$sitelink?>admin/ajax.php",
        		type: "post",
        		data: {type:'unconfirmcomment', commentid:commentid, articleid:articleid},
        		success: function(sonuc){
	                if(sonuc == 1){
						UIkit.notification({message: 'Başarıyla Onay Kaldırıldı...', status: 'success'});
						setInterval(function(){
	                  window.location.reload(false);
	                  },3000);

	                }else{
	                	alert(sonuc);
	                	UIkit.notification({message: 'Onay Kaldırılamadı...', status: 'danger'});
	                }
        		}
        	})

        }

</script>
<div class="uk-container" >
	<div class="uk-child-width-1-2@l uk-grid-divider" uk-grid>
	    <div>
	    	<h3>Onaylı Yorumlar</h3>
	    	    <div id="cofirmationcomments">
				</div>

	    </div>
	    <div>
	    	<h3>Onaylanacak Yorumlar</h3>
	    	<div id="comments">
	    	</div>
	    </div>
	</div>
</div>