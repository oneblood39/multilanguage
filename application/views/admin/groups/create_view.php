<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <h1>Grup Oluştur</h1>
            <?php echo form_open();?>
            <div class="form-group">
                <?php echo form_label('Grup adı','group_name');?>
                <?php echo form_error('group_name');?>
                <?php echo form_input('group_name',set_value('group_name'),'class="form-control"');?>
            </div>
            <div class="form-group">
                <?php echo form_label('Grup açıklaması','group_description');?>
                <?php echo form_error('group_description');?>
                <?php echo form_input('group_description',set_value('group_description'),'class="form-control"');?>
            </div>
            <?php echo form_submit('submit', 'Grup Oluştur', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/groups', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>