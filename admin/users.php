<script type="text/javascript">
        
        function listele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>admin/ajax.php',
              data: {type:'userlist',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#users").append(response);
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
        
</script>
<script type="text/javascript">
    function usersdelete(id){
    var userid  = id;

                  $.ajax({       
                      type: "POST",
                      url:  "<?=$sitelink?>admin/ajax.php",
                      data : {type:'usersdelete', userid:userid},
                      success: function(sonuc){
                        if(sonuc == 1){
                            var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Kullanıcı Başarıyla Silindi</p></div>";   
                           document.getElementById("uyari").innerHTML=newHTML;
                          setInterval(function(){
                          window.location.reload(false);
                          },3000);
                        }else{
                            var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Kullanıcı Silinirken Hata Oluştu</p></div>";   
                            document.getElementById("uyari").innerHTML=newHTML;
                        }
                      }
                  })
  }

</script>
<div class="uk-container">
  <div id="uyari"></div>
	<div id="users">
		
	</div>

</div>