<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/danisan');?>" class="btn btn-primary">Tüm Danışanlar</a>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h1>Danışan Ekle</h1>
        <?php  
//  $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 ?>
     
       

            <?php echo '<form>';?>
            <div class="form-group">
                <?php
                echo form_label('Ad','ad');
                echo form_error('ad');
                echo form_input('ad',set_value('ad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Soyad','soyad');
                echo form_error('soyad');
                echo form_input('soyad',set_value('soyad'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Tel','tel');
                echo form_error('tel');
                echo form_input('tel',set_value('tel'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Email','eposta');
                echo form_error('eposta');
                echo form_input('eposta',set_value('email'),'class="form-control"');
                ?>
            </div>

                    <div class="form-group">
            <?php echo form_label('Şifre','password');?>
            <?php echo form_error('password');?>
            <?php echo form_password('password','','class="form-control"');?>
        </div>
        
             <div class="form-group">
                <label>Danışan Tip:</label>
              <select name="danisantip" class="form-control">
                  <option value="1">Yetişkin</option>
                  <option value="2">Genç</option>
                  <option value="3">Çocuk</option>
              </select>
             </div>

            <div class="form-group">
                <?php
                echo form_label('Mizaç','mizac');
                echo form_error('mizac');
                echo form_input('mizac',set_value('mizac'),'class="form-control"');
                ?>
            </div>
                <?php //echo form_hidden('userid',$user_id);?>

            <?php echo form_submit('submit', 'Danışan Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>









        </div>
    </div>
</div>