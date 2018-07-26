<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
 <div class="col-lg-2 col-lg-offset-2">
<?php 
$danisanid=$this->uri->segment(5);
?>

 <a href="<?php echo site_url('admin/terapi/danisan/danisandetay/'.$danisanid);?>" class="btn btn-primary">Danışan Profiline Dön</a></div>
    <div class="row">
        

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Mizaç Testi Atama</h2>



<?php  //echo validation_errors();   ?>
<?php echo '<form id="form1" method="post" action="'.site_url('admin/terapi/danisan/mizactesti').'">'; ?>

 <?php //echo form_open();
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;
?>

            <div class="form-group">
                <label>Yaşınız:</label>
                            <select class="form-control" name="yas">
                                <?php 
                                    echo '<option value=""> -- </option>';
                                   for($i=5; $i<=90; $i++){
                                   
                                     echo '<option value="'; echo $i; echo'"'; echo'>'; echo $i; echo' </option>';

                                    }
                                ?>
                             </select>
            </div>

            <div class="form-group">
                           <label>Cinsiyetiniz: &nbsp &nbsp</label>
                            <label class="radio-inline">&nbsp
                                <input type="radio" name="cinsiyet" value="1"  checked="checked">  Kadın &nbsp &nbsp
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="cinsiyet" value="2"  >  Erkek
                            </label>
            </div>

             <?php echo form_hidden('userid',$user_id);?>
             <?php echo form_hidden('danisanid',$danisanid);?>
<input type="submit" class="btn btn-primary" value="Teste Başla">
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  </form>







    </div>
</div>