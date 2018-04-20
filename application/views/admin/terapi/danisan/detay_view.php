<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
             
              <a href="<?php echo site_url('admin/terapi/danisan/');?>" class="btn btn-primary">Tüm Danışanlar</a>
   <br>
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
 <?php $danisan_id= $this->uri->segment(5); ?>     
         <table class="table table-hover table-bordered table-condensed">
      <thead>
        <tr>
          <th>Danışan Ad</th>
          <th>Danışan Soyad</th>
          <th>Danışan E-Posta</th>
          <th>Danışan Tel</th>
          <th>Test Mizaç</th>
          <th>Uzman Mizaç</th>

        </tr>
      </thead>
      <tbody>
        <tr>
        <?php  
           $sql = "SELECT * FROM tbldanisan where danisanID=".$danisan_id;
           $results = $this->db->query($sql)->result();
     foreach ($results as $result) {
       $ad=$result->danisanAd;
       $soyad=$result->danisanSoyad;
       $eposta=$result->danisanEposta;
       $tel=$result->danisanTel;
       $testmizac=$result->danisanTestMizacTipID;
       $uzmanmizac=$result->danisanUzmanMizacTipID;
     }

          ?>

          <td><?php echo $ad; ?></td>
          <td><?php echo $soyad; ?></td>
          <td><?php echo $eposta; ?></td>
          <td><?php echo $tel; ?></td>
          <td><?php echo $testmizac; ?></td>
          <td><?php echo $uzmanmizac; ?></td>
        </tr>
      </tbody>
    </table>



        <div class="col-lg-12" style="margin-top: -20px;">

      

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'basvuruform')">Başvuru Formları</button>
  <button class="tablinks" onclick="openCity(event, 'danismannot')">Danışman Notları</button>
  <button class="tablinks" onclick="openCity(event, 'ilaclar')">İlaçlar</button>
  <button class="tablinks" onclick="openCity(event, 'tanilar')">Tanılar</button>
  <button class="tablinks" onclick="openCity(event, 'testler')">Testler</button>
</div>

<div id="basvuruform" class="tabcontent">
  <h3>Başvuru Formları</h3>
  <p>Başvuru Formları buraya gelecek...</p>
</div>

<div id="danismannot" class="tabcontent">
  <h3>Danışman Notları</h3>
  <p>Danışman Notları buraya gelecek...</p>
</div>

<div id="ilaclar" class="tabcontent">
  <h3>İlaçlar</h3>
  <p>İlaç içeriği buraya gelecek...</p>
</div>

<div id="tanilar" class="tabcontent">
  <h3>Tanılar</h3>
  <p>Tanı içeriği buraya gelecek...</p>
</div>

<div id="testler" class="tabcontent">
  <h3>Testler</h3>
  <p>Test içeriği buraya gelecek...</p>
</div>
           

        </div>
    </div>
</div>