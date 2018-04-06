<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
             
              <a href="<?php echo site_url('admin/terapi/danisan/create');?>" class="btn btn-primary">Danışan Ekle</a>
   <br>
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="danisanListTable">
      <thead>
        <tr>
        
          <th>Danışan Ad</th>
          <th>Danışan Soyad</th>
          <th>Danışan E-Posta</th>
          <th>Danışan Tel</th>
          <th>İşlemler</th>


        </tr>
      </thead>
    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           


<?php //$datasessionmevcut = $this->session->flashdata('item'); 

//print_r($datasessionmevcut);
?>

        </div>
    </div>
</div>