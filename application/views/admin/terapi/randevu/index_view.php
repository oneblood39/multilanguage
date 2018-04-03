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
$date=$dizi[2].'-'.$dizi[0].'-'.$dizi[1];  echo $date; } else { $date=$bugün; }


echo '<form method="post" action="http://localhost/multilanguage/admin/terapi/randevu">
<p>Tarih Seçiniz: <input name="tarih" type="text" id="datepicker"></p>';
echo '<input type="submit" value="Tarihe Git">';
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
echo '<td class="td">';
$search=$date.' '.$i;
//echo $search;
 //echo "test";
//echo '<img src="'.site_url('assests/admin/images/bos_arkaplan.png').'">';

                $sql = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$search."%') and (DanismanUserID='".$user->id."')"; /////burası user-id olmayabilir
                $results = $this->db->query($sql)->result();
               $sayi= $this->db->query($sql)->num_rows();
              if ($sayi=="0") { echo '<a href="';

               echo site_url('admin/terapi/randevu/randevuekle/').$date.'/'.$user->id.'/'.$i.'">';

               // echo '<a href="randevu/randevuekle/'.$date.'/'.$user->id.'/'.$i.'">';
              /*echo '<img src='.site_url('assets/admin/images/bos_arkaplan.png').'>*/

              echo '<p align="center"><font color="white" size="1">randevuAL</font></p>';
              echo '</a>'; }
                else {          
                foreach($results as $result)
                {  
                    $sqldanisan = "SELECT * FROM tbldanisan WHERE danisanID=".$result->danisanID;
                    $danisanlar = $this->db->query($sqldanisan)->result();
                    foreach($danisanlar as $danisan){

/*
$isim=$danisan->danisanAd;
$soyisim=$danisan->danisanSoyad;
$isimsoyisim=$isim." ".$soyisim;
$uzunluk = strlen($isimsoyisim);
                        if ($uzunluk > '10') {
$icerik = substr($isimsoyisim,0,10) . "...";
}
    $bul = array("Ä°", "Ä±", "Ã", "Ã¼", "Ä", "Ä", "Å", "Å", "Ã¶", "Ã", "Ã§", "Ã");
    $degistir = array("İ", "ı", "Ü", "ü", "Ğ", "ğ", "ş", "Ş", "ö", "Ö", "ç", "Ç");
 
    $duzenlenen_mesaj = str_replace($bul, $degistir, $icerik);
    echo $duzenlenen_mesaj;
*/
 
   /* $uzunlukisim = strlen($danisan->danisanAd);
    $uzunluksoyisim = strlen($danisan->danisanAd);
    $toplamuzunluk=$uzunlukisim+$uzunluksoyisim;
                            if ($toplamuzunluk > '10') {
                            $icerik = substr($danisan->danisanAd.' '.$danisan->danisanSoyad,0,12) . "...";
                            }
*/


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

            





            <?php
           /* if(!empty($groups))
            {
                echo '<table class="table table-hover table-bordered table-condensed">';
                echo '<tr><td>ID</td><td>Grup Adı</td></td><td>Grup Açıklaması</td><td>İşlemler</td></tr>';
                foreach($groups as $group)
                {
                    echo '<tr>';
                    echo '<td>'.$group->id.'</td><td>'.anchor('admin/users/index/'.$group->id, $group->name).'</td><td>'.$group->description.'</td><td>'.anchor('admin/groups/edit/'.$group->id,'<span class="glyphicon glyphicon-pencil"></span>');
                       if ($group->name=="admin") {   } else {
                       echo ' '.anchor('admin/groups/permissions/'.$group->id,'<span class="glyphicon glyphicon-user"></span>');} 
                    if(!in_array($group->name, array('admin','members'))) echo ' '.anchor('admin/groups/delete/'.$group->id,'<span class="glyphicon glyphicon-remove"></span>');

                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }*/
            ?>
        





        </div>
    </div>
</div>