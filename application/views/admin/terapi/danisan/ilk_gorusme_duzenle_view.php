<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
<?php 
$danisanid=$this->uri->segment(5);
$gorusmeid=$this->uri->segment(6);
?>

 <a href="<?php echo site_url('admin/terapi/danisan/danisandetay/'.$danisanid);?>" class="btn btn-primary">Danışan Profiline Dön</a></div>
    <div class="row">
        

        <div class="col-lg-4 col-lg-offset-4">
            <h2>İlk Görüşme Notu Düzenle</h2>


<?php echo '<form id="form1" method="post" action="'.site_url('admin/terapi/danisan/ilkgorusmeguncelle').'">'; ?>

 <?php //echo form_open();
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;

$sql="select * from tbldanisanilkgorusme where danisanilkGorusmeID=".$gorusmeid;
$results=$this->db->query($sql)->result();
foreach ($results as $result) {
    $kisilik=$result->gozeCarpanKisilikOruntusu;
    $konu=$result->konuBasliklari;
    $annemizac=$result->anneMizacID;
    $babamizac=$result->babaMizacID;
}


?>

            <div class="form-group">
                <?php
                echo form_label('Göze Çarpan Kişilik Örüntüsü:','kisilik');
                echo form_error('kisilik');
                echo form_textarea('kisilik',set_value('kisilik',$kisilik),'class="form-control"');
                ?>
            </div>
           <div class="form-group">
                <?php
                echo form_label('Konu Başlıkları:','konu');
                echo form_error('konu');
                echo form_textarea('konu',set_value('konu',$konu),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
echo '<label>Anne Mizaç</label>';                
echo '<select name="annemizac" class="form-control">';
$sqlmizacanne='Select * From tnmmizactip';
$results=$this->db->query($sqlmizacanne)->result();
foreach ($results as $result) {
    $mizacTipID=$result->mizacTipID;
    $mizacTipAdi=$result->mizacTipAdi;
    echo '<option value="'.$mizacTipID.'"'; if($mizacTipID==$annemizac) { echo 'selected'; } else { } echo'>'.$mizacTipAdi.'</option>';
}

echo'</select>';
                ?>
            </div>
            <div class="form-group">
                 <?php
echo '<label>Baba Mizaç</label>';                
echo '<select name="babamizac" class="form-control">';
$sqlmizacbaba='Select * From tnmmizactip';
$results=$this->db->query($sqlmizacbaba)->result();
foreach ($results as $result) {
    $mizacTipID=$result->mizacTipID;
    $mizacTipAdi=$result->mizacTipAdi;
    echo '<option value="'.$mizacTipID.'"'; if($mizacTipID==$babamizac) { echo 'selected'; } else { } echo'>'.$mizacTipAdi.'</option>';
}

echo'</select>';
                ?>
            </div>

             <?php echo form_hidden('userid',$user_id);?>
             <?php echo form_hidden('danisanid',$danisanid);?>
             <?php echo form_hidden('gorusmeid',$gorusmeid);?>
<input type="submit" class="btn btn-primary" value="İlk Görüşme Notu Güncelle">
  </form>







    </div>
</div>