<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 <style type="text/css">
   

   
 </style>


   <div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
            <a href="<?php echo site_url('admin/terapi/danisan');?>" class="btn btn-primary">Tüm Danışanlar</a>
 
        </div>
   <div class="col-lg-4 col-lg-offset-4">
            

            <?php echo '<form>';?>
            <h2>Kişisel</h2>

            <div class="form-group">
              <label>Ad-Soyad</label>
              <select name="danisan-ad" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tbldanisan')->result();
              foreach ($results as $result) {
              $danisanID=$result->danisanID;
               $danisanAd=$result->danisanAd;
               $danisanSoyad=$result->danisanSoyad;
              echo '<option value="'.$danisanID.'">'.$danisanAd ." ".$danisanSoyad.'</option>';
              }
               ?>
              </select>
              </div>
 
              <div class="form-group">
              <label>Telefon numaranız</label>
              <select name="danisan-tel" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tbldanisan')->result();
              foreach ($results as $result) {
              $danisanID=$result->danisanID;
               $danisanTel=$result->danisanTel;
              echo '<option value="'.$danisanID.'">'.$danisanTel.'</option>';
              }
               ?>
              </select>
              </div>
            

             <div class="form-group">
                <?php
                echo form_label('Email','eposta');
                echo form_error('eposta');
                echo form_input('eposta',set_value('email'),'class="form-control"');
                ?>
            </div>
          
             <div class="form-group">
                <?php echo form_label('Cinsiyet: ', 'cinsiyet'); ?><?php echo form_label('kadın', 'kadın') . form_radio('kadın', 'kadın'); ?><?php echo form_label('erkek', 'erkek') . form_radio('erkek', 'erkek'); ?><?php echo form_error('cinsiyet-error'); ?>
             </div>

             <div class="form-group">
                <label>Yaş</label>
              <select name="cocuk-yas" class="form-control">
                  
            <?php 
               for($i=1; $i<=90; $i++){
                 echo '<option value="'.$i.'">'.$i.'</option>';
                }
            ?>
            </select>
            </div>

            <div class="form-group">
              <label>Eğitim durumu</label>
              <select name="egitim-durumu" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmegitimdurum')->result();
              foreach ($results as $result) {
              $egitimDurumID=$result->egitimDurumID;
               $egitimDurumAdi=$result->egitimDurumAdi;
              echo '<option value="'.$egitimDurumID.'">'.$egitimDurumAdi.'</option>';
              }
               ?>
              </select>
              </div>

             

             <!--İkamet-->
             <div class="form-group">
              <label>İkamet ettiğiniz yer</label>
              <select name="ikamet-il" id="mark" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmil')->result();
              foreach ($results as $result) {
              $ilID=$result->ilID;
               $ilAdi=$result->ilAdi;
              echo '<option value="'.$ilID.'">'.$ilAdi.'</option>';
              }
               ?>
              </select>
              </div>
              <!-- üsttekinin value değerini alttaki dropdownun class değerine ata! chain select  -->
              <div class="form-group">
               <label>İlçe</label>
              <select name="ikamet-ilce" id="series" class="form-control">
               <option value="">--</option>
               <?php
              $results = $this->db->query('SELECT * FROM tnmilce')->result();
              foreach ($results as $result) {
               $ilceID=$result->ilceID;
               $ilID=$result->ilID;
               $ilceAdi=$result->ilceAdi;
              echo '<option value="'.$ilceID.'" class="'.$ilID.'">'.$ilceAdi.'</option>';
              }
               ?>
              </select>
              </div>


              <!-- Memleket -->
              <div class="form-group">
              <label>Memleketiniz</label>
              <select name="memleket-il" id="mark1" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmil')->result();
              foreach ($results as $result) {
              $ilID=$result->ilID;
               $ilAdi=$result->ilAdi;
              echo '<option value="'.$ilID.'">'.$ilAdi.'</option>';
              }
               ?>
              </select>
              </div>
              <!-- üsttekinin value değerini alttaki dropdownun class değerine ata! chain select  -->
              <div class="form-group">
               <label>İlçe</label>
              <select name="memleket-ilce" id="series1" class="form-control">
               <option value="">--</option>
               <?php
              $results = $this->db->query('SELECT * FROM tnmilce')->result();
              foreach ($results as $result) {
               $ilceID=$result->ilceID;
               $ilID=$result->ilID;
               $ilceAdi=$result->ilceAdi;
              echo '<option value="'.$ilceID.'" class="'.$ilID.'">'.$ilceAdi.'</option>';
              }
               ?>
              </select>
              </div>



             <div class="form-group">
                <label>Bize Nereden Ulaştınız</label>
              <select name="neren-ulastiniz" class="form-control">
                  <option value="internet">İnternet</option>
                  <option value="tavsiyesi">Yakın Tavsiyesi</option>
                  
              </select>
             </div>

             <div class="form-group">
                <label>Medeni Durumunuz</label>
              <select name="medeni-durum" class="form-control">
                  <option value="evli">evli</option>
                  <option value="bekar">bekar</option>
                  <option value="bosanmis">boşanmış</option>
                  
              </select>
             </div>

            <div class="form-group">
              <label>Mesleğiniz</label>
              <select name="meslek" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmmeslek')->result();
              foreach ($results as $result) {
              $meslekID=$result->meslekID;
              $meslekAdi=$result->meslekAdi;
              echo '<option value="'.$meslekID.'">'.$meslekAdi.'</option>';
              }
               ?>
              </select>
              </div>

            <div class="form-group">
                <?php
                echo form_label('Meslek açıklaması','meslek-aciklama');
                echo form_error('meslek-aciklama');
                echo form_input('meslek-aciklama',set_value('meslek-aciklama'),'class="form-control"');
                ?>
            </div>

            



            <div class="form-group">
              <label>Başvuru nedeniniz</label>
              <select name="basvuru" id="basvuru" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmbasvurunedeni')->result();
              foreach ($results as $result) {
              $basvuruNedeniID=$result->basvuruNedeniID;
               $basvuruNedeniAdi=$result->basvuruNedeniAdi;
              echo '<option value="'.$basvuruNedeniID.'">'.$basvuruNedeniAdi.'</option>';
              }
               ?>
              </select>
              </div>
              <!-- üsttekinin value değerini alttaki dropdownun class değerine ata! chain select  -->
              <div class="form-group">
               <label>Alt başvuru nedenini seçiniz</label>
              <select name="altbasvuru" id="altbasvuru" class="form-control">
               <option value="">--</option>
               <?php
              $results = $this->db->query('SELECT * FROM tnmaltbasvurunedeni')->result();
              foreach ($results as $result) {
               $altBasvuruNedeniID=$result->altBasvuruNedeniID;
               $basvuruNedeniID=$result->basvuruNedeniID;
               $altBasvuruNedeniAdi=$result->altBasvuruNedeniAdi;
              echo '<option value="'.$altBasvuruNedeniID.'" class="'.$basvuruNedeniID.'">'.$altBasvuruNedeniAdi.'</option>';
              }
              echo $basvuruNedeniID;
               ?>
              </select>

              

              

             <div class="form-group">
                <?php
                echo form_label('Danışmanlık alma nedeniniz (kısaca)','danismanlik-nedeni');
                echo form_error('danismanlik-nedeni');
                echo form_input('danismanlik-nedeni',set_value('danismanlik-nedeni'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php echo form_label('Mevcut tıbbi sorununuz var mı? : ', 'mevcut-tibbi-sorun'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('mevcut-tibbi-sorun'); ?>
             </div>

             <div class="form-group">
                <?php
                echo form_label('Mevcut tıbbi sorununuz','tibbi-sorun');
                echo form_error('tibbi-sorun');
                echo form_input('tibbi-sorun',set_value('tibbi-sorun'),'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <?php echo form_label('Kullandığınız ilaç var mı? : ', 'kullanilan-ilac'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('kullanilan-ilac'); ?>
             </div>

             <div class="form-group">
              <label>En son ne zaman fiziki muayene oldunuz ?</label>
              <select name="fiziki-muayene" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmfizikimuayene')->result();
              foreach ($results as $result) {
              $fizikiMuayeneID=$result->fizikiMuayeneID;
              $fizikiMuayeneAdi=$result->fizikiMuayeneAdi;
              echo '<option value="'.$fizikiMuayeneID.'">'.$fizikiMuayeneAdi.'</option>';
              }
               ?>
              </select>
              </div>

            <div class="form-group">
                <?php echo form_label('Önemli Bir Hastalık Geçirdniz mi : ', 'onemli-hastalik'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('onemli-hastalik'); ?>
             </div>

              <div class="form-group">
                <?php echo form_label('Önemli Bir Kaza Geçirdiniz mi : ', 'onemli-kaza'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('onemli-kaza'); ?>
             </div>

             <div class="form-group">
              <label>Kan grubunuz</label>
              <select name="kan-grubu" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmkangrubu')->result();
              foreach ($results as $result) {
              $kanGrubuID=$result->kanGrubuID;
              $kanGrubuAdi=$result->kanGrubuAdi;
              echo '<option value="'.$kanGrubuID.'">'.$kanGrubuAdi.'</option>';
              }
               ?>
              </select>
              </div>

            <div class="form-group">
                <?php echo form_label('Daha Önce Psikolojik/Psikiyatrik Bir Yardım Aldınız mı?: ', 'psikolojik-psikiyatrik-yardim'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır', 'hayır'); ?><?php echo form_error('psikolojik-psikiyatrik-yardim'); ?>
             </div>

             <div class="form-group">
                <?php echo form_label('Psikiyatrik ilaç kullandınız mı ? : ', 'psikiyatrik-ilac'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('psikiyatrik-ilac'); ?>
             </div>

            <div class="form-group">
                <?php echo form_label('Annniz hayatta mı? : ', 'anne-yasama'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('anne-yasama'); ?>
               </div>

             <div class="form-group">
                <?php echo form_label('Babanız hayatta mı ? : ', 'baba-yasama'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('baba-yasama'); ?>
               </div>

            <div class="form-group">
                <label>Kaç Kardeşsiniz ? </label>
              <select name="kardes-sayisi" class="form-control">
            <?php 
               for($i=0; $i<=10; $i++){
                 echo '<option value="'.$i.'">'.$i.'</option>';
                }
            ?>     
             </select>
             </div>

             <div class="form-group">
                <label>Kaç çocuğunuz var ? </label>
              <select name="cocuk-sayisi" class="form-control">
            <?php 
               for($i=0; $i<=10; $i++){
                 echo '<option value="'.$i.'">'.$i.'</option>';
                }
            ?>     
             </select>
             </div>

             <div class="form-group">
                <?php echo form_label('Düzenli alkol Kullanıyor musunuz ?: ', 'alkol-kullanimi'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('alkol-kullanimi'); ?>
             </div> 

             <div class="form-group">
              <label>Alkol kullanıyorsanız ne sıklıkla ?</label>
              <select name="alkol-siklik" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmbagimlilikdurum')->result();
              foreach ($results as $result) {
              $bagimlilikDurumID=$result->bagimlilikDurumID;
              $bagimlilikDurumAdi=$result->bagimlilikDurumAdi;
              echo '<option value="'.$bagimlilikDurumID.'">'.$bagimlilikDurumAdi.'</option>';
              }
               ?>
              </select>
              </div>

              <div class="form-group">
                <?php echo form_label('Sigara Kullanıyor musunuz ? : ', 'sigara-kullanimi'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('sigara-kullanimi'); ?>
             </div>

             <div class="form-group">
                <?php echo form_label('Uyuşturucu Kullanıyormusunuz : ', 'uyusturucu-kullanimi'); ?><?php echo form_label('Evet', 'evet') . form_radio('evet','evet'); ?><?php echo form_label('Hayır', 'hayır') . form_radio('hayır','hayır'); ?><?php echo form_error('uyusturucu-kullanimi'); ?>
             </div>

             <div class="form-group">
              <label>Uyuşturucu kullanıyorsanız ne sıklıkla ?</label>
              <select name="uyusturucu-siklik" class="form-control">
               <option value="">--</option>
               <?php 
              $results = $this->db->query('SELECT * FROM tnmbagimlilikdurum')->result();
              foreach ($results as $result) {
              $bagimlilikDurumID=$result->bagimlilikDurumID;
              $bagimlilikDurumAdi=$result->bagimlilikDurumAdi;
              echo '<option value="'.$bagimlilikDurumID.'">'.$bagimlilikDurumAdi.'</option>';
              }
               ?>
              </select>
              </div>
            

            


            
                <?php //echo form_hidden('userid',$user_id);?>
 
            <?php echo form_submit('submit', 'Formu Kaydet', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/danisan', 'İptal','class="btn btn-default btn-lg btn-block"');?>
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

<script type="text/javascript">
(function($){$.fn.chained=function(parent_selector,options){return this.each(function(){var self=this;var backup=$(self).clone();$(parent_selector).each(function(){$(this).bind("change",function(){$(self).html(backup.html());var selected="";$(parent_selector).each(function(){selected+="\\"+$(":selected",this).val();});selected=selected.substr(1);var first=$(parent_selector).first();var selected_first=$(":selected",first).val();$("option",self).each(function(){if(!$(this).hasClass(selected)&&!$(this).hasClass(selected_first)&&$(this).val()!==""){$(this).remove();}});if(1==$("option",self).size()&&$(self).val()===""){$(self).attr("disabled","disabled");}else{$(self).removeAttr("disabled");}
$(self).trigger("change");});if(!$("option:selected",this).length){$("option",this).first().attr("selected","selected");}
$(this).trigger("change");});});};$.fn.chainedTo=$.fn.chained;})(jQuery);
 </script>
<script type="text/javascript">
 $("#series1").chained("#mark1");
</script>

<script type="text/javascript">
(function($){$.fn.chained=function(parent_selector,options){return this.each(function(){var self=this;var backup=$(self).clone();$(parent_selector).each(function(){$(this).bind("change",function(){$(self).html(backup.html());var selected="";$(parent_selector).each(function(){selected+="\\"+$(":selected",this).val();});selected=selected.substr(1);var first=$(parent_selector).first();var selected_first=$(":selected",first).val();$("option",self).each(function(){if(!$(this).hasClass(selected)&&!$(this).hasClass(selected_first)&&$(this).val()!==""){$(this).remove();}});if(1==$("option",self).size()&&$(self).val()===""){$(self).attr("disabled","disabled");}else{$(self).removeAttr("disabled");}
$(self).trigger("change");});if(!$("option:selected",this).length){$("option",this).first().attr("selected","selected");}
$(this).trigger("change");});});};$.fn.chainedTo=$.fn.chained;})(jQuery);
 </script>
<script type="text/javascript">
 $("#altbasvuru").chained("#basvuru");
</script>