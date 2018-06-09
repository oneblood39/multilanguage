<?php

header('Content-Encoding: UTF-8');
header('Content-Type: text/plain; charset=UTF-8'); 
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

/*
function replace_tr($text) {
$text = trim($text);
$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
$replace = array('c','c','g','g','i','i','o','o','s','s','u','u');
$new_text = str_replace($search,$replace,$text);
return $new_text;
}
*/
echo "<table border='1'>
  <tr>
    <td>ID</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Important info</td>
  </tr>";

/*
  $bul = array("Ä°", "Ä±", "Ã", "Ã¼", "Ä", "Ä", "Å", "Å", "Ã¶", "Ã", "Ã§", "Ã", "Ä°", "Ãœ", "Ã¼", "Ã¶", "Ãœ", "Ä");
  $degistir = array("İ", "ı", "Ü", "ü", "Ğ", "ğ", "ş", "Ş", "ö", "Ö", "ç", "Ç", "İ", "Ü", "ü", "ö", "Ü" ,"Ğ");

   // $danisanAd = str_replace($bul,$degistir,$danisanAd);
  //$danisanAd=iconv("UTF-8", "latin-5",$danisanAd);u
  //$danisanAd=iconv("utf8_turkish_ci","UTF-8",$danisanAd);
 // $danisanAd=utf8_decode($danisanAd);
  //$danisanAd=str_replace($bul,$degistir,$danisanAd);
 // $danisanSoyad=replace_tr($result->danisanSoyad);
 // $danisanSoyad=utf8_decode(str_replace($bul,$degistir,$danisanSoyad));
 // $danisanSoyad=str_replace($bul,$degistir,$danisanSoyad);
*/

$sql ="SELECT * FROM vwrandevu order by randevuID desc limit 0,100";
$results = $this->db->query($sql)->result();

foreach ($results as $result) {
  $danisanID=$result->danisanID;
  $danisanAd=$result->danisanAd;
  $danisanSoyad=$result->danisanSoyad;

echo '<tr>';
echo '<td>'.$danisanID.'</td>
      <td>'.$danisanAd.'</td>
      <td>'.$danisanSoyad.'</td>';
echo '</tr>';


}
 
echo '</table>';
?>


