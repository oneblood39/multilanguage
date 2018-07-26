<!DOCTYPE html>
<?php
//error_reporting(0);
//echo 'testt';
//$danisanid=$_POST["danisanid"];
//echo $danisanid;

define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');
//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("UTF8");
if(!$mysqli){
 die("Connection failed: " . $mysqli->error);
} else { 
    //echo 'bağlantı tamam';
     }






    // $geri=$_GET['geri'];

  if (isset($_GET['geri'])) { 
    
    $danisanid=$_GET["danisanid"];
    $formid=$_GET["formid"];
                                     
               $result=mysqli_query($mysqli,"SELECT * FROM tblbasvuruyetiskin WHERE danisanID=".$danisanid."" );
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $gelen_tibbiSorunVarMi=$row["tibbiSorunVarMi"];
                                                 $gelen_tibbiSorunAciklama=$row["tibbiSorunAciklama"];
                                                 $gelen_ilacKullaniyorMu=$row["ilacKullaniyorMu"];
                                                 $gelen_fiziki_muayene=$row["fizikiMuayeneID"];
                                                 $gelen_onemliHastalikGecirdiMi=$row["onemliHastalikGecirdiMi"];
                                                 $gelen_onemliKazaGecirdiMi=$row["onemliKazaGecirdiMi"];
                                                 $gelenkan=$row["kanGrubuID"];
                                                 $gelen_psikolojikYardimAldiMi=$row["psikolojikYardimAldiMi"];
                                                 $gelen_psikiyatrikilacKullandiMi=$row["psikiyatrikilacKullandiMi"];


                                       }

       } else {
                                                $gelen_tibbiSorunVarMi='';
                                                $gelen_tibbiSorunAciklama='';
                                                $gelen_ilacKullaniyorMu='';
                                                $gelen_fiziki_muayene='';
                                                $gelen_onemliHastalikGecirdiMi='';
                                                $gelen_onemliKazaGecirdiMi='';
                                                $gelenkan='';
                                                $gelen_psikolojikYardimAldiMi='';
                                                $gelen_psikiyatrikilacKullandiMi='';



          
  $danisanid=$_POST["danisanid"];
  $yetiskin_ad=$_POST["yetiskin_ad"];
  $cinsiyet=$_POST["cinsiyet"];
  $yas=$_POST["yas"];
  $eposta=$_POST["eposta"];
  $egitim_durum=$_POST["egitim_durum"];
  $yetiskin_ikamet_il=$_POST["yetiskin_ikamet_il"];
  $yetiskin_ikamet_ilce=$_POST["yetiskin_ikamet_ilce"];
  $yetiskin_memleket_il=$_POST["yetiskin_memleket_il"];
  $yetiskin_memleket_ilce=$_POST["yetiskin_memleket_ilce"];
  $ulasim=$_POST["ulasim"];
  $medeni_durum=$_POST["medeni_durum"];
  $meslek=$_POST["meslek"];
  $basvuru_nedeni=$_POST["basvuru_nedeni"];
  $alt_basvuru_nedeni=$_POST["alt_basvuru_nedeni"];
  $meslek_aciklama=$_POST["meslek_aciklama"];
  $basvuru_aciklama=$_POST["basvuru_aciklama"];
  $formid=$_POST["formid"];


//echo $danisanid;


$sqlkontrol=mysqli_query($mysqli,"SELECT * FROM tblbasvuruyetiskin WHERE danisanID=".$danisanid."");
$sayi=mysqli_num_rows($sqlkontrol);
if ($sayi>0) {

     $sql = "UPDATE tblbasvuruyetiskin SET cinsiyeti='".$cinsiyet."', yas='".$yas."', egitimDurumuID='".$egitim_durum."', ikametilID='".$yetiskin_ikamet_il."', ikametilceID='".$yetiskin_ikamet_ilce."', memleketilID='".$yetiskin_memleket_il."', memleketilceID='".$yetiskin_memleket_ilce."', gelmeSekliID='".$ulasim."', medeniDurum='".$medeni_durum."', meslekID='".$meslek."', basvuruNedeniID='".$basvuru_nedeni."', altBasvuruNedeniID='".$alt_basvuru_nedeni."', meslek='".$meslek_aciklama."', danismanlikAlmaNedeni='".$basvuru_aciklama."'  WHERE danisanID=".$danisanid."";
          if(mysqli_query($mysqli, $sql)){
           // echo "Records were updated successfully.";
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
          }

    $sql2 = "UPDATE tbldanisan SET danisanEposta='".$eposta."' WHERE danisanID=".$danisanid."";
        if (mysqli_query($mysqli,$sql2)) {
            
        }
        else {
            echo "ERROR: Could not able to execute $sql2" .mysql_error($mysqli);
        }



}  else {
      $sql = "INSERT INTO tblbasvuruyetiskin (danisanID, cinsiyeti, yas, egitimDurumuID, ikametilID, ikametilceID, memleketilID, memleketilceID, gelmeSekliID, medeniDurum, meslekID, basvuruNedeniID, altBasvuruNedeniID,meslek,danismanlikAlmaNedeni,basvuruAtamaID)
  VALUES ('".$danisanid."', '".$cinsiyet."', '".$yas."', '".$egitim_durum."', '".$yetiskin_ikamet_il."', '".$yetiskin_ikamet_ilce."', '".$yetiskin_memleket_il."', '".$yetiskin_memleket_ilce."', '".$ulasim."', '".$medeni_durum."', '".$meslek."', '".$basvuru_nedeni."','".$alt_basvuru_nedeni."','".$meslek_aciklama."', '".$basvuru_aciklama."', '".$formid."')";



  if (mysqli_query($mysqli,$sql))
   echo "veriler eklendi";

//$sql2 = "UPDATE tbldanisan SET danisanEposta='".$eposta."' WHERE danisanID=".$danisanid."";
 //       if (mysql_query($mysqli,$sql2)) {
            
 //       }
   //     else {
     //       echo "ERROR: Could not able to execute $sql2" .mysql_error($mysqli);
       // }

}

      }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danışan Formu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <script src="https://static.jsbin.com/js/prod/runner-4.1.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script type="text/javascript">
        "use strict";
            function scroll_to_class(element_class, removed_height) {
                var scroll_to = $(element_class).offset().top - removed_height;
                if($(window).scrollTop() != scroll_to) {
                    $('.form-wizard').stop().animate({scrollTop: scroll_to}, 0);
                }
            }

            
            jQuery(document).ready(function() {
                
                /*
                    Form
                */
                $('.form-wizard fieldset:first').fadeIn('slow');
                
                $('.form-wizard .required').on('focus', function() {
                    $(this).removeClass('input-error');
                });
                
                
                
                // previous step
                $('.form-wizard .btn-previous').on('click', function() {
                    // navigation steps / progress steps
                    var current_active_step = $(this).parents('.form-wizard').find('.form-wizard-step.active');
                    var progress_line = $(this).parents('.form-wizard').find('.form-wizard-progress-line');
                    
                    $(this).parents('fieldset').fadeOut(400, function() {
                        // change icons
                        current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'left');
                        // show previous step
                        $(this).prev().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class( $('.form-wizard'), 20 );
                    });
                });
                
                // submit
                $('.form-wizard').on('submit', function(e) {
                    
                    // fields validation
                    $(this).find('.required').each(function() {
                        if( $(this).val() == "" ) {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        }
                        else {
                            $(this).removeClass('input-error');
                        }
                    });
                    // fields validation
                    
                });
                
                
            });

            // image uploader scripts<
        </script>
    <style type="text/css">
        .form-box {
            padding-top: 5%;
            padding-bottom: 15%;
            background: rgb(234,88,4); /* Old browsers */
            background: -moz-linear-gradient(top,  rgba(234,88,4,1) 0%, rgba(234,40,3,1) 51%, rgba(234,88,4,1) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  rgba(234,88,4,1) 0%,rgba(234,40,3,1) 51%,rgba(234,88,4,1) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  rgba(234,88,4,1) 0%,rgba(234,40,3,1) 51%,rgba(234,88,4,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ea5804', endColorstr='#ea5804',GradientType=0 ); /* IE6-9 */
        }

        .form-wizard {
            padding: 25px;
            background: #fff;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 4px;
            box-shadow: 0px 0px 4px 3px #777;
            font-family: 'Roboto', sans-serif;
            font-size: 18px;
            font-weight: 300;
            color: #888;
            line-height: 30px;
            text-align: center;
            

        }
    
        .form-wizard strong { font-weight: 500; }

        .form-wizard a, .form-wizard a:hover, .form-wizard a:focus, a:-webkit-any-link {
            color: white;
            text-decoration: none;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }

        .form-wizard h1, .form-wizard h2 {
            margin-top: 10px;
            font-size: 40px;
            font-weight: 100;
            color: #555;
            line-height: 50px;
        }

        .form-wizard h3 {
            font-size: 28px;
            font-weight: 300;
            color: #f2682b;
            line-height: 30px;
            margin-top: 0;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .form-wizard h4 {
            float:left;
            font-size: 24px;
            font-weight: 300;
            color: #f2682b;
            line-height: 26px;
            width:100%;
        }
        .form-wizard h4  span{
            float:right;
            font-size: 22px;
            font-weight: 300;
            color: #555;
            line-height: 26px;
        }

        .form-wizard table tr th{font-weight:normal;}

    

        .form-wizard ::-moz-selection { background: #ea5403; color: #fff; text-shadow: none; }
        .form-wizard ::selection { background: #ea5403; color: #fff; text-shadow: none; }


        .form-control {
            height: 44px;
            width:100%;
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
            background: #fff;
            border: 1px solid #ddd;
            font-family: 'Roboto', sans-serif;
            font-size: 18px;
            font-weight: 300;
            line-height: 44px;
            color: #888;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
            -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }
        .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] {
            position: absolute;
            margin-top: 9px;
            margin-left: -20px;
        }

        .form-control option:hover, .form-control option:checked  {
            box-shadow: 0 0 10px 100px #ea2803 inset;
        }

        .form-control:focus {
            outline: 0;
            background: #fff;
            border: 1px solid #ccc;
            -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
        }

        .form-control:-moz-placeholder { color: #888; }
        .form-control:-ms-input-placeholder { color: #888; }
        .form-control::-webkit-input-placeholder { color: #888; }

        .form-wizard label { font-weight: 300; }
        .form-wizard label span { color:#ea2803; }

        .form-wizard .success h3{
            color: #4F8A10;
            text-align: center;
            margin: 20px auto !important;
        }
        .form-wizard .success .success-icon {
            color: #4F8A10;
            font-size: 100px;
            border: 5px solid #4F8A10;
            border-radius: 100px;
            text-align: center !important;
            width: 110px;
            margin: 25px auto;
        }
        .form-wizard .progress-bar {
            background-color: #ea2803;
        }

        .form-wizard-steps{
            margin:auto;
            position: relative;
            margin-top: 20px;
            margin-left: 10%;

        }
        .form-wizard-step{
            padding-top:10px !important;
            
            background:#ccc;
            -ms-transform: skewX(-30deg); /* IE 9 */
            -webkit-transform: skewX(-30deg); /* Safari */
            transform: skewX(-30deg); /* Standard syntax */
        }
        .form-wizard-step.active{
            background:#0098ce;
        }
        .form-wizard-step.activated{
            background:#0098ce;
        }
        .form-wizard-progress {
            position: absolute;
            top: 36px;
            left: 0;
            width: 100%;
            height: 0px;
            background: #ea2803;
        }
        .form-wizard-progress-line {
            position: absolute;
            top: 0;
            left: 0;
            height: 0px;
            background: #ea2803;
        }

        .form-wizard-tolal-steps-3 .form-wizard-step { 
            position: relative;
            float: left; 
            width: 29%; 
            padding: 0 5px; 
            padding-left: 5px;
        }
        .form-wizard-tolal-steps-4 .form-wizard-step {
            position: relative;
            float: left;
            width: 22%;
            padding: 0 5px;
        }
        .form-wizard-tolal-steps-5 .form-wizard-step {
            position: relative;
            float: left;
            width: 20%;
            padding: 0 5px;
        }

      

        .form-wizard-step p {
            color: #fff;
            -ms-transform: skewX(30deg); /* IE 9 */
            -webkit-transform: skewX(30deg); /* Safari */
            transform: skewX(30deg); /* Standard syntax */
            margin-right: 2%;
        }
        .form-wizard-step.activated p { color: #fff; }
        .form-wizard-step.active p { color: #fff; }

        .form-wizard fieldset {
            width: 100%;
            text-align:left;
            border:0px !important
        }

        .form-wizard-buttons { text-align: right; }

        .form-wizard .input-error { border-color: #ea2803;}

        /** image uploader **/
        .image-upload a[data-action] {
            cursor: pointer;
            color: #555;
            font-size: 18px;
            line-height: 24px;
            transition: color 0.2s;
        }
        .image-upload a[data-action] i {
            width: 1.25em;
            text-align: center;
        }
        .image-upload a[data-action]:hover {
            color: #ea2803;
        }
        .image-upload a[data-action].disabled {
            opacity: 0.35;
            cursor: default;
        }
        .image-upload a[data-action].disabled:hover {
            color: #555;
        }
        .settings_wrap{
            margin-top:20px;
        }
        .image_picker .settings_wrap {
            overflow: hidden;
            position: relative;
        }
        .image_picker .settings_wrap .drop_target,
        .image_picker .settings_wrap .settings_actions {
            float: left;
        }
        .image_picker .settings_wrap .drop_target {
            margin-right: 18px;
        }
        .image_picker .settings_wrap .settings_actions {
            float: left;
            margin-top: 100px;
            margin-left: 20px;
        }
        .settings_actions.vertical a {
            display: block;
        }
        .drop_target {
            position: relative;
            cursor: pointer;
            transition: all 0.2s;
            width: 250px;
            height: 250px;
            background: #f2f2f2;
            border-radius: 100%;
            margin: 0 auto 25px auto;
            overflow: hidden;
            border: 8px solid #E0E0E0;
        }
        .drop_target input[type="file"] {
            visibility: hidden;
        }
        .drop_target::before {
            content: 'Drop Hear';
            font-family: FontAwesome;
            position: absolute;
            display: block;
            width: 100%;
            line-height: 220px;
            text-align: center;
            font-size: 40px;
            color: rgba(0, 0, 0, 0.3);
            transition: color 0.2s;
        }
        .drop_target:hover,
        .drop_target.dropping {
            background: #f80;
            border-top-color: #cc6d00;
        }
        .drop_target:hover:before,
        .drop_target.dropping:before {
            color: rgba(0, 0, 0, 0.6);
        }
        .drop_target .image_preview {
            width: 100%;
            height: 100%;
            background: no-repeat center;
            background-size: contain;
            position: relative;
            z-index: 2;
    
        }
    </style>
</head>
<body>
</body>
<section class="form-box" >
    <div class="container">

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3  form-wizard">
               
                <!-- Form Wizard -->
                <form role="form" action="yetiskinform3.php" method="post">


                    <header class="container">
                    <img class="logo" src="assets/admin/images/logo.png" title="logo" alt="logo" text="Danışan Formu">
                    <h3>Danışan Formu</h3>
                    <p>Sizi Daha Yakından Tanımamız İçin;</p>  
                
                    </header>  
                

                    <!-- Form progress -->
                    <div class="form-wizard-steps form-wizard-tolal-steps-3">
                          
                    
                        <!-- Step 1 -->
                        <div class="form-wizard-step active">
                    
                            <p>Kişisel Bilgiler</p>
                        </div>
                        <!-- Step 1 -->

                        <!-- Step 2 -->
                        <div class="form-wizard-step active">
                            
                            <p>Sağlık Bilgileri</p>
                        </div>
                        <!-- Step 2 -->

                        <!-- Step 3 -->
                        <div class="form-wizard-step">
                            
                            <p>Aile Bilgileri</p>
                        </div>
                        
                    </div>
                    <!-- Form progress -->

                    <!-- Form Step 1 -->
                    <fieldset>

                        <h4>Sağlık Bilgileri <span>Adım 2 - 3</span></h4>
                        <div class="form-group">
                            <label>Mevcut Tıbbi Sorununuz Var mı? <span>*</span></label>
                            
                            &nbsp<label class="radio-inline">&nbsp &nbsp &nbsp
                                <input type="radio" name="tibbi_sorun" value="1"<?php if ($gelen_tibbiSorunVarMi=='1') {echo "checked"; } else { } ?> checked="checked"> Evet &nbsp &nbsp &nbsp
                            </label>
                            &nbsp<label class="radio-inline">
                                <input type="radio" name="tibbi_sorun" value="2" <?php if ($gelen_tibbiSorunVarMi=='2') {echo "checked"; } else { } ?> > Hayır
                            </label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Mevcut Tıbbi Sorununuz ?</label>
                            <input type="text" name="tibbi_sorun_aciklama"  value="<?php echo $gelen_tibbiSorunAciklama; ?>" placeholder="Kısaca Açıklayınız" class="form-control ">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Kullandığınız İlaç Var mı? <span>*</span></label>
                            
                            &nbsp<label class="radio-inline">&nbsp &nbsp &nbsp
                                <input type="radio" name="ilac_kullanimi" value="1" <?php if ($gelen_ilacKullaniyorMu=='1') {echo "checked"; } else { } ?>  checked="checked"> Evet &nbsp &nbsp &nbsp
                            </label>
                            &nbsp<label class="radio-inline" >
                                <input type="radio" name="ilac_kullanimi" value="2" <?php if ($gelen_ilacKullaniyorMu=='2') {echo "checked"; } else { } ?>> Hayır
                            </label>
                        </div>
                        <br>
                         <div class="form-group">
                                 <label>En Son Ne Zaman Fiziki Muayene Oldunuz? </label>
                                 <?php
                                    echo '<SELECT class="form-control" name="fiziki_muayene">';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmfizikimuayene");
                                       echo  '<option>Seçiniz </option>';
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $fizikiMuayeneID=$row["fizikiMuayeneID"];
                                                 $fizikiMuayeneAdi=$row["fizikiMuayeneAdi"];
                                    echo '<option value="'; echo $fizikiMuayeneID; echo'"'; if ($gelen_fiziki_muayene==$fizikiMuayeneID) { echo "  selected"; } else { }  echo'>'; echo $fizikiMuayeneAdi; echo' </option>';
                                       }
                                     echo '</SELECT>';
                                    ?>
                        </div>
                        <br>
                         <div class="form-group">
                            <label>Önemli Bir Hastalık Geçirdiniz Mi ?<span>*</span></label>
                            
                            &nbsp<label class="radio-inline">&nbsp &nbsp &nbsp
                                <input type="radio" name="onemli_hastalik" value="1" <?php if ($gelen_onemliHastalikGecirdiMi=='1') {echo "checked"; } else { } ?> checked="checked"> Evet &nbsp &nbsp &nbsp
                            </label>
                            &nbsp<label class="radio-inline">
                                <input type="radio" name="onemli_hastalik" value="2" <?php if ($gelen_onemliHastalikGecirdiMi=='2') {echo "checked"; } else { } ?> > Hayır
                            </label>
                        </div>
                        <br>
                         <div class="form-group">
                            <label>Önemli Bir Kaza Geçirdiniz Mi ?<span>*</span></label>
                            
                            &nbsp<label class="radio-inline">&nbsp &nbsp &nbsp
                                <input type="radio" name="onemli_kaza" value="1" <?php if ($gelen_onemliKazaGecirdiMi=='1') {echo "checked"; } else { } ?> checked="checked"> Evet &nbsp &nbsp &nbsp
                            </label>
                            &nbsp<label class="radio-inline">
                                <input type="radio" name="onemli_kaza" value="2" <?php if ($gelen_onemliKazaGecirdiMi=='2') {echo "checked"; } else { } ?> > Hayır
                            </label>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <label>Kan Grubunuz? </label>
                                <?php
                                 echo '<SELECT class="form-control" name="kan_grubu">';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmkangrubu");
                                       echo  '<option>Seçiniz </option>';
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $kanGrubuID=$row["kanGrubuID"];
                                                 $kanGrubuAdi=$row["kanGrubuAdi"];
                                    echo '<option value="'; echo $kanGrubuID; echo'"'; if ($gelenkan==$kanGrubuID) { echo "  selected"; } else { }  echo'>'; echo $kanGrubuAdi; echo' </option>';
                                       }
                                   echo '</SELECT>';
                                   ?> 
                        </div>
                        <br>
                         <div class="form-group">
                            <label>Daha Önce Psikolojik/Psikiyatrik Bir Yardım Aldınız Mı ?</label>
                            
                            &nbsp<label class="radio-inline">&nbsp &nbsp &nbsp
                                <input type="radio" name="psiko_yardim" value="1" <?php if ($gelen_psikolojikYardimAldiMi=='1') {echo "checked"; } else { } ?> checked="checked"> Evet &nbsp &nbsp &nbsp
                            </label>
                            &nbsp<label class="radio-inline">
                                <input type="radio" name="psiko_yardim"  value="2" <?php if ($gelen_psikolojikYardimAldiMi=='2') {echo "checked"; } else { } ?>> Hayır
                            </label>
                        </div>
                        <br>
                         <div class="form-group">
                            <label>Psikiyatrik İlaç Kullandınız Mı ?</label>
                            
                            &nbsp<label class="radio-inline">&nbsp &nbsp &nbsp
                                <input type="radio" name="psikiyatrik_ilac" value="1" <?php if ($gelen_psikiyatrikilacKullandiMi=='1') {echo "checked"; } else { } ?> checked="checked"> Evet &nbsp &nbsp &nbsp
                            </label>
                            &nbsp<label class="radio-inline">
                                <input type="radio" name="psikiyatrik_ilac" value="2" <?php if ($gelen_psikiyatrikilacKullandiMi=='2') {echo "checked"; } else { } ?> > Hayır
                            </label>
                        </div>
                        <br>
                                                 <?php
                                echo '<input type="hidden" name="danisanid" value="'.$danisanid.' ">';
                                 echo '<input type="hidden" name="formid" value="'.$formid.' ">';
                            ?>          
                    
                               
                        </div>
                    </fieldset>
                    

                    <button style="border-radius: 5px; padding: 15px 25px; font-size: 22px; text-decoration: none; margin: 20px; color: #fff; position: absolute; left: 2%; display: inline-block; background-color: #55acee; text-decoration-color: white" ><?php   

                          $geri="yetiskinform2";
                          echo '<a href="yetiskinform1.php?geri='.$geri.'&danisanid='.$danisanid.'&formid='.$formid.' style="color:white" ">';
                          echo "Geri Dön";
                          echo "</a>";
                          ?>
                              
                   </button>

                    
                         

                         <?php   
                         /*
                          $geri="yetiskinform2";
                          echo '<button  style="border-radius: 5px;text-decoration-color: white; padding: 15px 25px; font-size: 22px; text-decoration: none; margin: 20px; color: #fff; position: absolute; left: 2%; display: inline-block; background-color: #55acee"  href="yetiskinform1.php?geri='.$geri.'&danisanid='.$danisanid.'&formid='.$formid.'">';
                          echo "Geri Dön";
                          echo "</button>";
                         */ ?>

                         
                         <input style="border-radius: 5px; padding: 15px 25px; font-size: 22px; text-decoration: none; margin: 20px; color: #fff; position: absolute; right: 2%; display: inline-block; background-color: #2ecc71" name="submit" type="submit" value="Devam Et">

                          
                    
                </form>
                <!-- Form Wizard -->
        

    </div>
</section>

</html>