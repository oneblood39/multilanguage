<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/danisan');?>" class="btn btn-primary">Tüm Danışanlar</a>

        </div>
<?php $danisan_id= $this->uri->segment(5); ?>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 ?>
        <div class="col-lg-4 col-lg-offset-4">
            <h1>Danışan Ekle</h1>
        
            <?php echo form_open();?>
            <div class="form-group">
                <?php
                echo form_label('Ad','ad');
                echo form_error('ad');
                echo form_input('ad',set_value('ad',$Ad),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Soyad','soyad');
                echo form_error('soyad');
                echo form_input('soyad',set_value('soyad',$Soyad),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Tel','tel');
                echo form_error('tel');
                echo form_input('tel',set_value('tel',$Tel),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('E-Posta','eposta');
                echo form_error('eposta');
                echo form_input('eposta',set_value('eposta',$Eposta),'class="form-control"');
                ?>
            </div>

          <div class="form-group">
                <?php
$sql= "select * from tbldanisan where danisanID=".$danisan_id;

    $results = $this->db->query($sql)->result();

foreach ($results as $result) {
  $tip=$result->danisanTip;
}


echo '      
    <label>Danışan Tip:</label>
              <select name="danisantip" class="form-control">';
                  echo '<option value="1"';if($tip==1) {echo 'selected';} else { } echo '>Yetişkin</option>
                  <option value="2"';if($tip==2) {echo 'selected';} else { } echo '>Genç</option>
                  <option value="3"';if($tip==3) {echo 'selected';} else { } echo '>Çocuk</option>';
              echo '</select>';
                ?>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Mizaç','mizac');
                echo form_error('mizac');
                echo form_input('mizac',set_value('mizac',$Mizac),'class="form-control"');
                ?>
            </div>
             <?php echo form_hidden('danisanID',$danisan_id);?>

            <?php echo form_submit('submit', 'Güncelle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>