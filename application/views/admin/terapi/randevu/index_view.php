<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">

    <div class="row">
        <div class="col-lg-12" style="margin-top: -60px;">
  <a href="<?php echo site_url('admin/terapi/randevu/randevulistele');?>" class="btn btn-primary">Randevu Listele</a><br><br>

<style type="text/css">
#wgtmsr {
 width:190px; 
 height: 27px;  
}
td {
background-image: url(../../../assests/images/bos_arkaplan.png);
background-repeat: repeat;
background-attachment: scroll;
background-color: white;
background-position: top-left;
}
table { background: url("../../assests/images/bos_arkaplan.png") no-repeat; }

#ddd {
  color: black;

}


</style>

<?php
//error_reporting(0);
$bugun = date("Y-m-d"); 
//echo $bugün;
//echo $this->session->userdata('date');

/*
else if ($this->session->userdata('date')!='') {
$date=$this->session->userdata('date');   
$dizi = explode ("/",$date);
$date=$dizi[2].'-'.$dizi[0].'-'.$dizi[1];  /*echo $date;  } 

*/




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
echo '<form method="post" action="'; echo site_url('admin/terapi/randevu'); echo '"><table class="table  table-condensed"><tr>
<td><p><b>Tarih Seçiniz: </b><input name="tarih" type="text" id="datepicker" placeholder="';if ($date!='') {  } else { echo "-bugün-"; } echo'"></p></td>';
echo '<td><p><b>Ofis Seçiniz: </b><SELECT name="ofis" id="wgtmsr">
';
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

echo '</SELECT></p></td>';
echo '<td><input type="submit" class="btn btn-primary" value="Git"></td></tr></table>';
echo form_close();


 echo' 
';

/////////////üst form sonu///////////////////
//echo 'ofis:'.$ofis.' - ';
//echo 'tarih:'.$date;

////////////////////////Raporlar///////////////////
 $sqlrapor1 = "SELECT * FROM vwrandevu WHERE RandevuDurumID<>5 and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 //$resultsqlrapor1 = $this->db->query($sqlrapor1)->result();
 $sayirapor1= $this->db->query($sqlrapor1)->num_rows();
 echo '<br>Toplam randevu Sayısı:'.$sayirapor1;

 $sqlrapor2 = "SELECT * FROM vwrandevu WHERE (RandevuDurumID=1) and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 $sayirapor2= $this->db->query($sqlrapor2)->num_rows();

 $sqlrapor3 = "SELECT * FROM vwrandevu WHERE (RandevuDurumID=2) and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 $sayirapor3= $this->db->query($sqlrapor3)->num_rows();

 $sqlrapor4 = "SELECT * FROM vwrandevu WHERE (RandevuDurumID=3) and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 $sayirapor4= $this->db->query($sqlrapor4)->num_rows();

 $sqlrapor5 = "SELECT * FROM vwrandevu WHERE (RandevuDurumID=4) and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 $sayirapor5= $this->db->query($sqlrapor5)->num_rows();

 $sqlrapor6 = "SELECT * FROM vwrandevu WHERE (RandevuDurumID=5) and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 $sayirapor6= $this->db->query($sqlrapor6)->num_rows();

 $sqlrapor7 = "SELECT * FROM vwrandevu WHERE (RandevuDurumID=6) and (randevuBaslangicTarihSaat LIKE '%".$date."%') and (ofisID='".$ofis."')";
 $sayirapor7= $this->db->query($sqlrapor7)->num_rows();

  echo '<table class="table table-hover table-bordered table-condensed" >';
  echo '<tr>';
  echo '<td>Teyit Alınmayan Randevu Sayısı: '.$sayirapor2.'</td>';
  echo '<td>Teyit Alınan Randevu Sayısı: '.$sayirapor3.'</td>';
  echo '<td>Danışanın Gelmediği Randevu Sayısı: '.$sayirapor4.'</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td>Danışanın Geldiği Randevu Sayısı: '.$sayirapor5.'</td>';
  echo '<td>İptal Edilen Randevu Sayısı: '.$sayirapor6.'</td>';
  echo '<td>Aranılıp Ulaşılamayan Randevu Sayısı: '.$sayirapor7.'</td>';
  echo '</tr>';
  echo '</table>';

///////////////////////Raporlar Sonu///////////////
///////

echo '<table width="1350px">
<tr>
<td width="30px" style="background-color:#BDB76B;">&nbsp;</td><td> Teyit alınmadı.</td>
<td width="30px" style="background-color:#74767a;">&nbsp;</td><td> Arandı, ulaşılamadı.</td>
<td width="30px" style="background-color:#FF8C00;">&nbsp;</td><td> Teyit alındı.</td>
<td width="30px" style="background-color:#8B0000;">&nbsp;</td><td> Randevuya gelmedi.</td>
<td width="30px" style="background-color:#54C571;">&nbsp;</td><td> Randevuya geldi.</td>
<td width="30px" style="background-color:#2fbfc6;">&nbsp;</td><td> Aynı saate birden çok randevu verildi.</td>

</tr>
</table>';

////////

if ($date) {  
$dizidate = explode ("-",$date);
echo '<b>'.$dizidate[2].'-'.$dizidate[1].'-'.$dizidate[0].'</b>'; } else { }


//$dizi2= isset($dizi[2]) ? $dizi[2] : '';
//$dizi1= isset($dizi[1]) ? $dizi[1] : '';
//$dizi0= isset($dizi[0]) ? $dizi[0] : '';
//$newdate=$dizi2.'-'.$dizi1.'-'.$dizi0;
//echo '<b>'.$date.'</b>';

 echo '<table class="table table-hover table-bordered table-condensed" >';
 echo '<tr><td>Saat/Danışman</td>';
for ($i = 9; $i <= 21; $i++) {
echo '<td>';
echo $i.":00";
echo'</td>';
}
echo '</tr>';
$ortak=3;
//$sqlusers = "SELECT * FROM users WHERE company=".$ofis." or company=".$ortak;
$sqlusers = "SELECT * FROM vwusers WHERE (company=".$ofis." or company='3') and id in (select ID from vwdanisman) order by first_name asc";
//print_r($sqlusers);
                  $users = $this->db->query($sqlusers)->result();
foreach($users as $user)
   
                {  $isim=$user->first_name.' '.$user->last_name;
echo '<tr>';
echo "<td>";echo $isim;"</td>";
for ($i = 9; $i <= 21; $i++) {
if ($i=='9'){ $i='09';}///sabah 9 u 09 olarak gösterdim
$search=$date.' '.$i;
//echo $search;
 //echo "test";

      $sqlmazeret = "SELECT * FROM ilsdanismanmazeret WHERE  (mazeretBaslangicTarihSaat LIKE '%".$search."%') and (danismanUserID='".$user->id."')";
      $resultmazeretler = $this->db->query($sqlmazeret)->result();
                foreach($resultmazeretler as $resultmazeret){  
                  $baslangic=$resultmazeret->mazeretBaslangicTarihSaat;
                  $bitis=$resultmazeret->mazeretBitisTarihSaat;
                  print_r($bitis);
                }
      $sayimazeret= $this->db->query($sqlmazeret)->num_rows(); 
                
                $sql = "SELECT * FROM vwrandevu WHERE RandevuDurumID<>5 and (randevuBaslangicTarihSaat LIKE '%".$search."%') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."')"; /////burası user-id olmayabilir
                $results = $this->db->query($sql)->result();
                $sayi= $this->db->query($sql)->num_rows();

if ($sayimazeret>0) { 

     
     $start_date = new DateTime($baslangic);
     $since_start = $start_date->diff(new DateTime($bitis));
   /*echo $since_start->days.' days total<br>';
    echo $since_start->y.' years<br>';
    echo $since_start->m.' months<br>';
    echo $since_start->d.' days<br>';
    echo $since_start->h.' hours<br>';
    echo $since_start->i.' minutes<br>';
    echo $since_start->s.' seconds<br>'; */

//echo $baslangic;
echo "<br>";
$metin=explode(" ", $baslangic);
//print_r($metin[0]);

$bitistarih=explode(" ", $bitis);
print_r($bitistarih[0]);

                    if (($since_start->m)>0 or ($since_start->d)>0) {   ///bir gün veya aydan fazla izinli ise case i 


/*
if($bitistarih[0]==$date) { $baslangic=$date.' 09:00:00'; 
  echo $baslangic;
  $start_date_daily = new DateTime($baslangic);  
  $since_start_daily = $start_date_daily->diff(new DateTime($bitistarih[0])); 
  $i=$i+($since_start_daily->h)-1; echo '<td style="background-color:#F75D59"  colspan="'.$since_start_daily->h.'">';
}

*/


//echo $start_date;
//$i=$i+23; echo '<td style="background-color:#F75D59"  colspan="24">';
 /*
echo '-';*/
//echo $baslangic;
echo "<br>";
$metin=explode(" ", $baslangic);
//print_r($metin[0]);
$gunsonu=$metin[0].' '.'22:00:00';
//print_r($gunsonu);


     $start_date_daily = new DateTime($baslangic);
     $since_start_daily = $start_date_daily->diff(new DateTime($gunsonu));
     echo '<br>'.$since_start_daily->h.' hours<br>';
$i=$i+($since_start_daily->h)-1; echo '<td style="background-color:#F75D59"  colspan="'.$since_start_daily->h.'">';

          }///bir gün veya aydan fazla izinli ise case i kapanış
          else {  

/*
echo 'Bitiş:'.$bitis.'<br>';
$bitistarih=explode(" ", $bitis);

if($bitistarih==$date) { $baslangic=$date.' 09:00:00'; 
  echo $baslangic;
  $start_date_daily = new DateTime($baslangic);  
  $since_start_daily = $start_date_daily->diff(new DateTime($bitistarih)); 
  $i=$i+($since_start_daily->h)-1; echo '<td style="background-color:#F75D59"  colspan="'.$since_start_daily->h.'">';
}
*/

           $i=$i+($since_start->h)-1; echo '<td style="background-color:#F75D59"  colspan="'.$since_start->h.'">';  } ///izin sadece saatlik ise durumu


   } 
  elseif ($sayi>0) {   ///randevu var ise renk kodu////
         $sqlrenk = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."') and (randevuDurumID!='5')"; 
         $sayibitis= $this->db->query($sqlrenk)->num_rows();////
         $resultrenk = $this->db->query($sqlrenk)->result();
          foreach($resultrenk as $result){

        $randevudurum=$result->RandevuDurumID;
        $randevuID=$result->randevuID;
        $odaKisaltma=$result->odaKisaltma;
       
        $paketID=$result->paketID;
        if ($paketID!='') { 
        $toplamseans=$result->RandevuPaketSeansSayisi;
        $seans=$result->KacinciSeans;
        $yazi=$seans.'/'.$toplamseans;
         } else { $toplamseans=''; $seans=''; $yazi=''; }

echo '<td';

   if($sayibitis>1) { $arkaplanrengi='#2fbfc6'; echo ' style="background-color:#2fbfc6;" ';  }  
       /////randevu durumuna göre bg rengi
   if ($randevudurum=='1')  { $arkaplanrengi='#BDB76B'; echo ' style="background-color:#BDB76B;" ';   }  ///teyit alınmadı (kum rengi)
   if ($randevudurum=='6')  { $arkaplanrengi='#74767a'; echo ' style="background-color:#74767a;" ';   }  ///arandı, ulaşılamadı (gri)
   if ($randevudurum=='2')  { $arkaplanrengi='#FF8C00'; echo ' style="background-color:#FF8C00;" ';   }  ///teyit alındı (turuncu)
   if ($randevudurum=='3')  { $arkaplanrengi='#8B0000'; echo ' style="background-color:#8B0000;" ';   }  ///randevuya gelmedi (kırmızı)
   if ($randevudurum=='4')  { $arkaplanrengi='#54C571'; echo ' style="background-color:#54C571;" ';   }  ///randevuya geldi(yeşil)
         } 

         echo '>';
  } 
else { echo '<td class="td">'; /*echo $sayi.$sayimazeret;*/ }


              if ($sayi=="0" and $sayimazeret=="0") { 

///////////////////////////////////////////////////////////////////////////////////
/*$sqlmazeret = "SELECT * FROM ilsdanismanmazeret WHERE (mazeretBitisTarihSaat LIKE '%".$search."%') and (danismanUserID='".$user->id."')";
$sayibitis= $this->db->query($sqlmazeret)->num_rows();
//echo $sayibitis;
if ($sayibitis>0) {       $resultmazeretler = $this->db->query($sqlmazeret)->result();
                foreach($resultmazeretler as $resultmazeret){  
                  
                  $bitis=$resultmazeret->mazeretBitisTarihSaat;
                  //print_r($bitis);
                  $bitistarih=explode(" ", $bitis);
                  print_r($bitis);
                  echo '<br>';

if($bitistarih[0]==$date) { $baslangic=$date.' 09:00:00'; 
  echo $baslangic;
  $start_date_daily = new DateTime($baslangic);  
  $since_start_daily = $start_date_daily->diff(new DateTime($bitis)); 
  $i=$i+($since_start_daily->h)-1; echo '<td style="background-color:#F75D59"  colspan="'.$since_start_daily->h.'">';
}


                } 
              }*/
//////////////////////////////////////////////////////////////////////////////////////
            ////////  randevu al linki   /////////
              echo '<a href="';
              echo site_url('admin/terapi/randevu/randevuekle/').$date.'/'.$user->id.'/'.$i.'/'.$ofis.'" title="'.$i.':00 - '.($i+1).':00 aralığı">';             
              echo '<img src="';echo site_url('assets/admin/images/bos.png'); echo '" width="80" height="80">';
            //  echo '<p align="center"><font color="white" size="2">randevuAL</font></p>';
              echo '</a>'; 
            ////////randevu al linki sonu/////////





            }


              else if ($sayi=="0" and $sayimazeret>0)  { echo '<p  align="center"><font color="white" size="1">---------------- İzinli -------------------</font></p>';   }
                else { 


    echo '<div style="float:left">';
  if ($randevudurum=='5') { } else {
  echo '<a href="'.site_url('admin/terapi/randevu/randevuekle/').$date.'/'.$user->id.'/'.$i.'/'.$ofis;
  echo '"><small><span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:white"></span></small></a>&nbsp;
  </div><br>'; }




                foreach($results as $result)
                {  
                    $sqldanisan = "SELECT * FROM tbldanisan WHERE danisanID=".$result->danisanID;
                    $danisanlar = $this->db->query($sqldanisan)->result();
                    foreach($danisanlar as $danisan) {
//echo $result->danisanID;
$danisanid=$result->danisanID;



                       echo '<p align="center"><font color="white" size="1">';
                       echo '<a style="color:white; vertical-align: middle;" target="_blank" href="'.site_url('admin/terapi/danisan/danisandetay/').$danisan->danisanID.'" alt="açıklama" >'.$danisan->danisanAd." ".$danisan->danisanSoyad;
//////////////////her randevu için oda bilgilerinde danışanın id si de gerekli
         $sqlicdongu = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."') and (randevuDurumID!='5') and (danisanID='".$danisanid."')"; 
         $resulticdonguler = $this->db->query($sqlicdongu)->result();
          foreach($resulticdonguler as $resulticdongu){
          $odaKisaltma=$resulticdongu->odaKisaltma;
                       echo '('.$odaKisaltma.')'.$yazi.'</a>';
          }              

                       echo '             
  <div class="test col-md-12 text-center">
  <div style="float:left; margin-bottom:20px;">';


$sqlrandevuid = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (danisanID='".$danisanid."') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."') and (randevuDurumID!=5) order by randevuID desc limit 0,5";

        $resultsqlrandevuid = $this->db->query($sqlrandevuid)->result();
         foreach($resultsqlrandevuid as $resultrand){
        $randevuID=$resultrand->randevuID;
       // $odaKisaltma=$result->odaKisaltma;
       // echo $result->danisanID;
        $randevuinfo=$resultrand->randevuAciklama;
        $randevudurum=$resultrand->RandevuDurumID;

echo '<table border="0" width="80px;" style="background-color:#FF8C00;"><tr>';

        

//////////////////pencil////////////////////////////////
  echo '<td width="16px;"><div class="couponcode" >
     <span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:black; "></span>
      <span class="coupontooltiprandevu">'.$danisan->danisanAd.' '.$danisan->danisanSoyad.' adlı danışanın randevu durumunu değiştiriyorsunuz:
            <div class="form-group">';
                 $secilendurum = "SELECT * FROM vwrandevu where randevuID=".$randevuID;
                 $secilenrandevudurumlar = $this->db->query($secilendurum)->result();
                 foreach($secilenrandevudurumlar as $secilenrandevudurum){ 
                  $secilendurumAdi=$secilenrandevudurum->RandevuDurumAdi;
                  echo $secilendurumAdi;
                 }

                echo '<form class="autoSubmit" method="post" action="'.site_url('admin/terapi/randevu/randevudurumudegistir').'">';
                echo '<SELECT  name="randevular">';
                echo '<option style="color:black;">---</option>';
                $sqlrandevular = "SELECT * FROM tnmrandevudurum WHERE randevuDurumID!=".'5';
                    $randevular = $this->db->query($sqlrandevular)->result();
                    foreach($randevular as $randevu){
                  $durumid=$randevu->randevuDurumID;
                  $durumAdi=$randevu->randevuDurumAdi;
              
                  echo '<option style="color:black;" value="'.$durumid.'"';  echo'><font color="black;">'.$durumAdi.'</font></option>';

                      } 
                echo '</SELECT>';
                echo '<input type="hidden" name="randevuid" value="'.$randevuID.'">';
                echo '<input type="hidden" name="ofis" value="'.$ofis.'">';
                echo '<input type="hidden" name="date" value="'.$date.'">';
                echo '</form>';
               echo'
            </div>
     </span>
 </div></td>';
//////////////////pencil sonu////////////////////////////////
 

//////////////////x işareti/////////////////////////////////
    echo '<td width="16px;"><div>';
  if ($randevudurum=='5') { } else {
  echo '<a href="'.site_url('admin/terapi/randevu/randevuiptal/').$randevuID.'/'.$date.'/'.$ofis;
  echo '"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:black"></span></a> 
  </div></td>'; }
///////////////x işareti sonu/////////////////////////

 /////////////////info işareti////////////////////////////  
  if ($randevuinfo=='') { echo '<td width="25px;">'; } else {  ////açıklama varsa göster
  echo '<td width="16px;"><div class="couponcode" >
     <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color:black; "></span>
      <span class="coupontooltip">'.$randevuinfo;
 echo '
   </span>
 </div></td>'; }
/////////////////info işareti sonu///////////////////////////

 //////////////////saat işareti/////////////////////////////////
    echo '<td width="16px;"><div>';
  if ($randevudurum=='5') { } else {
  echo '<a href="'.site_url('admin/terapi/randevu/randevuertele/').$randevuID.'/'.$user->id.'/'.$i.'/'.$ofis;
  echo '"><span class="glyphicon glyphicon-time" aria-hidden="true" style="color:black"></span></a> 
  </div></td>'; }
///////////////saat işareti sonu/////////////////////////


////////danışan ismini yazdırrmadan önce  etiket simgesi//////
   echo '<td width="16px;"><div class="couponcode" style="float:right" >';
  if ($randevudurum=='5') { echo '</div>'; } else {
  echo '<form method="post" action="';echo site_url('admin/terapi/randevu/randevuinfodegistir/').$randevuID; echo '">';
  echo '<small><span class="glyphicon glyphicon-tag" aria-hidden="true" style="color:black"></span></small>';
  echo '</a>&nbsp;
  <span class="coupontooltiprandevu"><div class="form-group">
  <textarea name="randevuinfo" rows="4" cols="25" style="color:black">';
//echo $randevuID;
$sqlrandevuinfo = "SELECT * FROM vwrandevu WHERE randevuID=".$randevuID;
$resultsqlrandevuinfo = $this->db->query($sqlrandevuinfo)->result();
         foreach($resultsqlrandevuinfo as $result){
          $info=$result->randevuAciklama;
          echo $info;
          }

echo '</textarea>';
                echo '<input type="hidden" name="randevuid" value="'.$randevuID.'">';
                echo '<input type="hidden" name="ofis" value="'.$ofis.'">';
                echo '<input type="hidden" name="date" value="'.$date.'">';
                echo '<input type="submit" value="Gönder">';
                echo '</form>';
//////////form sonu////////
  echo '</div></span>
  </div></td>'; }
////////danışan ismini yazdırrmadan önce  etiket simgesi sonu//////


echo '</tr>
</table>';


}


 echo ' </div>
        </font>                   
        </p>'; 
 if($sayibitis>1) { echo '<hr style="vertical-align:middle; margin-top:40px;">'; }

                                }
                   // echo 'Hocanın IDsi='.$user->id;
                   // echo '<br>';
                   // echo 'Danışanın IDsi='.$result->randevuDanisanID;  
                   // echo '<br>';
                   // echo  $result->randevuDurumu;   
                         }

            }  
//içerikkk
if ($i==21) {echo "</td></tr>";} else {echo'</td>'; }   //////akşam saat 21 e kadar randevu veriliyor...
}
}
echo '</table>';
?>

            

        </div>
    </div>
</div>
