<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <style type="text/css">
.myimage {
    height: 64px;
    width: 64px;
}

.group1
{
    position: absolute;
    left:5%;
    top: -50px;
}
.group2
{
    position: absolute;

    left: -20%;
    top: 10%;
}
.group3
{
    position: absolute;

    left: 25%;
    top: 10%;
}
.group4
{
    position: absolute;

    left: 5%;
    top: -50px;
}
.group5
{
    position: absolute;

    left: -20%;
    top: 10%;
}
.group6
{
    position: absolute;

    left: 25%;
    top: 10%;
}
.group7
{
    position: absolute;

    left: 5%;
    top: -50px;
}
.group8
{
    position: absolute;

    left: -20%;
    top: 10%;
}
.group9
{
    position: absolute;

    left:25%;
    top: 10%;
}
  </style>
<div class="container" style="margin-top:60px;">
  <div>
  <div class="col-sm-4" >
  <?php echo'<img src="../../assets/admin/images/phone.png" class="group1" ></a>'; ?>
    <br>
    <button type="button" class="group2" ><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/cagri_raporlar');echo'"><img src="../../assets/admin/images/excelk.png"></a>'; ?></button>
    <button type="button" class="group3" ><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/cagri_grafik');echo'"><img src="../../assets/admin/images/chart.png"></a>'; ?></button>
</div>
<div class="col-sm-4">
    <?php echo'<img src="../../assets/admin/images/timee.png" class="group4"></a>'; ?>
    <br>
    <button type="button" class="group5" ><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/randevu_raporlar');echo'"><img src="../../assets/admin/images/excelk.png"></a>'; ?></button>
    <button type="button" class="group6" ><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/randevu_grafik');echo'"><img src="../../assets/admin/images/chart.png"></a>'; ?></button>
</div>
<div class="col-sm-4" >
    <?php echo'<img src="../../assets/admin/images/user.png" class="group7"></a>'; ?>
    <br>
    <button type="button" class="group8" ><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/danisman_raporlar');echo'"><img src="../../assets/admin/images/excelk.png"></a>'; ?></button>
    <button type="button" class="group9" ><?php echo '<a href="';echo site_url('admin/raporlar/raporlar/danisman_grafik');echo'"><img src="../../assets/admin/images/chart.png"></a>'; ?></button>
</div>


</div>
<br>
<br>
<br>
<br>
<br>
<br>
 
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
   

<?php

?>
<tr></tr>



    </table>



        <div class="col-lg-12" style="margin-top: 10px;">
           

        </div>
    </div>
</div>