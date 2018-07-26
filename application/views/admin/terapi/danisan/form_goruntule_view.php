<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Title</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script>
          $(function() {
            $('#profile-image1').on('click', function() {
                $('#profile-image-upload').click();
            });
        });       
    </script> 

    <style type="text/css">
    
    input.hidden {
    position: relative;
    left: -9999px;
    .panel panel-default
                       }

    #profile-image1 {
    cursor: pointer;
  
    width: 100px;
    height: 100px;
    border:2px solid #03b1ce ;}
    .tital{ font-size:16px; font-weight:500;}
     .bot-border{ border-bottom:1px #ea5403 solid;  margin:5px 0  5px 0}

  
    @media only screend and  (max-width: 768px) {
     .row,.div {  background-color: pink; 
        width: 100%;
        height: 100%
        margin-top: 0;
        -moz-transform: scale(0.8, 0.8); /* Moz-browsers */
        zoom: 0.8; /* Other non-webkit browsers */
        zoom: 80%; /* Webkit browsers */
    }


    
  
    }
  

  
    }
}
    
        
    </style>
</head>
<body>

<div class="container">
    <div class="row" >
 
 <?php

$danisan_id=$this->uri->segment(5);
$form_id=$this->uri->segment(6);
//echo $danisan_id;
echo '<br>';
//echo $form_id;


 $sql="SELECT * FROM vwbasvuruyetiskin where danisanID=".$danisan_id;
$results = $this->db->query($sql)->result();
foreach ($results as $result) {
  $danisanAd=$result->danisanAd;
  $danisanSoyad=$result->danisanSoyad;
  $cinsiyeti=$result->cinsiyetAdi;
  $yas=$result->yas;
  $egitimDurumAdi=$result->egitimDurumAdi;
  $medeniDurumAdi=$result->medeniDurumAdi;
  $basvuruNedeniAdi=$result->basvuruNedeniAdi;
  $altBasvuruNedeniAdi=$result->altBasvuruNedeniAdi;
  $tibbiSorunVarMiAdi=$result->tibbiSorunVarMiAdi;
  $tibbiSorunAciklama=$result->tibbiSorunAciklama;
  $ilacKullaniyorMuAdi=$result->ilacKullaniyorMuAdi;
  $fizikiMuayeneAdi=$result->fizikiMuayeneAdi;
  $onemliHastalikGecirdiMiAdi=$result->onemliHastalikGecirdiMiAdi;
  $onemliKazaGecirdiMiAdi=$result->onemliKazaGecirdiMiAdi;
  $kanGrubuAdi=$result->kanGrubuAdi;
  $psikolojikYardimAldiMiAdi=$result->psikolojikYardimAldiMiAdi;
  $psikiyatrikilacKullandiMiAdi=$result->psikiyatrikilacKullandiMiAdi;
  $anneHayattaMiAdi=$result->anneHayattaMiAdi;
  $babaHayattaMiAdi=$result->babaHayattaMiAdi;
  $kardesSayisi=$result->kardesSayisi;
  $cocukSayisi=$result->cocukSayisi;
  $alkolKullaniyorMuAdi=$result->alkolKullaniyorMuAdi;
  $alkolDurumAdi=$result->alkolDurumAdi;
  $sigaraKullaniyorMuAdi=$result->sigaraKullaniyorMuAdi;
  $uyusturucuKullaniyorMuAdi=$result->uyusturucuKullaniyorMuAdi;
  $uyusturucuDurumAdi=$result->uyusturucuDurumAdi;

}

 ?>       
        
       

<div class="panel panel-default">
  <div class="panel-heading">  <h4 >Danışan Profili</h4></div>
   <div class="panel-body">
       
    <div class="box box-info">
        
            <div class="box-body">
                     <div class="col-sm-6">
                     <div  align="center"> <img alt="User Pic" src="<?php echo site_url('assets/admin/images/icon.png'); ?>" id="profile-image1" class="img-circle img-responsive"> 
            
                     </div>
              
              <br>
    
              <!-- /input-group -->
            </div>
            <div class="col-sm-6">
            <h4 style="color:#ea5403;">Mizmer Psikolojik Danışmanlık Merkezi </h4></span>
              <span><p>Danışan</p></span>            
            </div>
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
    
              
<div class="col-sm-5 col-xs-6 tital " >Adı-Soyadı:</div><div class="col-sm-7"><?php echo $danisanAd; echo ' '; echo $danisanSoyad;  ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Cinsiyet</div><div class="col-sm-7"> <?php echo $cinsiyeti; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Yaş:</div><div class="col-sm-7"> <?php echo $yas; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Eğitim Durumu:</div><div class="col-sm-7"><?php echo $egitimDurumAdi; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Medeni Durumu:</div><div class="col-sm-7"><?php echo $medeniDurumAdi; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Başvuru Nedeni:</div><div class="col-sm-7"><?php echo $basvuruNedeniAdi; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Alt Başvuru Nedeni:</div><div class="col-sm-7"><?php echo $altBasvuruNedeniAdi; ?></div>
   <div class="clearfix"></div>
<div class="bot-border"></div>
<div class="col-sm-5 col-xs-6 tital " >Danışmanlık Alma Nedenini:</div><div class="col-sm-7">basvuru_aciklama</div>
   <div class="clearfix"></div>
<div class="bot-border"></div>

<br>
<h5 style="color:orangered"> Sağlık Bilgileri    </h5>
<br>

<div class="col-sm-5 col-xs-6 tital " >Mevcut Tıbbi Sorunu:</div><div class="col-sm-7"><?php echo $tibbiSorunVarMiAdi; ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Mevcut Tıbbi Sorunu: </div><div class="col-sm-7"><?php echo $tibbiSorunVarMiAdi; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Kullanılan İlaç Durumu :</div><div class="col-sm-7"> <?php echo $ilacKullaniyorMuAdi; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Son Fiziki Muayene Zamanı :</div><div class="col-sm-7"><?php echo $fizikiMuayeneAdi; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Önemli Bir Hastalık Geçmişi :</div><div class="col-sm-7"><?php echo $onemliHastalikGecirdiMiAdi; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Önemli Bir Kaza Geçmişi : </div><div class="col-sm-7"><?php echo $onemliKazaGecirdiMiAdi; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Kan Grubu: </div><div class="col-sm-7"><?php echo $kanGrubuAdi; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Daha Önce Psikolojik/Psikiyatrik Bir Yardım Aldımı: </div><div class="col-sm-7"><?php echo $psikolojikYardimAldiMiAdi; ?></div>
<div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Psikiyatrik İlaç Kullanımı  :</div><div class="col-sm-7"><?php echo $psikiyatrikilacKullandiMiAdi; ?></div>
<div class="clearfix"></div>
<div class="bot-border"></div>
<br>
<h5 style="color:orangered"> Aile Bilgileri    </h5>
<br>

<div class="col-sm-5 col-xs-6 tital " >Anne Yaşıyor :</div><div class="col-sm-7"><?php echo $anneHayattaMiAdi; ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Baba Yaşıyor: </div><div class="col-sm-7"><?php echo $babaHayattaMiAdi; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Kardeş Sayısı :</div><div class="col-sm-7"> <?php echo $kardesSayisi; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Çocuk Sayısı :</div><div class="col-sm-7"><?php echo $cocukSayisi; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<br>
<h5 style="color:orangered"> Bağımlılık Bilgileri    </h5>
<br>

<div class="col-sm-5 col-xs-6 tital " >Alkol Kullanım Durumu :</div><div class="col-sm-7"><?php echo $alkolKullaniyorMuAdi; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Alkol Kullanıyorsanız Ne Sıklığı  : </div><div class="col-sm-7"><?php echo $alkolDurumAdi; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Sigara Kullanımı : </div><div class="col-sm-7"><?php echo $sigaraKullaniyorMuAdi; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Uyuşturucu Kullanım Durumu: </div><div class="col-sm-7"><?php echo $uyusturucuKullaniyorMuAdi; ?></div>
<div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Uyuşturucu Kullanım Sıklığı  :</div><div class="col-sm-7"><?php echo $uyusturucuDurumAdi; ?></div>





            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
       
            
    </div> 
    </div>
</div>  
 
       
       
       
       
       
       
       
       
       
   </div>
</div>

</body>


</html>