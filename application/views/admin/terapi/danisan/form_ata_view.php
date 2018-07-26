<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/danisan');?>" class="btn btn-primary">Tüm Danışanlar</a>

        </div>
<div class="col-lg-4 col-lg-offset-4">
            <h1>Form Atama</h1>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
  $danisan_id=$this->uri->segment(5);

//echo $user_id;
 ?>  
            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/form_ata_kaydet').'">'; ?>
            <div class="form-group">
                <?php
                echo form_label('Form Seçiniz:','form');
                echo form_error('form');
                echo form_dropdown('form',$formlar,'form','class="form-control"');
                ?>
            </div>

                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>

            <?php echo form_submit('submit', 'Form Atama', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>