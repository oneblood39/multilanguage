<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
                    <?php
                    $danisan_id=$this->uri->segment(5);
                    $danisanilac_id=$this->uri->segment(6);
$sql="select * from vwdanisanilac where danisanilacID=".$danisanilac_id;
$results = $this->db->query($sql)->result();
foreach ($results as $result) {
$aciklama=$result->ilacAciklama;
}


                     ?>
      <?php   echo '<a href="'.site_url('admin/terapi/danisan/danisandetay/').$danisan_id.'" class="btn btn-primary">Danışan Profiline Dön</a>'; ?>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h1>İlaç Ekle</h1>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 ?>
     
            <?php //echo form_open();?>
            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/ilacguncelle').'">';   ?>
            <div class="form-group">
                <?php
                echo form_label('İlaç Bilgisi:','ilac');
                echo form_error('ilac');
                echo form_textarea('ilac',set_value('ilac',$aciklama),'class="form-control"');
                ?>
            </div>
                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>
                <?php echo form_hidden('danisanilacid',$danisanilac_id);?>

            <?php echo form_submit('submit', 'ilaç Güncelle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan/danisandetay/'.$danisan_id, 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>