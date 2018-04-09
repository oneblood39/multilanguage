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

<?php

$bugün = date("Y-m-d"); 
//echo $bugün;
$date=$this->input->post('tarih');
if ($date!='') {   
$dizi = explode ("/",$date);
$date=$dizi[2].'-'.$dizi[0].'-'.$dizi[1];  /*echo $date; */ } else { $date=$bugün; }
echo 'Seçili Tarih:'; print_r($date);
$ofis=$this->input->post('ofis'); if($ofis=='') {  $ofis=$this->ion_auth->user()->row()->company; }

//echo $ofis;


/////////////üst form///////////////////
echo '<form method="post" action="http://localhost/multilanguage/admin/terapi/randevu"><table class="table  table-condensed"><tr>
<td><p><b>Tarih Seçiniz: </b><input name="tarih" type="text" id="datepicker" placeholder="';if ($date!='') { echo $date;} else { echo "-bugün-"; } echo'"></p></td>';
echo '<td><p><b>Ofis Seçiniz: </b><SELECT name="ofis" id="wgtmsr">
';
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
echo '<td><input type="submit" class="btn btn-primary" value="Filtrele"></td></tr></table>';
echo form_close();
/////////////üst form sonu///////////////////



 echo '<table class="table table-hover table-bordered table-condensed">';
 echo '<tr><td>Saat/Danışman</td>';
for ($i = 9; $i <= 21; $i++) {
echo '<td>';
echo $i.":00";
echo'</td>';
}
echo '</tr>';
$ortak=3;
$sqlusers = "SELECT * FROM users WHERE company=".$ofis." or company=".$ortak;
//print_r($sqlusers);
                  $users = $this->db->query($sqlusers)->result();
foreach($users as $user)
   
                {  $isim=$user->first_name.' '.$user->last_name;
echo '<tr>';
echo "<td>";echo $isim;"</td>";
for ($i = 9; $i <= 21; $i++) {

$search=$date.' '.$i;
//echo $search;
 //echo "test";
//echo '<img src="'.site_url('assests/admin/images/bos_arkaplan.png').'">';
      $sqlmazeret = "SELECT * FROM ilsdanismanmazeret WHERE (mazeretBaslangicTarihSaat LIKE '%".$search."%') and (danismanUserID='".$user->id."')";
      $resultmazeretler = $this->db->query($sqlmazeret)->result();
                foreach($resultmazeretler as $resultmazeret){  
                  $baslangic=$resultmazeret->mazeretBaslangicTarihSaat;
                  $bitis=$resultmazeret->mazeretBitisTarihSaat;
                  print_r($bitis);
                }
      $sayimazeret= $this->db->query($sqlmazeret)->num_rows(); 
                $sql = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."')"; /////burası user-id olmayabilir
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
  elseif ($sayi>0) {
  echo '<td style="background-color:#54C571" >'; ///randevu var ise renk kodu
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
                echo '<a href="';
              echo site_url('admin/terapi/randevu/randevuekle/').$date.'/'.$user->id.'/'.$i.'">';

               // echo '<a href="randevu/randevuekle/'.$date.'/'.$user->id.'/'.$i.'">';
              /*echo '<img src='.site_url('assets/admin/images/bos_arkaplan.png').'>*/

              echo '<p align="center"><font color="white" size="1">randevuAL</font></p>';
              echo '</a>'; }


              else if ($sayi=="0" and $sayimazeret>0)  { echo '<p  align="center"><font color="white" size="1">---------------- İzinli -------------------</font></p>';   }
                else {          
                foreach($results as $result)
                {  
                    $sqldanisan = "SELECT * FROM tbldanisan WHERE danisanID=".$result->danisanID;
                    $danisanlar = $this->db->query($sqldanisan)->result();
                    foreach($danisanlar as $danisan){
                        echo '<p align="center"><font color="white" size="2">
                       <a style="color:white; vertical-align: middle;" href="" alt="açıklama" >'.$danisan->danisanAd." ".$danisan->danisanSoyad.'</a></font></p>
                   
                        ';                  
                                }
                   // echo 'Hocanın IDsi='.$user->id;
                   // echo '<br>';
                   // echo 'Danışanın IDsi='.$result->randevuDanisanID;  
                   // echo '<br>';
                   // echo  $result->randevuDurumu;   
                         }

            }  
//içerikkk
if ($i==21) {echo "</td></tr>";} else {echo'</td>'; }
}
}
echo '</table>';
?>

            




        </div>
    </div>
</div>