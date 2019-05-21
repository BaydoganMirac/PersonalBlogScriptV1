        <script type="text/javascript">
        function listele(pageCount,activePage){
            $.ajax({
              url: '<?=$sitelink?>ajax.php',
              data: {type:'bloglist',activePage:activePage,pageCount:pageCount},
              type: 'POST',
              success: function(response){
                $("#yazilar").append(response);
              }
            });
        }


        $(function(){
            
        	var pC = 3;
            var aP = 1;

        	
            listele(pC,aP);

            $(window).scroll(function(){
            	if($(document).height() == $(window).scrollTop() + $(window).height()){
            		aP++;
		            listele(pC,aP);
            	}
            });
            


        });
        </script>
        <div class="uk-container ">
          <div uk-filter="target: .js-filter">
          <ul class="uk-subnav uk-subnav-pill">
            <li class="uk-active" uk-filter-control><a href="#">Bütün Kategoriler</a></li>


          <?php
            $sorkategori = mysql_query("SELECT DISTINCT article_category FROM article  ORDER BY article_datestamp DESC");
            while($kategori=@mysql_fetch_assoc($sorkategori)){
                $Article_category         = $kategori["article_category"];
         ?>

              <li uk-filter-control="[data-category='<?=seo($Article_category)?>']"><a href="#"><?=$Article_category?></a></li>
         <?php
       }
         ?>
          </ul>
        <div id="yazilar" class="uk-grid-divider uk-child-width-1-4 uk-flex-center js-filter" uk-grid="masonry: true">
          </div>
          </div>
        </div>