<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12"> 
        <h2>Paket Bilgileri</h2> 
                  <?php
     $this->data['users'] = $this->ion_auth->users(array())->result();
     $user_id=$this->ion_auth->user()->row()->id;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;
    // echo $group_id;
   }

   if($group_id=='11' or $group_id=='10' or $group_id=='9') {
    echo '<a href="'.site_url('admin/terapi/seans/paketekle').'" class="btn btn-primary">Paket Ekle</a>';   
   } else {
     
   }
   echo '&nbsp;<a href="'.site_url('admin/terapi/seans/paketdanisantakip').'" class="btn btn-primary">Paket Danışan Takip</a>';  
?>  

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
          <th>1 Ayda Bitirilecek Min. Seans Say.</th>
          <th>İşlemler</th>
        </tr>
      </thead>
    </table>

        <div class="col-lg-12" style="margin-top: 10px;">

        </div>
    </div>
</div>