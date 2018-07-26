<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12"> 
        <h2>Paket Bilgileri</h2>            
              <a href="<?php echo site_url('admin/terapi/seans/');?>" class="btn btn-primary">Tüm Paketler</a>
        </div>
    </div>
    <div class="row">

      <br><br></div>

     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="seansListTable">
      <thead>
        <tr>
          <th>Danışan Adı</th>
          <th>Danışan Soyadı</th>
          <th>PaketID</th>
          <th>Paket Adı</th>
          <th>Paket Seans Sayısı</th>
          <th>Tamamlanan Seans Sayısı</th>
          <th>Paket Durumu</th>
        </tr>
      </thead>
    </table>

        <div class="col-lg-12" style="margin-top: 10px;">

        </div>
    </div>
</div>