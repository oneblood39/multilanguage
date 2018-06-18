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
//$baslangic='2018-06-13 01:00:00';
//$bitis='2018-06-13 23:00:00';
$baslangic=str_replace('%20', ' ', $baslangic);
$bitis=str_replace('%20', ' ', $bitis);

echo "<table border='1'>
  <tr>
    <td><b>Randevu ID</b></td>
    <td><b>Danışan ID</b></td>
    <td><b>Adı</b></td>
    <td><b>Soyadı</b></td>
    <td><b>Randevu Tarihi</b></td>
    <td><b>Randevu Durumu</b></td>
    <td><b>Danışman Ad</b></td>
    <td><b>Danışman Soyad</b></td>
    <td><b>Ofis</b></td>
    <td><b>Terapi</b></td>
    <td><b>Seans</b></td>
  </tr>";


//$sql ="SELECT * FROM vwrandevu where ofisID=".$ofis." and randevuBaslangicTarihSaat between ".$baslangic." and ".$bitis."  order by randevuID";
  if($ofis=='3') {
  $sql="Select * From vwrandevu where (ofisID=1 or ofisID=2) and RandevuDurumID=5  and randevuBaslangicTarihSaat between "."'".$baslangic."'"." and "."'".$bitis."' order by DanismanAd";
  } else { 
  $sql="Select * From vwrandevu where RandevuDurumID=5 and ofisID=".$ofis." and randevuBaslangicTarihSaat between "."'".$baslangic."'"." and "."'".$bitis."' order by DanismanAd";
  }

echo 'Başlangıç Tarihi:'.$baslangic.' Bitiş Tarihi:'.$bitis;
$results = $this->db->query($sql)->result();

foreach ($results as $result) {
  $randevuID=$result->randevuID;
  $danisanID=$result->danisanID;
  $danisanAd=$result->danisanAd;
  $danisanSoyad=$result->danisanSoyad;
  $tarih=$result->randevuBaslangicTarihSaat;
  $randevudurum=$result->RandevuDurumAdi;
  $danismanAd=$result->DanismanAd;
  $danismanSoyad=$result->DanismanSoyad;
  $ofisAdi=$result->ofisAdi;
  $terapiAdi=$result->terapiAdi;
  $seansTipAdi=$result->seansTipAdi;

echo '<tr>';
echo '<td>'.$randevuID.'</td>
      <td>'.$danisanID.'</td>
      <td>'.$danisanAd.'</td>
      <td>'.$danisanSoyad.'</td>
      <td>'.$tarih.'</td>
      <td>'.$randevudurum.'</td>
      <td>'.$danismanAd.'</td>
      <td>'.$danismanSoyad.'</td>
      <td>'.$ofisAdi.'</td>
      <td>'.$terapiAdi.'</td>
      <td>'.$seansTipAdi.'</td>
      ';
echo '</tr>';
}
 
echo '</table>';
?>


