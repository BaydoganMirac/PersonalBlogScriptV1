<script type="text/javascript">
        
        function listele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>admin/ajax.php',
              data: {type:'adminlist',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#admins").append(response);
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
        
    function deleteadmin(id){
    var adminid  = id;

                  $.ajax({       
                      type: "POST",
                      url:  "<?=$sitelink?>admin/ajax.php",
                      data : {type:'admindelete', adminid:adminid},
                      success: function(sonuc){
                        if(sonuc == 1){
                            var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Yönetici Başarıyla Silindi</p></div>";   
                           document.getElementById("uyari").innerHTML=newHTML;
                          setInterval(function(){
                          window.location.reload(false);
                          },3000);
                        }else{
                            var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Yönetici Silinirken Hata Oluştu</p></div>";   
                            document.getElementById("uyari").innerHTML=newHTML;
                        }
                      }
                  })
  }
      function addadmin(){
        var adminname = $("#adminname").val();
        var adminusername = $("#adminusername").val();
        var adminpassword = $("#adminpassword").val();
        if(adminname=='' && adminusername=='' && adminpassword==''){
          var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Lütfen Boş Alan Bırakmayınız</p></div>";   
          document.getElementById("uyari").innerHTML=newHTML;
        }else{
          $.ajax({
            type:"POST",
            url: "<?=$sitelink?>admin/ajax.php",
            data: {type:'addadmin', adminusername:adminusername, adminname:adminname, adminpassword:adminpassword},
            success: function(cevap){
              if(cevap == 1){
                  var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Yönetici Başarıyla Eklendi</p></div>";   
                 document.getElementById("uyari").innerHTML=newHTML;
                setInterval(function(){
                window.location.reload(false);
                },3000);
              }else if(cevap==2){ 
                  var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Aynı Kullanıcı Adında Yönetici Var</p></div>";   
                  document.getElementById("uyari").innerHTML=newHTML;
              }else{ 
                  var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Yönetici Eklenirken Hata Oluştu</p></div>";   
                  document.getElementById("uyari").innerHTML=newHTML;
              }
            }
          })     
        }


      }


</script>
<div class="uk-container">
  <div class="uk-form-horizontal uk-margin-small">
    <h2>Yönetici Ekle</h2>
    <div class="uk-margin">
        <label class="uk-form-label" for="adminusername">Kullanıcı Adı</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="adminusername" type="text" placeholder="Yönetici Kullanıcı Adı">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="adminname">Adı Soyadı</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="adminname" type="text" placeholder="Yönetici Adı Soyadı">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="adminpassword">Şifre</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="adminpassword" type="password" placeholder="Yönetici Şifresi">
        </div>
    </div>
    <button onclick="addadmin();" class="uk-button uk-button-secondary uk-margin-small">Kaydet</button>
  </div>
  <hr>
  <div id="uyari"></div>
    <ul id="admins" class="uk-list uk-list-striped">
     </ul>

</div>