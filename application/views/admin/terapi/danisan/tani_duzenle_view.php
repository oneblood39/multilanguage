<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
                    <?php $danisan_id=$this->uri->segment(5);
$danisantani_id=$this->uri->segment(6);
                     ?>
      <?php   echo '<a href="'.site_url('admin/terapi/danisan/danisandetay/').$danisan_id.'" class="btn btn-primary">Danışan Profiline Dön</a>'; ?>

        </div>
   <div class="col-lg-4 col-lg-offset-4">
            <h1>Tanı Ekle</h1>
        <?php  
  $user_id=$this->ion_auth->user()->row()->id;
//echo $user_id;
 ?>
     
            <?php //echo form_open();?>
            <?php echo '<form method="post" action="'.site_url('admin/terapi/danisan/taniguncelle').'">';   ?>
          <div class="form-group">
                <?php 
                /*
                echo form_label('Tanılar','tanilar');
                echo form_error('tanilar');
                echo form_dropdown('tanilar',$tanilar,'tanilar','class="form-control" ');  */
                
                ?>
            </div>

            <div class="form-group">
<label>Tanı Tipi</label>
<select name="tanilar" id="mark" class="form-control">
  <option value="">--</option>
  <?php
$resultstani = $this->db->query('SELECT * FROM vwdanisantani where danisantaniID='.$danisantani_id)->result();
foreach ($resultstani as $resulttani) {
  $tanitipID=$resulttani->taniTipID;
  $aciklama=$resulttani->taniAciklama;

if ($taniTipID==$danisantani_id) { echo '<option value="1" selected>Psikiyatrik Tanılar</option>'; } else { echo '<option value="1">Psikiyatrik Tanılar</option>'; }
if ($taniTipID==$danisantani_id) { echo '<option value="2" selected>Tıbbi Tanılar</option>'; } else { echo '<option value="2">Tıbbi Tanılar</option>'; }
  }
  echo $tanitipID;
  ?>
  

</select>
</div>
<!-- üsttekinin value değerini alttaki dropdownun class değerine ata! chain select  -->
<div class="form-group">
  <label>Tanılar</label>
<select name="alttanilar" id="series" class="form-control">
  <option value="">--</option>
  <?php
$results = $this->db->query('SELECT * FROM tnmtani')->result();
foreach ($results as $result) {
  $ID=$result->taniID;
  $tipID=$result->taniTip;
  $TipAdi=$result->taniAdi;
  $taniID=$result->danisantaniID;

echo '<option value="'.$ID.'" class="'.$tipID.'"';if($taniID==$danisantani_id){ echo 'selected';} else { }echo ' >'.$TipAdi.'</option>';

}
  ?>
</select>
 </div>
            <div class="form-group">
                <?php
                echo form_label('Açıklama:','tani');
                echo form_error('tani');
                echo form_textarea('tani',set_value('tani',$aciklama),'class="form-control"');
                ?>
            </div>

                <?php echo form_hidden('userid',$user_id);?>
                <?php echo form_hidden('danisanid',$danisan_id);?>
                <?php echo form_hidden('danisantaniid',$danisantani_id);?>

            <?php echo form_submit('submit', 'Tanı Oluştur', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan/danisandetay/'.$danisan_id, 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
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