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
#wgtmsr{
 width:190px;   
}
td {
background-image: url(../../../assests/images/bos_arkaplan.png);
background-repeat: repeat;
background-attachment: scroll;
background-color: white;
background-position: top-left;
}
table { background: url("../../assests/images/bos_arkaplan.png") no-repeat; }
</style>

<?php

$bugün = date("Y-m-d"); 
//echo $bugün;
$date=$this->input->post('tarih');
if ($date!='') {   
$dizi = explode ("/",$date);
$date=$dizi[2].'-'.$dizi[0].'-'.$dizi[1];  /*echo $date; */ } else { $date=$bugün; }

$ofis=$this->input->post('ofis'); if($ofis=='') {  $ofis=$this->ion_auth->user()->row()->company; }

//echo $ofis;



echo '<form method="post" action="http://localhost/multilanguage/admin/terapi/randevu"><table class="table  table-condensed"><tr>
<td><p>Tarih Seçiniz: <input name="tarih" type="text" id="datepicker" placeholder="';if ($date!='') { echo $date;} else { echo "-bugün-"; } echo'"></p></td>';
echo '<td><p>Ofis Seçiniz: <SELECT name="ofis" id="wgtmsr">
';
if ($this->ion_auth->user()->row()->company==3) {
$sqlofisler = "SELECT * FROM tblofis where ofisID!=3";
                    $ofisler = $this->db->query($sqlofisler)->result();
                    foreach($ofisler as $cofis){ 
                      $ofisID=$cofis->ofisID;
                      $ofisAdi=$cofis->ofisAdi;
   echo '<option value="'.$ofisID.'">'.$ofisAdi.'</option>'; 

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


 echo '<table class="table table-hover table-bordered table-condensed">';
 echo '<tr><td>Saat/Danışman</td>';
for ($i = 9; $i <= 21; $i++) {
echo '<td>';
echo $i.":00";
echo'</td>';
}
echo '</tr>';
foreach($users as $user)
                {
echo '<tr>';
echo "<td>";echo $user->username;"</td>";
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
                }
      $sayimazeret= $this->db->query($sqlmazeret)->num_rows(); 
                $sql = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (DanismanUserID='".$user->id."') and (ofisID='".$ofis."')"; /////burası user-id olmayabilir
                $results = $this->db->query($sql)->result();
               $sayi= $this->db->query($sql)->num_rows();

if ($sayimazeret>0) { echo '<td class="td" colspan="3">'; } else { echo '<td class="td">'; }


              if ($sayi=="0" and $sayimazeret=="0") { echo '<a href="';
              echo site_url('admin/terapi/randevu/randevuekle/').$date.'/'.$user->id.'/'.$i.'">';

               // echo '<a href="randevu/randevuekle/'.$date.'/'.$user->id.'/'.$i.'">';
              /*echo '<img src='.site_url('assets/admin/images/bos_arkaplan.png').'>*/

              echo '<p align="center"><font color="white" size="1">randevuAL</font></p>';
              echo '</a>'; }
              else if ($sayi=="0" and $sayimazeret>0)  { echo "---------------- izinli -------------------";   }
                else {          
                foreach($results as $result)
                {  
                    $sqldanisan = "SELECT * FROM tbldanisan WHERE danisanID=".$result->danisanID;
                    $danisanlar = $this->db->query($sqldanisan)->result();
                    foreach($danisanlar as $danisan){
                        echo '<p align="center"><font size="1"><a href="">'.$danisan->danisanAd." ".$danisan->danisanSoyad.'</a><br><a href=""></a></font></p>';                  
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