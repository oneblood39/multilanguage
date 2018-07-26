<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
  $danisan_id=$this->uri->segment(5);

//echo $user_id;
 ?>  

            <a href="<?php echo site_url('admin/terapi/danisan/danisandetay/').$danisan_id;?>" class="btn btn-primary">Tüm Danışanlar</a>

        </div>
<div class="col-lg-4 col-lg-offset-4">
            <h2>Mizaç Belirleme</h2>

            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/mizac_gir_kaydet').'">'; ?>
            <div class="form-group">
                <?php
                echo form_label('Mizaç Seçiniz:','mizac');
                echo form_error('mizac');
                echo form_dropdown('mizac',$mizaclar,'mizac','class="form-control"');
                ?>
            </div>

                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>

            <?php echo form_submit('submit', 'Mizaç Belirle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan/danisandetay'.$danisan_id, 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>