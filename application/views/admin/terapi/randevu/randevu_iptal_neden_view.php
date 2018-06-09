<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">

    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Randevu İptal Nedeni</h2>
 <?php 
 $randevu_id= $this->uri->segment(5);
 $date= $this->uri->segment(6);
 $ofis= $this->uri->segment(7);

  ?>



<?php echo '<form id="form1" method="post" action="';echo site_url('admin/terapi/randevu/randevuiptal/').$randevu_id.'/'.$date.'/'.$ofis;echo '">';
echo '';
//action="../../../randevuekle_step1/'.$date.'/'.$danisman_id.'/'.$time.'"
?>
            <div class="form-group">
                <?php
                echo form_label('İptal Nedeni Seçiniz:','iptalneden');
                echo form_error('iptalneden');
                echo form_dropdown('iptalneden',$iptalneden,'iptalneden','class="form-control"');
                ?>
            </div>
           

 <?php echo form_submit('submit', 'Randevuyu İptal Et', 'class="btn btn-primary btn-lg btn-block"');?>
 <?php echo anchor('/admin/terapi/randevu', 'İptal','class="btn btn-default btn-lg btn-block"');?>
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>