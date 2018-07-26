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
<label>Çağrı Sonlandırma Durumu:</label>
<select name="cagridurum" class="form-control">
<option value="1">Açık</option>
<option value="2">Kapalı</option>
</select>';
                ?>
            </div>




 <div class="form-group">
                <?php
echo '<label>Randevuya Dönüşme Durumu:</label>
<select name="randevudurumu" id="mark" class="form-control">
';
$cagrikontrol="select * from vwcagri where cagriID=".$cagri_id." and cagriRandevuID>0";
$query=$this->db->query($cagrikontrol);
//$query->num_rows();
if($query->num_rows()>0) { 
echo '<option value="1">Randevuya Dönüştü</option>';
 } else { 
echo '<option value="2">Randevuya Dönüşmedi</option>';
   }
echo '</select>';
                ?>
            </div>

<!-- üsttekinin value değerini alttaki dropdownun class değerine ata! chain select  -->
<div class="form-group">
  <label>Randevuya Dönüşmeme Nedeni</label>
<select name="nedeni" id="series" class="form-control">
  <?php
$results = $this->db->query('SELECT * FROM tnmcagrirandevuyadonusmemenedeni')->result();
foreach ($results as $result) {
  $cagrirandevuyadonusmemenedeniID=$result->cagriRandevuyaDonusmemeNedeniID;
  $cagrirandevuyadonusmemenedeniadi=$result->cagriRandevuyaDonusmemeNedeniAdi;
echo '<option value="'.$cagrirandevuyadonusmemenedeniID.'" class="2">'.$cagrirandevuyadonusmemenedeniadi.'</option>';
}
  ?>
</select>
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

<script type="text/javascript">
(function($){$.fn.chained=function(parent_selector,options){return this.each(function(){var self=this;var backup=$(self).clone();$(parent_selector).each(function(){$(this).bind("change",function(){$(self).html(backup.html());var selected="";$(parent_selector).each(function(){selected+="\\"+$(":selected",this).val();});selected=selected.substr(1);var first=$(parent_selector).first();var selected_first=$(":selected",first).val();$("option",self).each(function(){if(!$(this).hasClass(selected)&&!$(this).hasClass(selected_first)&&$(this).val()!==""){$(this).remove();}});if(1==$("option",self).size()&&$(self).val()===""){$(self).attr("disabled","disabled");}else{$(self).removeAttr("disabled");}
$(self).trigger("change");});if(!$("option:selected",this).length){$("option",this).first().attr("selected","selected");}
$(this).trigger("change");});});};$.fn.chainedTo=$.fn.chained;})(jQuery);
  </script>
<script type="text/javascript">
  $("#series").chained("#mark");
</script>