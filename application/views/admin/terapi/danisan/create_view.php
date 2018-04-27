<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/danisan');?>" class="btn btn-primary">Tüm Danışanlar</a>

        </div>

        <div class="col-lg-4 col-lg-offset-4">
            <h1>Danışan Ekle</h1>
        
            <?php echo form_open();?>
            <div class="form-group">
                <?php
                echo form_label('Ad','first_name');
                echo form_error('first_name');
                echo form_input('ad',set_value('first_name'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Soyad','last_name');
                echo form_error('last_name');
                echo form_input('soyad',set_value('last_name'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Tel','phone');
                echo form_error('phone');
                echo form_input('tel',set_value('phone'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Email','email');
                echo form_error('eposta');
                echo form_input('eposta',set_value('email'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Mizaç','phone');
                echo form_error('phone');
                echo form_input('mizac',set_value('phone'),'class="form-control"');
                ?>
            </div>


            <?php echo form_submit('submit', 'Danışan Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>