<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
<?php 
$danisanid=$this->uri->segment(5);
?>

 <a href="<?php echo site_url('admin/terapi/danisan/danisandetay/'.$danisanid);?>" class="btn btn-primary">Danışan Profiline Dön</a></div>
    <div class="row">
        

        <div class="col-lg-4 col-lg-offset-4">
            <h2>İlk Görüşme Notu Ekle</h2>



<?php  //echo validation_errors();   ?>
<?php echo '<form id="form1" method="post" action="'.site_url('admin/terapi/danisan/ilkgorusmekaydet').'">'; ?>

 <?php //echo form_open();
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;
?>

            <div class="form-group">
                <?php
                echo form_label('Göze Çarpan Kişilik Örüntüsü:','kisilik');
                echo form_error('kisilik');
                echo form_textarea('kisilik',set_value('kisilik'),'class="form-control" placeholder="Kişiliğin normal yönleri.. Kişiliğin patolojik olabilecek yönleri.."');
                ?>
            </div>
           <div class="form-group">
                <?php
                echo form_label('Konu Başlıkları:','konu');
                echo form_error('konu');
                echo form_textarea('konu',set_value('konu'),'class="form-control" placeholder="Bulgular, hikayesi , özet bulgular"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Anne Mizaç','annemizac');
                echo form_error('annemizac');
                echo form_dropdown('annemizac',$mizac,'annemizac','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Baba Mizaç','babamizac');
                echo form_error('babamizac');
                echo form_dropdown('babamizac',$mizac,'babamizac','class="form-control"');
                ?>
            </div>

             <?php echo form_hidden('userid',$user_id);?>
             <?php echo form_hidden('danisanid',$danisanid);?>
<input type="submit" class="btn btn-primary" value="İlk Görüşme Notu Ekle">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>