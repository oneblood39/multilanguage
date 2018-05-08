<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
<style type="text/css">
#form1{
  padding:10px;
  border:2px solid #3498db;
 /* background:#F0F8FF; */
  border-radius:15px;
  display:none;
}
#submit{
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 15px;
  background: #3498db;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

#submit:hover{
  background: #3cb0fd;
  text-decoration: none;
}
</style>


    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Randevu Ekle</h2>
 <?php 
$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7);  

                $datasession = array(
                    'randevuDanismanID' => $danisman_id,                  
                    'date' => $date,
                    'time' => $time                                    
                );

$this->load->library('session');
$this->session->set_flashdata('item', $datasession);
  ?>
<button type="button" class="btn btn-primary" id="birkan">Yeni Danışan</button>
<?php 
echo '<a href="';
echo site_url('admin/terapi/danisan/indexrandevuekle/');
echo '"'; 
echo 'class="btn btn-primary" id="birkan">Mevcut Danışan</a>';
?>
<br><br>
<?php echo '<form method="post" action="../../../../danisan/">';?>
    <?php echo form_hidden('date',$date);?>
    <?php echo form_hidden('danismanID',$danisman_id);?>
    <?php echo form_hidden('time',$time);?>
<!--<input type="submit" class="btn btn-primary" value="Mevcut Danışan">-->
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>



<?php echo '<form id="form1" method="post" action="';echo site_url('admin/terapi/randevu/randevuekle_step1/').$date.'/'.$danisman_id.'/'.$time;echo '">';
echo '';
//action="../../../randevuekle_step1/'.$date.'/'.$danisman_id.'/'.$time.'"
?>
 <div class="form-group">
                <?php
                echo form_label('Danışan Ad','ad');
                echo form_error('ad');
                echo form_input('ad',set_value('ad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışan Soyad','soyad');
                echo form_error('soyad');
                echo form_input('soyad',set_value('soyad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışan Tel','tel');
                echo form_error('tel');
                echo form_input('tel',set_value('tel'),'class="form-control"');
                ?>
            </div>
<input type="submit" class="btn btn-primary" value="Danışan Ekle">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>