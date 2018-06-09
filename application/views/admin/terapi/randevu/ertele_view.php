<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
   
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
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
<style type="text/css">
#form1{
  padding:10px;
  border:2px solid #3498db;
 /* background:#F0F8FF; */
  border-radius:15px;
  display:none;
}
#submit{
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 15px;
  background: #3498db;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

#submit:hover{
  background: #3cb0fd;
  text-decoration: none;
}
</style>

<?php
//error_reporting(0);
$bugun = date("Y/m/d"); 
//echo $bugün;
//echo $this->session->userdata('date');
$randevuid= $this->uri->segment(5);
$userid= $this->uri->segment(6);
$ofis= $this->uri->segment(8);
/*
else if ($this->session->userdata('date')!='') {
$date=$this->session->userdata('date');   
$dizi = explode ("/",$date);
$date=$dizi[2].'-'.$dizi[0].'-'.$dizi[1];  /*echo $date;  } 

*/




$date=$bugun;

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
echo '<form method="post" action="'; echo site_url('admin/terapi/randevu/randevuertele/').$randevuid.'/'.$userid.'/'.'ofis'.'/'.$ofis; echo '"><table><tr>
<td><p><b>Tarih Seçiniz: </b><input autocomplete="off" name="tarih" type="text" id="datepicker" placeholder="';if ($date!='') {  } else { echo "-bugün-"; } echo'"></p></td>';

if($this->ion_auth->user()->row()->company=='1' or $this->ion_auth->user()->row()->company=='2') 
{  $ofis=$this->ion_auth->user()->row()->company;
echo '<input type="hidden" name="ofis" value="'.$ofis.'">';

   }
else {

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

echo '</SELECT></p><input type="submit" class="btn btn-primary" value="Git"></td></tr></table>';

}////if sonu



echo '<td>&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary" value="Tarihe Git"></td></tr></table>';
echo form_close();



 echo' <br>
';

/////////////üst form sonu///////////////////

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

 echo '<b>'.$date.'</b>';
 echo '<table class="table table-hover table-bordered table-condensed">';
 echo '<tr><td>Saat/Danışman</td>';
for ($i = 9; $i <= 21; $i++) {
echo '<td>';
echo $i.":00";
echo'</td>';
}
echo '</tr>';
$ortak=3;
//$sqlusers = "SELECT * FROM users WHERE company=".$ofis." or company=".$ortak;

//echo $userid;
$sqlusers = "SELECT * FROM vwusers WHERE (company=".$ofis." or company='3') and id=".$userid." and id in (select ID from vwdanisman) order by first_name asc";
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
                   // $mazeretAdi=$resultmazeret->mazeretAdi;
                  $mazeretAciklama=$resultmazeret->mazeretAciklama;

                  //print_r($bitis);
                  //echo ($baslangic);
                  
 
                    $metinb=explode(' ', $baslangic);
                   //print_r($metinb['1']);
                    $saat=$metinb['1'];
                    $saatbaslangic=explode(':',$saat);
                                 $bassaat=$saatbaslangic['0'];
                               //  print_r($bassaat);
                       $metinbitis=explode(' ', $bitis);
                       $saat=$metinbitis['1'];
                       $saatbitis=explode(':',$saat);
                            $bitsaat=$saatbitis['0'];
                          //  print_r($bitsaat);
if($bassaat==$bitsaat) { $bitsaat=$bitsaat+1; $bitis=$metinb['0'].' '.$bitsaat.':00:00'; }
                //  print_r($bitis);
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
//print_r($bitistarih[0]);

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

   if($sayibitis>1) { echo ' style="background-color:#2fbfc6;" ';  }  
       /////randevu durumuna göre bg rengi
   if ($randevudurum=='1')  { echo ' style="background-color:#BDB76B;" ';   }  ///teyit alınmadı (kum rengi)
   if ($randevudurum=='6')  { echo ' style="background-color:#74767a;" ';   }  ///arandı, ulaşılamadı (gri)
   if ($randevudurum=='2')  { echo ' style="background-color:#FF8C00;" ';   }  ///teyit alındı (turuncu)
   if ($randevudurum=='3')  { echo ' style="background-color:#8B0000;" ';   }  ///randevuya gelmedi (kırmızı)
   if ($randevudurum=='4')  { echo ' style="background-color:#54C571;" ';   }  ///randevuya geldi(yeşil)
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
              echo site_url('admin/terapi/randevu/randevuertelesaatgir/').$date.'/'.$user->id.'/'.$i.'/'.$ofis.'/'.$randevuid.'">';             
              echo '<img src="';echo site_url('assets/admin/images/bos.png'); echo '" width="70" height="70">';
            //  echo '<p align="center"><font color="white" size="2">randevuAL</font></p>';
              echo '</a>'; 
             
            ////////randevu al linki sonu/////////



            }


              else if ($sayi=="0" and $sayimazeret>0)  { echo '<p  align="center"><font color="white" size="2"><b><u></u></b></font></p>
<p  align="center"><font color="white" size="2">('.$mazeretAciklama.')</font></p>

                ';   }
                else { 


    echo '<div style="float:left">';
  if ($randevudurum=='5') { } else {
  echo '<a href="'.site_url('admin/terapi/randevu/randevuertelesaatgir/').$date.'/'.$user->id.'/'.$i.'/'.$ofis.'/'.$randevuid;
  echo '"><small><span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:white"></span></small></a>&nbsp;
  </div><br>'; }





                foreach($results as $result)
                {  
                    $sqldanisan = "SELECT * FROM tbldanisan WHERE danisanID=".$result->danisanID;
                    $danisanlar = $this->db->query($sqldanisan)->result();
                    foreach($danisanlar as $danisan){



                       echo '<p align="center"><font color="white" size="2">';
                       echo ''.$danisan->danisanAd." ".$danisan->danisanSoyad.'('.$odaKisaltma.')'.$yazi;
                       echo '             
  <div class="test col-md-12 text-center">
  <div style="float:left; margin-bottom:20px;">';

$sqlrandevuid = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (danisanID='".$result->danisanID."') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."')";
        $resultsqlrandevuid = $this->db->query($sqlrandevuid)->result();
         foreach($resultsqlrandevuid as $resultrand){
        $randevuID=$resultrand->randevuID;
        $randevuinfo=$resultrand->randevuAciklama;
        $randevudurum=$resultrand->RandevuDurumID;
        



 





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
