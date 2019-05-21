<script type="text/javascript">
        function editsettings(){
        var sitetitle = $("#sitetitle").val();
        var sitedescription = $("#sitedescription").val();
        var sitekeywords = $("#sitekeywords").val();
        var sitemail = $("#sitemail").val();
        var smtphost = $("#smtphost").val();
        var smtpport = $("#smtpport").val();
        var encryption = $("#encryption option:selected").val();
        var smtpusername = $("#smtpusername").val();
        var smtppassword = $("#smtppassword").val();
        var aboutme = $("#id_cazary_full").val();
        $.ajax({
            type: "POST",
            url: "<?=$sitelink?>admin/ajax.php",
            data:{type:'editsettings', sitetitle:sitetitle, sitedescription:sitedescription, sitekeywords:sitekeywords, sitemail:sitemail, smtphost:smtphost, smtpport:smtpport, encryption:encryption, smtpusername:smtpusername, smtppassword:smtppassword, aboutme:aboutme},
            success: function(cevap){
                if(cevap == 1){
                    var newHTML = "<div class='uk-alert-success' uk-alert><a class='uk-alert-close' uk-close></a><p>Başarıyla Güncellendi</p></div>";   
                   document.getElementById("uyari").innerHTML=newHTML;
                    setInterval(function(){
                    window.location.reload(false);
                    },3000);
                }else{
                    var newHTML = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>Güncelleme Başarısız</p></div>";   
                    document.getElementById("uyari").innerHTML=newHTML;
                }
            }
        })
    }
</script>
<div class="uk-container">
    <div class="uk-form-horizontal uk-margin-large">
    <h3>Site Ayarları</h3>
    <div class="uk-margin">
        <label class="uk-form-label" for="sitetitle">Site Başlığı</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="sitetitle" type="text" value="<?=$sitetitle?>" >
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="sitedescription">Site Açıklaması</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="sitedescription" type="text" value="<?=$sitedescription?>" >
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="sitekeywords">Site Etiketleri</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="sitekeywords" type="text" value="<?=$sitekeywords?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="sitemail">Site Email</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="sitemail" type="text" value="<?=$sitemail?>">
        </div>
    </div>
    <h3>SMTP Ayarları</h3>
    <div class="uk-margin">
        <label class="uk-form-label" for="smtphost">SMTP Host</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="smtphost" type="text" value="<?=$smtphost?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="smtpport">SMTP Port</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="smtpport" type="text" value="<?=$smtpport?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="encryption">SMTP Şifreleme</label>
        <div class="uk-form-controls">
            <select class="uk-select" id="encryption">
                <option>SSL</option>
                <option>TLS</option>
            </select>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="smtpusername">SMTP Kullanıcı Adı</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="smtpusername" type="text" value="<?=$smtpusername?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="smtppassword">SMTP Şifre</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="smtppassword" type="text" value="<?=$smtppassword?>">
        </div>
    </div>
    <h3>Hakkımda Yazısı Düzenle</h3>
        <div class="uk-container">
            <textarea id="id_cazary_full" placeholder="full mode" style="width: 100%; height: 100%;"><?=$aboutme?></textarea>
        </div>
    <div id="uyari"></div>
    <button onclick="editsettings()" class="uk-button uk-button-secondary">Kaydet</button>

</div>
</div>