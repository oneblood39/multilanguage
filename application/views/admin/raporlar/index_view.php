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

  //  echo '<a href="'.site_url('admin/terapi/cagri/cagriekle').'" class="btn btn-primary">Çağrı Ekle</a>';   

?>

        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="50%" id="productsListTable">
      <thead>
        <tr>
<td><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/cagri_raporlar');echo'"><img src="../../assets/admin/images/telefon.png"></a>'; ?></td>
<td><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/randevu_raporlar');echo'"><img src="../../assets/admin/images/takvim.png"></a>'; ?></td>
<td><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/danisman_raporlar');echo'"><img src="../../assets/admin/images/performans.png"></a>'; ?></td>
        </tr>
      </thead>
<?php





?>
<tr></tr>



    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           

        </div>
    </div>
</div>