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

              <a href="<?php echo site_url('admin/terapi/cagri/');?>" class="btn btn-primary">Bireysel Çağrılar</a>
              <a href="<?php echo site_url('admin/terapi/cagri/devamedencagrilar');?>" class="btn btn-primary">Devam Eden Çağrılar</a>
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="kurumsalcagriListTable">
      <thead>
        <tr>
          <th>Tarih/Saat</th>
          <th>Kurum</th>
          <th>Ad</th>
          <th>Soyad</th>
          <th>Konu</th>
          <th>Tel</th>
          <th>E-Posta</th>
          <th>Durumu</th>
          <th>İşlemler</th>


        </tr>
      </thead>
    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           


<?php //print_r($data);?>

        </div>
    </div>
</div>