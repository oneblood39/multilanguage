<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">

    <div class="row">
        <div class="col-lg-12" style="margin-top: -60px;">
          <?php
$userid=$this->ion_auth->user()->row()->id;
$sqlusers="Select * from vwusers where id=".$userid;
$results= $this->db->query($sqlusers)->result();
foreach ($results as $result) {
  $group_id=$result->group_id;
  //echo $group_id;
}

if($group_id=='3' or $group_id=='4' or $group_id=='7' or $group_id=='8') {
////
 // echo '<a href="'; echo site_url('admin/terapi/danisan/kendidanisanlarim/'); echo '">'; echo ' class="btn btn-primary">'; echo 'Danışanlarım</a>';

   echo ' <a href="';echo site_url('admin/terapi/danisan/kendidanisanlarim');echo'"'; echo 'class="btn btn-primary">Danışanlarım</a>';
} else {
 
  ///
}
          ?>
  <a href="<?php echo site_url('admin/terapi/randevu/randevulistele');?>" class="btn btn-primary">Randevu Listele</a>
  <a href="<?php echo site_url('admin/terapi/randevu/mazeretler');?>" class="btn btn-primary">Mazeretler</a>
  <br><br>


<?php
$danismanid=$this->uri->segment(5);

$sqldanisman="Select DanismanAd,DanismanSoyad from vwrandevu where DanismanUserID=".$danismanid;
$results= $this->db->query($sqldanisman)->result();
foreach ($results as $result) {
  $ad=$result->DanismanAd;
  $soyad=$result->DanismanSoyad;
}

echo '<h3>'.$ad.' '.$soyad.' Randevu-Mazeret Takvimi</h3>';
//error_reporting(0);
$bugun = date("Y-m-d"); 



$date=$bugun;
$ofis='1';

if ($this->input->post('tarih')!='') {
$date=$this->input->post('tarih');   
$dizi = explode ("/",$date);
$date=$dizi[2].'-'.$dizi[0].'-'.$dizi[1];  /*echo $date; */ 
$ofis=$this->input->post('ofis');
} 
else if ($this->session->userdata('date')!='') {
$date=$this->session->userdata('date');
$ofis= $this->session->userdata('ofis');}
else { $date=$bugun; 
$ofis=$this->ion_auth->user()->row()->company;}


  if($ofis=='') {  $ofis=$this->ion_auth->user()->row()->company; }

  if($ofis=='3') {  $ofis='2'; $date=$bugun; }


//echo '<br><br><br>'.$date.'--'.$ofis;

$formatted_date=date("m/d/Y"); 
//echo $ofis;


/*echo $this->session->userdata('date');
echo $this->session->userdata('ofis'); 
*/

/////////////üst form///////////////////
echo '<form method="post" action="'; echo site_url('admin/terapi/randevu'); echo '"><table><tr>
<td><p><b>Tarih Seçiniz: </b><input autocomplete="off" name="tarih" type="text" id="datepicker" placeholder="';if ($date!='') {  } else { echo "-bugün-"; } echo'"></p></td>';



if($this->ion_auth->user()->row()->company=='1' or $this->ion_auth->user()->row()->company=='2') 
{  $ofis=$this->ion_auth->user()->row()->company;
echo '<input type="hidden" name="ofis" value="'.$ofis.'">';

   }
else {


echo '<td><p><b>Ofis Seçiniz: </b><SELECT name="ofis" id="wgtmsr">';
echo '<option value="0">--</option>'; 
if ($this->ion_auth->user()->row()->company==3) {
$sqlofisler = "SELECT * FROM tblofis where ofisID!=3";
                    $ofisler = $this->db->query($sqlofisler)->result();
                    foreach($ofisler as $cofis){ 
                      $ofisID=$cofis->ofisID;
                      $ofisAdi=$cofis->ofisAdi;
                        
   echo '<option value="'.$ofisID.'"'; if ($ofisID==$ofis){ echo 'selected'; } echo '>'.$ofisAdi.'</option>'; 

                    }
}
if ($this->ion_auth->user()->row()->company!=3) {
  $sqlofisler = "SELECT * FROM tblofis where ofisID=".$this->ion_auth->user()->row()->company;
                    $ofisler = $this->db->query($sqlofisler)->result();
                    foreach($ofisler as $cofis){ 
                      $ofisID=$cofis->ofisID;
                      $ofisAdi=$cofis->ofisAdi;                  
   echo '<option value="'.$ofisID.'">'.$ofisAdi.'</option>'; 

                    }
}

//echo '</SELECT></p><input type="submit" class="btn btn-primary" value="Git"></td>';

}////if sonu


echo '<td>&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary" value="Günlük Takvime Git"></td></tr></table>';
echo form_close();


echo '<table width="350px">
<tr>
<td width="30px" style="background-color:orange;">&nbsp;</td><td> <p style="margin-left:5px;">Mazeretler</p></td>
<td width="30px" style="background-color:red;">&nbsp;</td><td> <p style="margin-left:5px;">Randevular</p></td>
</tr>
</table>';
////////

if ($date) {  
$dizidate = explode ("-",$date);
//echo '<b>'.$dizidate[2].'-'.$dizidate[1].'-'.$dizidate[0].'</b>';
 } else { }


//$dizi2= isset($dizi[2]) ? $dizi[2] : '';
//$dizi1= isset($dizi[1]) ? $dizi[1] : '';
//$dizi0= isset($dizi[0]) ? $dizi[0] : '';
//$newdate=$dizi2.'-'.$dizi1.'-'.$dizi0;
//echo '<b>'.$date.'</b>';

 echo '<table class="table table-hover table-bordered table-condensed" >';
 echo '<tr><td>Saat/Tarih</td>';
for ($i = 9; $i <= 21; $i++) {
echo '<td>';
echo $i.":00";
echo'</td>';
}
echo '</tr>';

$ortak=3;
//$sqlusers = "SELECT * FROM users WHERE company=".$ofis." or company=".$ortak;
//$tomorrow = date('Y-m-d', time()+86400);
$yarin  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$yarin=date('d/m/Y',$yarin);
for ($y = 0; $y <= 15; $y++) {

echo '<tr>';

$arr = array(
    "Friday" => "Cuma",
    "Sunday" => "Pazar",
    "Monday" => "Pazartesi",
    "Tuesday" => "Salı",
    "Wednesday" => "Çarşamba",
    "Thursday" => "Perşembe",
    "Saturday" => "Cumartesi"
  );

   // $word = "http://desiweb.ir";
   // echo strtr($word,$arr);

$yarin  = mktime(0, 0, 0, date("m")  , date("d")+$y, date("Y"));
$yarin=date('d-m-Y-l',$yarin);
echo "<td>";echo strtr($yarin,$arr);"</td>";

//$yarin
//$danismanid
//$i

$tarih=explode('-', $yarin);



for ($i = 9; $i <= 21; $i++) {
if ($i=='9'){ $i='09';}///sabah 9 u 09 olarak gösterdim
$formattarih=$tarih[2].'-'.$tarih[1].'-'.$tarih[0].' '.$i;
$gidentarih=$tarih[2].'-'.$tarih[1].'-'.$tarih[0];
         $sql = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$formattarih."%') and (DanismanUserID='".$danismanid."') and (randevuDurumID!='5')";
    $sqlmazeret = "SELECT * FROM vwdanismanmazeret WHERE  (mazeretBaslangicTarihSaat LIKE '%".$formattarih."%') and (danismanUserID='".$danismanid."') and (aktifMi='1')"; 
         $results = $this->db->query($sql)->result();
         $sayi= $this->db->query($sql)->num_rows();////
         $sayimazeret= $this->db->query($sqlmazeret)->num_rows();////

if($sayi>0) { echo '<td style="background-color:red"></td>';  }

else if ($sayimazeret>0) {
 $sqlmazeret = "SELECT * FROM vwdanismanmazeret WHERE  (mazeretBaslangicTarihSaat LIKE '%".$formattarih."%') and (danismanUserID='".$danismanid."') and (aktifMi='1')"; 
 $resultmazeretler = $this->db->query($sqlmazeret)->result();
 foreach($resultmazeretler as $resultmazeret){  
                  $baslangic=$resultmazeret->mazeretBaslangicTarihSaat;
                  $bitis=$resultmazeret->mazeretBitisTarihSaat;

                    $metinb=explode(' ', $baslangic);
                    $saat=$metinb['1'];
                    $saatbaslangic=explode(':',$saat);
                    $bassaat=$saatbaslangic['0'];
                              
                       $metinbitis=explode(' ', $bitis);
                       $saat=$metinbitis['1'];
                       $saatbitis=explode(':',$saat);
                       $bitsaat=$saatbitis['0'];
                        
if($bassaat==$bitsaat) { $bitsaat=$bitsaat+1; $bitis=$metinb['0'].' '.$bitsaat.':00:00'; }


     $start_date = new DateTime($baslangic);
     $since_start = $start_date->diff(new DateTime($bitis));
   /*echo $since_start->days.' days total<br>';
    echo $since_start->y.' years<br>';
    echo $since_start->m.' months<br>';
    echo $since_start->d.' days<br>';
    echo $since_start->h.' hours<br>';
    echo $since_start->i.' minutes<br>';
    echo $since_start->s.' seconds<br>'; */

$metin=explode(" ", $baslangic);
$bitistarih=explode(" ", $bitis);

                    if (($since_start->m)>0 or ($since_start->d)>0) {   ///bir gün veya aydan fazla izinli ise case i 

$metin=explode(" ", $baslangic);
$gunsonu=$metin[0].' '.'22:00:00';

     $start_date_daily = new DateTime($baslangic);
     $since_start_daily = $start_date_daily->diff(new DateTime($gunsonu));
$i=$i+($since_start_daily->h)-1; echo '<td style="background-color:#F75D59"  colspan="'.$since_start_daily->h.'">';

          } else {  

           $i=$i+($since_start->h)-1; echo '<td style="background-color:orange"  colspan="'.$since_start->h.'">';  }


}


}
else {


if($group_id=='9' or $group_id=='10' or $group_id=='11' or $group_id=='1') {
echo '<td><a href="';echo site_url('admin/terapi/randevu/randevuekle/'.$gidentarih.'/'.$danismanid.'/'.$i.'/'.$ofis);echo'">
<img src="';echo site_url('assets/admin/images/25x70.png');echo'">
</a></td>'; } else {
 echo '<td>
<img src="';echo site_url('assets/admin/images/25x70.png');echo'">
</td>'; 
}


}



}

//$tomorrow = strtotime('+'.$y.' day');



            }  
//içerikkk
if ($i==21) {echo "</td></tr>";} else {echo'</td>'; }   //////akşam saat 21 e kadar randevu veriliyor...
//}
//}
echo '</table>';
?>

            

        </div>
    </div>
</div>
