 <?php
function seo($s) {
$tr = array('ş','Ş','İ','I','ı','ğ','Ğ','Ü','ü','ö','Ö','ç','Ç','(',')','/',':',',');
$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
$s = str_replace($tr,$eng,$s);
$s = strtolower($s);
$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
$s = preg_replace('/\s+/', '-', $s);
$s = preg_replace('|-+|', '-', $s);
$s = preg_replace('/#/', '', $s);
$s = str_replace('.', '', $s);
$s = trim($s, '-');
return $s;
}
function GetIP(){
  if(getenv("HTTP_CLIENT_IP")) {
    $ip = getenv("HTTP_CLIENT_IP");
  } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    if (strstr($ip, ',')) {
      $tmp = explode (',', $ip);
      $ip = trim($tmp[0]);
    }
  } else {
  $ip = getenv("REMOTE_ADDR");
  }
  return $ip;
}

function okunmaekle($id){
  $ip = GetIP();
    if (!isset($_COOKIE[$ip])) {
    setcookie($ip,"0");
  }else{
     if ($_COOKIE[$ip]==0) {
      $addread = mysqli_query("UPDATE article SET article_readcount=article_readcount+1 WHERE id='$id' ORDER BY id ASC LIMIT 1");
      setcookie($ip,"1");
    }
  }
}

function article_link($category, $seo){
  $seoofcategory = seo($category);
  $sitelink = mysqli_fetch_assoc(mysqli_query("SELECT * FROM settings"));
  $link = $sitelink["link"]."".$seoofcategory."/".$seo.".html";
  return $link;
}
function encok5(){
        include('src/config.db.php');
        $encok_okunan = mysqli_query($conn,"SELECT * FROM article ORDER BY article_readcount DESC LIMIT 5");
        while($encok = mysqli_fetch_assoc($encok_okunan)){
  ?>
      <a class="uk-link-reset" href="<?=article_link($encok["article_category"], $encok["article_seo"]);?>"><span uk-icon="icon : check"></span><span class="float-left" style="margin-left:15px; text-shadow: 2px 2px 5px #7e4d7e;"><?=$encok["article_title"]?></span><br /></a>
      <?php                  
}
}
function IPKaydet(){
  include('config.db.php');
  $ipcek = GetIP();
  $query = "SELECT * FROM hit WHERE IP='$ipcek'";
  $result = $conn->query($query);
  $sorgu = mysqli_num_rows($result);
    if($sorgu==0){
      $IPKaydet = mysqli_query("INSERT INTO hit (IP, count) values ('$ipcek', '0')");
    }
}
function addhit(){
  include('config.db.php');
  $ipcek = GetIP();
  $hitekle = mysqli_query($conn,"UPDATE hit SET count=count+1 WHERE IP='$ipcek' LIMIT 1");
}
function tarihfarki($t1_timestamp){
  $t2_timestamp = time();
    if ($t1_timestamp > $t2_timestamp) {
        $result = round(($t1_timestamp - $t2_timestamp) / 86400);
    } else
        if ($t2_timestamp > $t1_timestamp) {
            $result = round(($t2_timestamp - $t1_timestamp) / 86400);
        }
        return $result;
}
?>
