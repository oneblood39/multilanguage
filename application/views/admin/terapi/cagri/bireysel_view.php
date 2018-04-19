<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
 <a href="<?php echo site_url('admin/terapi/cagri/');?>" class="btn btn-primary">Tüm Çağrılar</a></div>
    <div class="row">
        

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Bireysel Çağrı Ekle</h2>




<?php echo '<form id="form1" method="post" action="../cagri/bireyselcagrikaydet/">';
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;
?>
 <div class="form-group">
                <?php
                echo form_label('Çağrı Yapan Ad','ad');
                echo form_error('ad');
                echo form_input('ad',set_value('ad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Çağrı Yapan Soyad','soyad');
                echo form_error('soyad');
                echo form_input('soyad',set_value('soyad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışan Ad (Çağrı Yapılan) ','cad');
                echo form_error('cad');
                echo form_input('cad',set_value('cad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışan Soyad (Çağrı Yapılan)','csoyad');
                echo form_error('csoyad');
                echo form_input('csoyad',set_value('csoyad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Çağrı Yapan Tel','tel');
                echo form_error('tel');
                echo form_input('tel',set_value('tel'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Çağrı Yapan E-Posta','eposta');
                echo form_error('eposta');
                echo form_input('eposta',set_value('eposta'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Yakınlık','cagriyakinlik');
                echo form_error('cagriyakinlik');
                echo form_dropdown('cagriyakinlik',$yakinlik,'cagriyakinlik','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Yonlenme','cagriyonlenme');
                echo form_error('cagriyonlenme');
                echo form_dropdown('cagriyonlenme',$yonlenme,'cagriyonlenme','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Çağrı Nedeni','cagrineden');
                echo form_error('cagrineden');
                echo form_dropdown('cagrineden',$neden,'neden','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama','info');
                echo form_error('info');
                echo form_textarea('info',set_value('info'),'class="form-control"');
                ?>
            </div>
             <?php echo form_hidden('cagritipi','1');?>
             <?php echo form_hidden('id',$user_id);?>
             <?php echo form_hidden('ofisID',$company);?>
<input type="submit" class="btn btn-primary" value="Çağrı Ekle">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>