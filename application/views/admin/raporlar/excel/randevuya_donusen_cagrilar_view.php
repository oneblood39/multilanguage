<?php
header('Content-Encoding: UTF-8');
header('Content-Type: text/plain; charset=UTF-8'); 
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$baslangic=$this->uri->segment(5);
$bitis=$this->uri->segment(6);
$ofis=$this->uri->segment(7);
$baslangic=str_replace('%20', ' ', $baslangic);
$bitis=str_replace('%20', ' ', $bitis);

echo "<table border='1'>
  <tr>
    <td><b>Çağrı ID</b></td>
    <td><b>Çağrı Yapan Ad</b></td>
    <td><b>Çağrı Yapan Soyad</b></td>
    <td><b>Çağrı Yapılan Ad</b></td>
    <td><b>Çağrı Yapılan Soyad</b></td>
    <td><b>Tel</b></td>
    <td><b>Çağrı Tarihi</b></td>
    <td><b>Ofis</b></td>
    <td><b>Danisman Ad</b></td>
    <td><b>Danisman Soyad</b></td>
    <td><b>Çağrı Durumu</b></td>
    <td><b>Randevu Durumu</b></td>
  </tr>";

if($ofis=='3') { 
$sql="Select * From vwcagri where (ofisID=1 or ofisID=2) and (randevuyaDonusmeDurumu=1) and dateCreated between "."'".$baslangic."'"." and "."'".$bitis."' order by cagriID desc";
} else { 
$sql="Select * From vwcagri where ofisID=".$ofis." and (randevuyaDonusmeDurumu=1) and dateCreated between "."'".$baslangic."'"." and "."'".$bitis."' order by cagriID desc";
 }


echo 'Başlangıç Tarihi:'.$baslangic.' Bitiş Tarihi:'.$bitis;
$results = $this->db->query($sql)->result();

foreach ($results as $result) {
  $cagriID=$result->cagriID;
  $cagriYapanAd=$result->cagriYapanAd;
  $cagriYapanSoyad=$result->cagriYapanSoyad;
  $tarih=$result->dateCreated;
  $cagriYapilanAd=$result->cagriYapilanAd;
  $cagriYapilanSoyad=$result->cagriYapilanSoyad;
  $danismanAd=$result->talepDanismanAd;
  $danismanSoyad=$result->talepDanismanSoyad;
  $ofisAdi=$result->ofisAdi;
  $tel=$result->cagriYapanTel;
  $cagridurumu=$result->cagriDurumuAdi;
  $randevudurumu=$result->randevuDurumAdi;
  $randevubaslangic=$result->randevuBaslangicTarihSaat;




echo '<tr>';
echo '<td>'.$cagriID.'</td>
      <td>'.$cagriYapanAd.'</td>
      <td>'.$cagriYapanSoyad.'</td>
      <td>'.$cagriYapilanAd.'</td>
      <td>'.$cagriYapilanSoyad.'</td>
      <td>'.$tel.'</td>
      <td>'.$tarih.'</td>
      <td>'.$ofisAdi.'</td>
      <td>'.$danismanAd.'</td>
      <td>'.$danismanSoyad.'</td>
      <td>'.$cagridurumu.'</td>
      <td>'.$randevudurumu.'</td>
      <td>'.$randevubaslangic.'</td>
      ';
echo '</tr>';
}
 
echo '</table>';
?>


