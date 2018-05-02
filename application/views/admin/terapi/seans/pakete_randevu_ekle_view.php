<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
 
</div>

    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Pakete Randevu Ekle</h2>



<?php echo '<form id="form1" method="post" action="';echo site_url('admin/terapi/seans/paketrandevukaydet');echo '">';
//$user_id=$this->ion_auth->user()->row()->id;
//$company=$this->ion_auth->user()->row()->company;
$danisan_id= $this->uri->segment(5);
$paket_id= $this->uri->segment(6);
//echo $danisan_id;
//echo '<br>';
//echo $paket_id;
//echo $user_id;
?>

  <div class="form-group">
      <?php   echo form_label('Randevular:','ilgili');  ?>
  <select id='callbacks' multiple='multiple' name='coklu[]'>
<?php 
    $sql = "SELECT * FROM vwrandevu  where paketID IS NULL and (danisanID=".$danisan_id.')';
    $results = $this->db->query($sql)->result();
         foreach ($results as $result) {
               $danismanad=$result->DanismanAd;
               $danismansoyad=$result->DanismanSoyad;
               $randevuID=$result->randevuID;
               $tarih=$result->randevuBaslangicTarihSaat;
               $terapi=$result->terapiAdi;
          echo '  <option value="'.$randevuID.'">'.$danismanad.' '.$danismansoyad.'-'.$tarih.'-'.$terapi.'</option>';
                } 
?>
</select>
</div>
             <?php echo form_hidden('danisan_id',$danisan_id);?>
             <?php echo form_hidden('paketid',$paket_id);?>
<input type="submit" class="btn btn-primary" value="Ekle">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>

   </div>
</div>