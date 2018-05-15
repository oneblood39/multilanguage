<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
              
      <?php   //echo '<a href="'.site_url('admin/terapi/danisan/danisandetay/').$danisan_id.'" class="btn btn-primary">Danışan Profiline Dön</a>'; ?>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h1>İlaç Ekle</h1>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
 ?>
     
            <?php //echo form_open();?>
            <?php echo '<form method="post" action="'.site_url('admin/terapi/tanimlar/ilackaydet').'">';   ?>
            <div class="form-group">
                <?php
                echo form_label('İlaç Adı:','ilac');
                echo form_error('ilac');
                echo form_input('ilac',set_value('ilac'),'class="form-control"');
                ?>
            </div>
             <div class="form-group">
                <label>Toplam Dozu:</label>
     <select name="toplamdoz" class="form-control">
        <?php 
         for ($i=0; $i <100 ; $i++) {      echo '<option>'.$i.'</option>'; 
         }
    
         ?>
     </select>
             </div>
                <?php echo form_hidden('userid',$user_id);?>

            <?php echo form_submit('submit', 'ilaç Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/tanimlar/', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>