<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
 <a href="<?php echo site_url('admin/terapi/cagri/');?>" class="btn btn-primary">Tüm Çağrılar</a></div>

    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Kurumsal Çağrı Ekle</h2>



<?php echo '<form id="form1" method="post" action="../cagri/kurumsalcagrikaydet/">';
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;

//echo $user_id;
?>
 <div class="form-group">
                <?php
                echo form_label('Çağrı Yapan Kurum','kurum');
                echo form_error('kurum');
                echo form_input('kurum',set_value('kurum'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Ad','ad');
                echo form_error('ad');
                echo form_input('ad',set_value('ad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Soyad','soyad');
                echo form_error('soyad');
                echo form_input('soyad',set_value('soyad'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('İrtibat Tel','tel');
                echo form_error('tel');
                echo form_input('tel',set_value('tel'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('İrtibat E-Posta','eposta');
                echo form_error('eposta');
                echo form_input('eposta',set_value('eposta'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama','info');
                echo form_error('info');
                echo form_textarea('info',set_value('info'),'class="form-control"');
                ?>
            </div>
             <div class="form-group">
                <?php   echo form_label('İlgili Kişisi','ilgili');  ?>
  <select id='callbacks' multiple='multiple' name='coklu[]'>
<?php 
    $sql = "SELECT * FROM vwusers where group_id=3 or group_id=8";
    $results = $this->db->query($sql)->result();
         foreach ($results as $result) {
               $user=$result->id;
               $ad=$result->first_name;
               $soyad=$result->last_name;
            echo '  <option value="'.$user.'">'.$ad.' '.$soyad.'</option>';
                } 
?>




</select>
</div>


             <?php echo form_hidden('cagritipi','1');?>
             <?php echo form_hidden('id',$user_id);?>
             <?php echo form_hidden('ofisID',$company);?>
<input type="submit" class="btn btn-primary" value="Çağrı Ekle">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>

    </div>
</div>