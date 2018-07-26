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
           $sql = "SELECT * FROM vwdanisan where danisanID=".$danisan_id;
           $results = $this->db->query($sql)->result();
     foreach ($results as $result) {
       $ad=$result->danisanAd;
       $soyad=$result->danisanSoyad;
       $eposta=$result->danisanEposta;
       $tel=$result->danisanTel;
       $testmizac=$result->danisanTestMizacTipID;
       $testmizacadi=$result->danisanTestMizacTipAdi;
       $uzmanmizac=$result->danisanUzmanMizacTipID;
       $uzmanmizacadi=$result->danisanUzmanMizacTipAdi;
     
     }

          ?>

          <td><?php echo $ad; ?></td>
          <td><?php echo $soyad; ?></td>
          <td><?php echo $eposta; ?></td>
          <td><?php echo $tel; ?></td>
          <td><?php echo $testmizacadi; ?>
          </td>
          <td><?php echo $uzmanmizacadi; ?>
                    <?php  echo '<a href="'.site_url('admin/terapi/danisan/mizacgir/').$danisan_id;echo '" class="btn btn-primary">Mizaç Gir</a>'; ?>
          </td>
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
  
  <p>
     <?php  

    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>Form Türü</th><th>Tarih</th><th>İşlemler</th>';
   $sql="SELECT * FROM tblbasvuruatama where basvuruDurum=3 and danisanID=".$danisan_id;
   $results = $this->db->query($sql)->result();
   foreach ($results as $result) {
    $basvuruAtamaID=$result->basvuruAtamaID;
    $basvuruFormID=$result->basvuruFormID;

    if ($basvuruFormID==1) {     $sqlform="SELECT * FROM tblbasvuruyetiskin where basvuruAtamaID=".$basvuruAtamaID; $formadi='Yetişkin Formu';  }
    else if ($basvuruFormID==2) {    $sqlform="SELECT * FROM tblbasvurucocuk where basvuruAtamaID=".$basvuruAtamaID; $formadi='Çocuk Formu'; }
    else  if ($basvuruFormID==3) {   $sqlform="SELECT * FROM tblbasvuruergen where basvuruAtamaID=".$basvuruAtamaID; $formadi='Ergen Formu'; } else { }


    $results = $this->db->query($sqlform)->result();
     foreach ($results as $result) {
      $basvuruYetiskinID=$result->basvuruYetiskinID;
      $tarih=$result->dateCreated;
    
      echo '<tr>';
      echo '<td>'.$formadi.'</td>';
      echo '<td>'.$tarih.'</td>';
      echo '<td>';
      echo'<a href="'.site_url('admin/terapi/danisan/danisanformuduzenle/').$danisan_id.'/'.$basvuruYetiskinID.'">';echo '<span style="align:right" title="Formu Düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a> ';  
            echo'<a href="'.site_url('admin/terapi/danisan/form_goruntule/').$danisan_id.'/'.$basvuruYetiskinID.'">';echo '<span style="align:right" title="Formu Görüntüle" class="glyphicon glyphicon-eye-open"></span>';echo '</a>';  
      echo '</td>';
      echo '</tr>';  
     }//foreach sonu
   }
     echo '</table>';
  ?> 
  </p>
</div>

<div id="seansnot" class="tabcontent">
  <?php  echo '<a href="'.site_url('admin/terapi/danisan/notekle/').$danisan_id;echo '" class="btn btn-primary">Not Ekle</a>'; ?>
  <h3>Seans Notları</h3>
  <?php  
    $sql="SELECT * FROM vwdanismanseansnot where danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>Seans Notları</th><th>Gelecek Seans Notları</th><th>İlgili Danışman</th><th>Tarih</th><th>İşlemler</th>';
     foreach ($results as $result) {
      $not=$result->seansNot;
      $not_id=$result->danisanSeansNotID;
      $geleceknot=$result->sonrakiSeansNot;
      $islemKullaniciID=$result->islemKullaniciID;
      $tarih=$result->notunGirilmeTarihi;
      $danisman=$result->notuGirenDanisman;
      if ($user_id==$islemKullaniciID) {   echo '<tr>';
      echo '<td>'.$not.'</td>';
      echo '<td>'.$geleceknot.'</td>';
      echo '<td>'.$danisman.'</td>';
      echo '<td>'.$tarih.'</td>';
      echo '<td>';
      echo'<a href="'.site_url('admin/terapi/danisan/seansnotuduzenle/').$danisan_id.'/'.$not_id.'">';echo '<span style="align:right" title="düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a>';  
      echo '</td>';
      echo '</tr>';  } else { 
      echo '<tr>';
      echo '<td> ... </td>';
      echo '<td> ... </td>';
      echo '<td>'.$danisman.'</td>';
      echo '<td>'.$tarih.'</td>';
      echo '<td>';
      echo '</td>';
      echo '</tr>';
      }   
     }//foreach sonu
     echo '</table>';

  ?>
  
</div>

<div id="ilkgorusme" class="tabcontent">

  <?php

  $sqlilkgorusme="Select * From tbldanisanilkgorusme where danismanUserID=".$user_id;
  $sayi= $this->db->query($sqlilkgorusme)->num_rows();
  if($sayi>0) { } else {
   echo '<a href="'.site_url('admin/terapi/danisan/ilkgorusmenotuekle/').$danisan_id;echo '" class="btn btn-primary">İlk Görüşme Notu Ekle</a>';
  }
   echo '<h3>İlk Görüşme</h3>';  
       $sql="SELECT * FROM vwdanisanilkgorusme where danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>Kişilik Örüntüsü</th><th>Konu Başlıkları</th><th>Anne Mizaç</th><th>Baba Mizaç</th><th>İlgili Danışman</th><th>Tarih</th><th>İşlemler</th>';
     foreach ($results as $result) {
      $gorusmeID=$result->danisanilkGorusmeID;
      $kisilik=$result->gozeCarpanKisilikOruntusu;
      $konu=$result->konuBasliklari;
      $annemizac=$result->anneMizacID;
      $annemizacadi=$result->anneMizacTipAdi;
      $babamizac=$result->babaMizacID;
      $babamizacadi=$result->babaMizacTipAdi;
      $danismanAd=$result->danismanAd;
      $danismanSoyad=$result->danismanSoyad;
      $tarih=$result->dateCreated;
      $danisman=$result->danismanUserID;
      $danismanUserID=$result->danismanUserID;
      echo '<tr>';
      echo '<td>'.$kisilik.'</td>';
      echo '<td>'.$konu.'</td>';
      echo '<td>'.$annemizacadi.'</td>';
      echo '<td>'.$babamizacadi.'</td>';
      echo '<td>'.$danismanAd.' '.$danismanSoyad.'</td>';
      echo '<td>'.$tarih.'</td>';
      echo '<td>';
      if($user_id==$danismanUserID) {       echo'<a href="'.site_url('admin/terapi/danisan/ilkgorusmeduzenle/').$danisan_id.'/'.$gorusmeID.'">';echo '<span style="align:right" title="düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a>';  } else  { }
 
      echo '</td>';
      echo '</tr>';  
     }//foreach sonu
     echo '</table>';


   ?>



</div>

<div id="psikiyatrikilaclar" class="tabcontent">
    <?php  echo '<a href="'.site_url('admin/terapi/danisan/psikiyatrikilacekle/').$danisan_id;echo '" class="btn btn-primary">İlaç Ata</a>'; ?>
    <h3>Psikiyatrik İlaçlar</h3>
    <?php  
    $sql="SELECT * FROM vwdanisanilac where ilacTipID=1 and danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>İlaç</th><th>Doz</th><th>İlaç Açıklama</th><th>İlgili Kişi</th><th>İşlemler</th>';
     foreach ($results as $result) {
      $danisanilacID=$result->danisanilacID;
      $ilacAdi=$result->psikiyatriilacAdi;
      $doz=$result->ilacDozAdi;
      $aciklama=$result->ilacAciklama;
      $islemKullaniciID=$result->islemKullaniciID;
      $danisman=$result->ilaciTanimlayanDanisman;
      echo '<tr>';
      echo '<td>'.$ilacAdi.'</td>';
      echo '<td>'.$doz.'</td>';
      echo '<td>'.$aciklama.'</td>';
      echo '<td>'.$danisman.'</td>';
      echo '<td>';
      echo'<a href="'.site_url('admin/terapi/danisan/psikiyatrikilacduzenle/').$danisan_id.'/'.$danisanilacID.'">';echo '<span style="align:right" title="düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a>';  
      echo '</td>';
      echo '</tr>';
     }
     echo '</table>';

  ?>

</div>

<div id="digerilaclar" class="tabcontent">
    <?php  echo '<a href="'.site_url('admin/terapi/danisan/ilacekle/').$danisan_id;echo '" class="btn btn-primary">İlaç Ata</a>'; ?>
  <h3>Diğer İlaçlar</h3>
    <?php  
    $sql="SELECT * FROM vwdanisanilac where ilacTipID=2 and danisanID=".$danisan_id;
    $results = $this->db->query($sql)->result();
    echo '<table class="table table-hover table-bordered table-condensed">';
    echo '<th>İlaç Açıklama</th><th>İşlemler</th>';
     foreach ($results as $result) {
      //$not=$result->seansNot;
      $danisanilacID=$result->danisanilacID;
      $aciklama=$result->ilacAciklama;
      $islemKullaniciID=$result->islemKullaniciID;
      echo '<tr>';
      echo '<td>'.$aciklama.'</td>';
      echo '<td>';
      echo'<a href="'.site_url('admin/terapi/danisan/digerilacduzenle/').$danisan_id.'/'.$danisanilacID.'">';echo '<span style="align:right" title="düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a>';  
      echo '</td>';
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
    echo '<th>Tanı Türü</th><th>Tanı Tipi</th><th>Tanı Açıklama</th><th>Tanıyı Koyan</th><th>İşlemler</th>';
     foreach ($results as $result) {
      //$not=$result->seansNot;
      $tani=$result->taniAdi;
      $taniID=$result->danisantaniID;
      $tanitipi=$result->taniTipi;
      $aciklama=$result->taniAciklama;
      $koyan=$result->taniyiKoyanDanisman;
      $islemKullaniciID=$result->islemKullaniciID;
      
      echo '<tr>';
      echo '<td>'.$tanitipi.'</td>';
      echo '<td>'.$tani.'</td>';
      echo '<td>'.$aciklama.'</td>';
      echo '<td>'.$koyan.'</td>';
      echo '<td>';
      echo'<a href="'.site_url('admin/terapi/danisan/danisantaniduzenle/').$danisan_id.'/'.$taniID.'">';echo '<span style="align:right" title="düzenle" class="glyphicon glyphicon-pencil"></span>';echo '</a>';  
      echo '</td>';
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