<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
             
              <a href="<?php echo site_url('admin/terapi/randevu');?>" class="btn btn-primary">Randevu Takvim</a>
   <br>
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="randevuListTable">
      <thead>
        <tr>
        
          <th>Danışan Ad</th>
          <th>Danışan Soyad</th>
          <th>Danışman Ad</th>
          <th>Danışman Soyad</th>
          <th>Terapi Tip</th>
          <th>Tarih</th>
          <th>Paket Adı</th>
          <th>Seansı</th>

          <th>İşlemler</th>


        </tr>
      </thead>
    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           


<?php //print_r($data);?>

        </div>
    </div>
</div>