<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:10px;">



    <div class="row">
         

        <div class="col-lg-4 col-lg-offset-4">
            <h2>Randevu Ekle</h2>
 <?php 
$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7);  


            echo '<br>';

           // $this->db->insert("tbldanisan",$data);   

            echo "Tarih:".$date.'<br>';
            echo "DanışmanID:".$danisman_id.'<br>';
            echo "Zaman:".$time.'<br>';


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

           
$ofisID=$this->ion_auth->user()->row()->company;
echo 'Ofis:'.$ofisID;
                
  ?>


<?php /*echo '<form id="form1" method="post" action="../../../randevuekle_step1/'.$date.'/'.$danisman_id.'/'.$time.'">';
echo ''; */
?>
          <?php echo form_open();?>

          <?php   
//print_r($data);
          ?>
            <div class="form-group">
                <?php
                echo form_label('Danışan Ad','first_name');
                echo form_error('first_name');
                echo form_input('first_name',set_value('first_name',$danisanad),'class="form-control"  readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışan Soyad','last_name');
                echo form_error('last_name');
                echo form_input('last_name',set_value('last_name',$danisansoyad),'class="form-control"  readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Danışman','first_name');
                echo form_error('first_name');
                echo form_input('first_name',set_value('first_name',$danisman),'class="form-control" readonly');
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
                echo form_label('Ofis','company');
                echo form_error('company');
                echo form_dropdown('company',$ofisler,$ofisID,'class="form-control"');
                ?>
            </div>





            <div class="form-group">
                <?php
                echo form_label('Randevu Başlangıç Saat','saat1');
                echo form_error('saat1');

                echo form_input('first_name',set_value('first_name',$date),' readonly');
               
                echo '<SELECT name="dakika">
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
            <?php //echo form_hidden('user_id',$user->id);?>
            <?php echo form_submit('submit', 'Güncelle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/users', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
<!--<input type="submit" class="btn btn-primary" value="Danışan Ekle">-->
 <!-- <button type="button" class="btn btn-primary" >Danışan Ekle</button> -->
  <!--</form>-->







    </div>
</div>