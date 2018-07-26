<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/seans');?>" class="btn btn-primary">Tüm Paketler</a>
        </div>
        <div class="col-lg-4 col-lg-offset-4">
            <h1>Paket Düzenle</h1>        
            <?php 

            //echo '<form id="form1" method="post" action="';echo site_url('admin/terapi/seans/paketkaydet');echo '">';
$paketID=$this->uri->segment(5);

$sql="Select * from tblpaket where paketID=".$paketID;
$results=$this->db->query($sql)->result();
foreach ($results as $result) {
    $paketAdi=$result->paketAdi;
    $paketucret=$result->paketUcret;
    $paketSeansSayi=$result->paketSeansSayi;
    $minimumSeansSayisi=$result->minimumSeansSayisi;
    $paketTerapiTip=$result->paketTerapiTip;
}
             ?>
            <?php echo form_open();?>
            <div class="form-group">
                <?php
                echo form_label('Paket Adı','paket_adi');
                echo form_error('paket_adi');
                echo form_input('paket_adi',set_value('paket_adi',$paketAdi),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Ücret','ucret');
                echo form_error('ucret');
                echo form_input('ucret',set_value('ucret',$paketucret),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Toplam Seans Sayısı','toplam_seans');
                echo form_error('toplam_seans');
                echo form_input('toplam_seans',set_value('toplam_seans',$paketSeansSayi),'class="form-control"');
                ?>
            </div>
           <div class="form-group">
                <?php
                echo form_label('1 Ay İçinde Bitirilmesi Gereken Min. Seans Sayısı','min_seans');
                echo form_error('min_seans');
                echo form_input('min_seans',set_value('min_seans',$minimumSeansSayisi),'class="form-control"');
                ?>
                <?php echo form_hidden('paketID',$paketID);?>
            </div>

            <?php echo form_submit('submit', 'Paket Güncelle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/seans/', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>