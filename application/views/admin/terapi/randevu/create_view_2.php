<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:10px;">



    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Randevu Ekle</h2>
 <?php 
$danisman_id= $this->uri->segment(6); 

if ($danisman_id=='') { 
 // echo "<br<br><br><br>";
$danisan_id= $this->uri->segment(5); 

$danisman_id=$this->session->userdata('randevuDanismanID');
$date=$this->session->userdata('date');
$time=$this->session->userdata('time');
/*
echo $this->session->userdata('randevuDanismanID');
echo "<br>";
echo $this->session->userdata('date');
echo "<br>";
echo $this->session->userdata('time'); 
*/

         $sqldanisan = "SELECT * FROM tbldanisan where danisanID=".$danisan_id;
         $results = $this->db->query($sqldanisan)->result();
         foreach ($results as $result) {
               $danisanID=$result->danisanID;
               $danisanad=$result->danisanAd;
               $danisansoyad=$result->danisanSoyad;
              // echo "Danışan ID:".$danisanID;
                }

         $sqldanisman = "SELECT * FROM users where id=".$danisman_id;
         $results = $this->db->query($sqldanisman)->result();
         foreach ($results as $result) {
               $first=$result->first_name;
               $last=$result->last_name;
               $danisman=$first.' '.$last;
               $locationid=$result->company;
               $sqlofis = "SELECT * FROM tblofis where ofisID=".$locationid;
               $results = $this->db->query($sqlofis)->result();
               foreach ($results as $result) { 
                    $ofisAdi=$result->ofisAdi;
               }
                }   




}else { 

$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7);  

         /*   echo '<br>';
           // $this->db->insert("tbldanisan",$data);   
            echo "Tarih:".$date.'<br>';
            echo "DanışmanID:".$danisman_id.'<br>';
            echo "Zaman:".$time.'<br>';

*/


         $sqldanisan = "SELECT * FROM tbldanisan order by danisanID desc limit 0,1";
         $results = $this->db->query($sqldanisan)->result();
         foreach ($results as $result) {
               $danisanID=$result->danisanID;
               $danisanad=$result->danisanAd;
               $danisansoyad=$result->danisanSoyad;
              // echo "Danışan ID:".$danisanID;
                }

         $sqldanisman = "SELECT * FROM users where id=".$danisman_id;
         $results = $this->db->query($sqldanisman)->result();
         foreach ($results as $result) {
               $first=$result->first_name;
               $last=$result->last_name;
               $danisman=$first.' '.$last;
               $locationid=$result->company;
               $sqlofis = "SELECT * FROM tblofis where ofisID=".$locationid;
               $results = $this->db->query($sqlofis)->result();
               foreach ($results as $result) { 
                    $ofisAdi=$result->ofisAdi;
               }
                }   


}
           
//$ofisID=$this->ion_auth->user()->row()->company;
//echo 'Ofis:'.$ofisID;
                
  ?>


<?php 
$seg6= $this->uri->segment(6);
if ($seg6=='') { echo '<form  method="post" action="../randevuekle_step4/">';  }
else {echo '<form  method="post" action="../../../randevuekle_step2/">';  }

?>
          <?php //echo form_open();?>

          <?php   
//print_r($data);
          ?>
            <div class="form-group">
                <?php
                echo form_label('Danışan Ad','first_name');
                echo form_error('first_name');
                echo form_input('',set_value('',$danisanad),'class="form-control"  readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışan Soyad','last_name');
                echo form_error('last_name');
                echo form_input('',set_value('',$danisansoyad),'class="form-control"  readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışman','first_name');
                echo form_error('first_name');
                echo form_input('',set_value('',$danisman),'class="form-control" readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Terapi Tip','terapi');
                echo form_error('terapi');
                echo form_dropdown('terapi',$terapiler,'terapi','class="form-control" ');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Randevu Durumu','randevu');
                echo form_error('randevu');
                echo form_dropdown('randevu',$randevudurum,'randevu','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Odalar','oda');
                echo form_error('oda');
                echo form_dropdown('oda',$odalar,'oda','class="form-control"');
                ?>
            </div>
            <div class="form-group">

           <?php
            // echo $danisanID;
            $sqlpaket = "SELECT * FROM vwdanisanpaket where danisanID=".$danisanID." and (TamamlananSeansSayisi<paketSeansSayi)";
            $sayipaket= $this->db->query($sqlpaket)->num_rows();
           if($sayipaket>0) {  
           echo form_label('Paketler','paket');
           echo '<SELECT name="paket" class="form-control">';
           echo '<option value=""> -- </option>';            
            $results = $this->db->query($sqlpaket)->result();
            foreach ($results as $result) {
              $tamam=$result->TamamlananSeansSayisi;
              $seanssayi=$result->paketSeansSayi;
              $paket_id=$result->paketID;
              $paketAdi=$result->paketAdi;
              //echo $paket_id;
            echo '<option value="'.$paket_id.'">'.$paketAdi.'</option>';
            }
            echo '</SELECT>';
            echo form_error('paket'); } else  { }
               // echo form_dropdown('paket','','paket','class="form-control"');
            
             ?>
          </div>
              


            <div class="form-group">
                <?php
                echo form_label('Randevu Başlangıç Saat','saat1');
                echo form_error('saat1');
                echo form_input('',set_value('',$time),' size="1" readonly');
    

                echo ':<SELECT name="dakika">
                <option>00</option>
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>40</option>
                <option>50</option>
                </select>';
                ?>
            </div>

   
            <div class="form-group">
      
            </div>
            <?php echo form_hidden('date',$date);?>
            <?php echo form_hidden('danisanID',$danisanID);?>
            <?php echo form_hidden('danismanID',$danisman_id);?>
            <?php echo form_hidden('time',$time);?>
            <?php echo form_submit('submit', 'Randevu Kaydet', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/terapi/randevu', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
<!--<input type="submit" class="btn btn-primary" value="Danışan Ekle">-->
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  <!--</form>-->







    </div>
</div>