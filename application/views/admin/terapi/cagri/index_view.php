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

   if($group_id=='11' or $group_id=='10' or $group_id=='9') {
    echo '<a href="'.site_url('admin/terapi/cagri/cagriekle').'" class="btn btn-primary">Çağrı Ekle</a>';   
   } else {
     
   }
?>

             <!-- <a href="<?php //echo site_url('admin/terapi/cagri/cagriekle');?>" class="btn btn-primary">Çağrı Ekle</a> -->
              <a href="<?php echo site_url('admin/terapi/cagri/kurumsalcagri');?>" class="btn btn-primary">Kurumsal Çağrılar</a>
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="productsListTable">
      <thead>
        <tr>
          <th>Tarih/Saat</th>
          <th>Ad</th>
          <th>Soyad</th>
          <th>Çağrı Yapılan Ad</th>
          <th>Çağrı Yapılan Soyad</th>
          <th>Çağrı Yapan Tel</th>
          <th>Yakınlık Derecesi</th>
          <th>Çağrı Nedeni</th>
          <th>Çağrı Kaynağı</th>
          <th>Randevu Bilgileri</th>
          <th>İşlemler</th>
        </tr>
      </thead>
    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           


<?php //print_r($data);?>

        </div>
    </div>
</div>