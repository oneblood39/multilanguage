<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
                    <?php $danisan_id=$this->uri->segment(5); ?>
      <?php   echo '<a href="'.site_url('admin/terapi/danisan/danisandetay/').$danisan_id.'" class="btn btn-primary">Danışan Profiline Dön</a>'; ?>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h1>Tanı Ekle</h1>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 ?>
     
            <?php //echo form_open();?>
            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/tanikaydet').'">';   ?>
          <div class="form-group">
                <?php
                echo form_label('Tanılar','tanilar');
                echo form_error('tanilar');
                echo form_dropdown('tanilar',$tanilar,'tanilar','class="form-control" ');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama:','tani');
                echo form_error('tani');
                echo form_textarea('tani',set_value('tani'),'class="form-control"');
                ?>
            </div>
                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>

            <?php echo form_submit('submit', 'Tanı Oluştur', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan/danisandetay/'.$danisan_id, 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>