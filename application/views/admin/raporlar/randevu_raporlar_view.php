<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">  
<?php
     $this->data['users'] = $this->ion_auth->users(array())->result();
     $user_id=$this->ion_auth->user()->row()->id;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;
    // echo $group_id;
   }

  //  echo '<a href="'.site_url('admin/terapi/cagri/cagriekle').'" class="btn btn-primary">Çağrı Ekle</a>';   

?>

             <!-- <a href="<?php //echo site_url('admin/terapi/cagri/cagriekle');?>" class="btn btn-primary">Çağrı Ekle</a> 
              <a href="<?php echo site_url('admin/terapi/cagri/kurumsalcagri');?>" class="btn btn-primary">Kurumsal Çağrılar</a> -->
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="productsListTable">
      <thead>
        <tr>
<td><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/ankara_gunluk_randevu');echo'">Ankara Söğütözü Günlük Rapor</a>'; ?></td>
<td><?php echo 'ikonlar'; ?></td>
        </tr>
      </thead>
<?php



/*
$sql="SELECT 
randevuID,
concat(DanismanAd,' ',DanismanSoyad) as Danisman,
concat(danisanAd,' ', danisanSoyad) as Danisan,
randevuBaslangicTarihSaat as randevu_saati,
odaAdi,
terapiAdi,
seansTipAdi as seansTipi,
RandevuDurumAdi,
ilkRandevuMu,
paketID,
RandevuPaketi,
RandevuPaketSeansSayisi,
KacinciSeans,
randevuAciklama

FROM mizmeryonetim.vwrandevu where randevuBaslangicTarihSaat between '2018-05-31 00:00:00' and '2018-05-31 22:00:00' 
and RandevuDurumID <>5
and ofisID=1
order by DanismanAd,randevuBaslangicTarihSaat";

$results=$this->db->query($sql)->result();
echo '<table>';
foreach ($results as $result) {

  $Danisman=$result->Danisman;
  $Danisan=$result->Danisan;
  echo '<tr><td>'.$Danisman;
  echo '</td>';
  echo '<td>'.$Danisan.'</td>';
  echo '</tr>';
}
echo '</table>';






//$this->db->query("SET AUTOCOMMIT=0");
//$this->db->trans_start();

//$data = $this->db->simple_query("CALL test()");
 //$error = $this->db->error(); 
//$stmt->store_result();
//$this->db->reconnect();
//$this->db->trans_complete();
//$result = $data->result();

//$sql="spRandevuTarihListele('2018-05-01 00:00:00','2018-05-30 22:00:00')";
//$field_names = array($sql);
/*$data = array(
  'www' => '2018-05-01 00:00:00',
  'www2' => '2018-05-30 00:00:00'
   );
*/
/* $sql = "CALL test()"; 
     $result = $this->db->query($sql)->result();

//print_r($data);
/*
$result = $this->db->query($sql,array( 
  'www' => '2018-05-01 00:00:00',
'www2' => '2018-05-30 00:00:00'));
*/ //$xx = $this->db->call_function("test"); 
//$results = $this->db->query($sql)->result();

/*foreach ($results as $result) {
  $test=$result->DanismanAd;
}
*/




?>
<tr></tr>



    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           

        </div>
    </div>
</div>