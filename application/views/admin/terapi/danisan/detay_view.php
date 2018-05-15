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
 <?php  $user_id=$this->ion_auth->user()->row()->id;   ?>  
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
  <button class="tablinks" onclick="openCity(event, 'ilkgorusme')">İlk Görüşme</button>
  <button class="tablinks" onclick="openCity(event, 'seansnot')">Seans Notları</button>
  <button class="tablinks" onclick="openCity(event, 'psikiyatrikilaclar')">Psikiyatrik İlaçlar</button>
  <button class="tablinks" onclick="openCity(event, 'digerilaclar')">Diğer İlaçlar</button>
  <button class="tablinks" onclick="openCity(event, 'tanilar')">Tanılar</button>
  <button class="tablinks" onclick="openCity(event, 'testler')">Testler</button>
</div>

<div id="basvuruform" class="tabcontent">
  <h3>Başvuru Formları</h3>
  <p>Yapım Aşamasında..</p>
</div>

<div id="seansnot" class="tabcontent">
  <?php  echo '<a href="'.site_url('admin/terapi/danisan/notekle/').$danisan_id;echo '" class="btn btn-primary">Not Ekle</a>'; ?>
  <h3>Seans Notları</h3>
  <?php  
    $sql="SELECT * FROM ilsdanisanseansnot where danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>Seans Notları</th><th>Gelecek Seans Notları</th><th>İşlemler</th>';
     foreach ($results as $result) {
      $not=$result->seansNot;
      $not_id=$result->danisanSeansNotID;
      $geleceknot=$result->sonrakiSeansNot;
      $islemKullaniciID=$result->islemKullaniciID;
      echo '<tr>';
      echo '<td>'.$not.'</td>';
      echo '<td>'.$geleceknot.'</td>';
      echo '<td>';
      if ($user_id=$islemKullaniciID) {    echo'<a href="'.site_url('admin/terapi/danisan/seansnotuduzenle/').$danisan_id.'/'.$not_id.'">';echo '<span style="align:right" title="düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a>';  } else { }    
      echo '</td>';
      echo '</tr>';
     }
     echo '</table>';

  ?>
  
</div>

<div id="ilkgorusme" class="tabcontent">
<h3>İlk Görüşme</h3>
<p>Yapım Aşamasında..</p>
</div>

<div id="psikiyatrikilaclar" class="tabcontent">
    <?php  echo '<a href="'.site_url('admin/terapi/danisan/psikiyatrikilacekle/').$danisan_id;echo '" class="btn btn-primary">İlaç Ata</a>'; ?>
  <h3>Psikiyatrik İlaçlar</h3>
    <?php  
    $sql="SELECT * FROM vwdanisanilac where ilacTipID=1 and danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>İlaç</th><th>Doz</th><th>İlaç Açıklama</th>';
     foreach ($results as $result) {
      $ilacAdi=$result->psikiyatriilacAdi;
      $doz=$result->ilacDozAdi;
      $aciklama=$result->ilacAciklama;
      $islemKullaniciID=$result->islemKullaniciID;
      echo '<tr>';
      echo '<td>'.$ilacAdi.'</td>';
      echo '<td>'.$doz.'</td>';
      echo '<td>'.$aciklama.'</td>';
      echo '</tr>';
     }
     echo '</table>';

  ?>

</div>

<div id="digerilaclar" class="tabcontent">
    <?php  echo '<a href="'.site_url('admin/terapi/danisan/ilacekle/').$danisan_id;echo '" class="btn btn-primary">İlaç Ata</a>'; ?>
  <h3>Diğer İlaçlar</h3>

    <?php  
    $sql="SELECT * FROM ilsdanisanilac where ilacTip=2 and danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>İlaç Açıklama</th>';
     foreach ($results as $result) {
      //$not=$result->seansNot;
     // $not_id=$result->danisanSeansNotID;
      $aciklama=$result->ilacAciklama;
      $islemKullaniciID=$result->islemKullaniciID;
      echo '<tr>';
      echo '<td>'.$aciklama.'</td>';
      echo '</tr>';
     }
     echo '</table>';

  ?>
</div>

<div id="tanilar" class="tabcontent">
    <?php  echo '<a href="'.site_url('admin/terapi/danisan/taniekle/').$danisan_id;echo '" class="btn btn-primary">Tanı Ekle</a>'; ?>
  <h3>Tanılar</h3>
   <?php  
    $sql="SELECT * FROM vwdanisantani where danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>Tanı Tipi</th><th>Tanı Açıklama</th>';
     foreach ($results as $result) {
      //$not=$result->seansNot;
      $tani=$result->psikiyatrikTaniAdi;
      $aciklama=$result->taniAciklama;
      $islemKullaniciID=$result->islemKullaniciID;
      echo '<tr>';
      echo '<td>'.$tani.'</td>';
      echo '<td>'.$aciklama.'</td>';
      echo '</tr>';
     }
     echo '</table>';

  ?>
</div>

<div id="testler" class="tabcontent">
    <?php // echo '<a href="'.site_url('admin/terapi/danisan/testekle/').$danisan_id;echo '" class="btn btn-primary">Test Talebi</a>'; ?>
  <h3>Testler</h3>
  <p>Yapım Aşamasında..</p>
        <?php  
  /*  $sql="SELECT * FROM ilsdanisantest where danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
     foreach ($results as $result) {
      $test=$result->test;
      $sqltest="SELECT * FROM tnmterapitip where terapiTipID=".$test;
      $resultstest = $this->db->query($sqltest)->result();
      foreach ($resultstest as $resulttest) {
        $test=$resulttest->terapiAdi;
      echo '<p>'.$test.'</p><br><hr>';
       }
     }
*/
  ?>
</div>
           

        </div>
    </div>
</div>