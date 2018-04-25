<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12"> 
        <h2>Seans Bilgileri</h2>            
              <a href="<?php echo site_url('admin/terapi/seans/paketekle');?>" class="btn btn-primary">Paket Ekle</a>
            <!--  <a href="<?php echo site_url('admin/terapi/cagri/kurumsalcagri');?>" class="btn btn-primary">Kurumsal Çağrılar</a> -->
        </div>
    </div>
    <div class="row">

      <br><br></div>

     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="seansListTable">
      <thead>
        <tr>
          <th>Paket No</th>
          <th>Paket Adı</th>
          <th>Ücreti</th>
          <th>Paket Seans Sayısı</th>
          <th>İşlemler</th>
        </tr>
      </thead>
    </table>

        <div class="col-lg-12" style="margin-top: 10px;">

        </div>
    </div>
</div>