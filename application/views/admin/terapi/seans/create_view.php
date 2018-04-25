<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/seans');?>" class="btn btn-primary">Tüm Paketler</a>
        </div>
        <div class="col-lg-4 col-lg-offset-4">
            <h1>Paket Ekle</h1>        
            <?php echo '<form id="form1" method="post" action="';echo site_url('admin/terapi/seans/paketkaydet');echo '">'; ?>
            <div class="form-group">
                <?php
                echo form_label('Paket No','paketno');
                echo form_error('paketno');
                echo form_input('paketno',set_value('paketno'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Paket Adı','paket_adi');
                echo form_error('paket_adi');
                echo form_input('paket_adi',set_value('paket_adi'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Ücret','ucret');
                echo form_error('ucret');
                echo form_input('ucret',set_value('ucret'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Toplam Seans Sayısı','toplam_seans');
                echo form_error('toplam_seans');
                echo form_input('toplam_seans',set_value('toplam_seans'),'class="form-control"');
                ?>
            </div>
            <?php echo form_submit('submit', 'Paket Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/seans/paketekle', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>