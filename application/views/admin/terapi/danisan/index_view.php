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

   if($group_id=='11' or $group_id=='9') {
    echo '<a href="'.site_url('admin/terapi/danisan/create').'" class="btn btn-primary">Danışan Ekle</a>';   
   } else {
     
   }
?>           
              
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