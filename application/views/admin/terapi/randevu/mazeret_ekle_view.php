<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
 <a href="<?php echo site_url('admin/terapi/randevu/mazeretler');?>" class="btn btn-primary">Tüm Mazeretler</a></div>
    <div class="row">
        

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Mazeret Ekle</h2>



<?php  //echo validation_errors();   ?>
<?php echo '<form id="form1" method="post" action="'.site_url('admin/terapi/randevu/mazeretkaydet').'">'; ?>

 <?php //echo form_open();
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;
?>

            <div class="form-group">
                <label for="dtp_input1">Mazeret Başlangıç</label>
                <div class="input-group date form_datetime form-control" data-date-format="yyyy-mm-dd HH:ii:00 p" data-link-field="dtp_input1">
                    <input name="baslangic" class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" /><br/>
            </div>

          <div class="form-group">
                <label for="dtp_input1">Mazeret Bitiş</label>
                <div class="input-group date form_datetime form-control" data-date-format="yyyy-mm-dd HH:ii:00 p" data-link-field="dtp_input1">
                    <input name="bitis" class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" /><br/>
            </div>

            <div class="form-group">
                <?php
                echo form_label('Danışmanlar','danismanlar');
                echo form_error('danismanlar');
                echo form_dropdown('danismanlar',$danismanlar,'danismanlar','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Mazeretler','mazeretler');
                echo form_error('mazeretler');
                echo form_dropdown('mazeretler',$mazeretler,'mazeretler','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama','info');
                echo form_error('info');
                echo form_textarea('info',set_value('info'),'class="form-control"');
                ?>
            </div>
             
             <?php echo form_hidden('id',$user_id);?>
             
<input type="submit" class="btn btn-primary" value="Mazeret Ekle">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>
