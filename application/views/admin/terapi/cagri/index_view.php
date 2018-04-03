<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
              <a href="<?php echo site_url('admin/terapi/cagri/createfast');?>" class="btn btn-primary">Hızlı Çağrı Ekle</a>
              <a href="<?php echo site_url('admin/terapi/cagri/create');?>" class="btn btn-primary">Çağrı Ekle</a>
   <br>
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="productsListTable">
      <thead>
        <tr>
          <th>Tarih/Saat</th>
          <th>Çağrı Yapan Ad</th>
          <th>Çağrı Yapan Soyad</th>
          <th>Çağrı Yapılan Ad</th>
          <th>Çağrı Yapılan Soyad</th>
          <th>Çağrı Yapan Tel</th>
          <th>İşlemler</th>


        </tr>
      </thead>
    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           


<?php //print_r($data);?>

        </div>
    </div>
</div>