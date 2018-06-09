<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
 <a href="<?php echo site_url('admin/terapi/cagri/');?>" class="btn btn-primary">Tüm Çağrılar</a></div>
    <div class="row">
        

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Çağrı Sonlandır</h2>



<?php  $cagri_id=$this->uri->segment(5);   ?>
<?php echo '<form  method="post" action="';echo site_url('admin/terapi/cagri/cagrisonlandir');echo '">'; ?>

 <?php //echo form_open();
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;
?>
 <div class="form-group">
                <?php
echo '
<select name="randevudurumu" class="form-control">
<option value="1">Randevuya Dönüştü</option>
<option value="2">Randevuya Dönüşmedi</option>
</select>';
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama','info');
                echo form_error('info');
                echo form_textarea('info',set_value('info'),'class="form-control"');
                ?>
            </div>
             <?php echo form_hidden('cagriID',$cagri_id);?>
<input type="submit" class="btn btn-primary" value="Çağrı Sonlandır">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>