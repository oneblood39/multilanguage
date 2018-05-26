<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
<?php  
                    $danisan_id=$this->uri->segment(5);
                    $danisanilacID=$this->uri->segment(6);  
 $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 $sql="select * from vwdanisanilac where danisanilacID=".$danisanilacID;
 $results = $this->db->query($sql)->result();
foreach ($results as $result) {
    $gelenilac=$result->psikiyatriilacID;
    $gelendoz=$result->ilacDozID;
    $gelenaciklama=$result->ilacAciklama;
    $danisanAd=$result->danisanAd;
    $danisanSoyad=$result->danisanSoyad;
}
 ?>
    <div class="row">
                <div class="col-lg-12">

      <?php   echo '<a href="'.site_url('admin/terapi/danisan/danisandetay/').$danisan_id.'" class="btn btn-primary">Danışan Profiline Dön</a>'; ?>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h2>Psikiyatrik İlaç Düzenle</h2>

     
            <?php //echo form_open();
                    echo '<b><h4>('.$danisanAd.' '.$danisanSoyad.')</h4></b>';
            ?>
            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/psikiyatrikilacguncelle').'">';   ?>
            <div class="form-group">
                <?php
                echo form_label('İlaçlar','ilac');
                echo form_error('ilac');
                echo form_dropdown('ilac',$ilac,$gelenilac,'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Doz','doz');
                echo form_error('doz');
                echo form_dropdown('doz',$doz,$gelendoz,'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama:','aciklama');
                echo form_error('aciklama');
                echo form_textarea('aciklama',set_value('aciklama',$gelenaciklama),'class="form-control"');
                ?>
            </div>
                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>
                <?php echo form_hidden('danisanilacID',$danisanilacID);?>

            <?php echo form_submit('submit', 'ilaç Düzenle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan/danisandetay/'.$danisan_id, 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>