<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
                    <?php $danisan_id=$this->uri->segment(5);
                          $danisman_id=$this->uri->segment(6);
                          $randevu_id=$this->uri->segment(7);
                          $iptalneden=$this->uri->segment(8);
                     ?>
      <?php   echo '<a href="'.site_url('admin/terapi/danisan/droplar/').'" class="btn btn-primary">Droplar Menüsü</a>'; ?>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h2>Drop Giriş</h2>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 ?>
     
            <?php //echo form_open();?>
            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/dropkaydet').'">';   ?>
            <div class="form-group">
                <?php
                echo form_label('Drop Nedeni:','neden');
                echo form_error('neden');
                echo form_dropdown('neden',$nedenler,'neden','class="form-control" ');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama:','aciklama');
                echo form_error('aciklama');
                echo form_textarea('aciklama',set_value('aciklama'),'class="form-control"');
                ?>
            </div>
                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>
                <?php echo form_hidden('danismanid',$danisman_id);?>
                <?php echo form_hidden('randevuid',$randevu_id);?>
                <?php echo form_hidden('iptalneden',$iptalneden);?>

            <?php echo form_submit('submit', 'Drop Et', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan/droplar/', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>