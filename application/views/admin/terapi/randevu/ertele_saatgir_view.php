<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">


    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Saat Değişikliği</h2>
 <?php 
$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7); 
$ofis= $this->uri->segment(8); 
$randevuid= $this->uri->segment(9);  
  ?>




<?php echo '<form id="form1" method="post" action="';echo site_url('admin/terapi/randevu/randevuerteleson/').$date.'/'.$danisman_id.'/'.$time.'/'.$ofis.'/'.$randevuid.'">';
echo '';
//action="../../../randevuekle_step1/'.$date.'/'.$danisman_id.'/'.$time.'"
?>
            <div class="form-group">
                <?php
                echo form_label('Randevu Başlangıç Saat','saat1');
                echo form_error('saat1');
                echo form_input('',set_value('',$time),' size="1" readonly');
    

                echo ':<SELECT name="dakika">
                <option>00</option>
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>40</option>
                <option>50</option>
                </select>';
                ?>
            </div>

<input type="submit" class="btn btn-primary" value="Randevuyu Ertele">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>
