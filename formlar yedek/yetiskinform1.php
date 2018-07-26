<?php
//error_reporting(0);
//echo 'testt';
$danisanid=$_GET["danisanid"];
$formid=$_GET["formid"];
/*echo $danisanid;
echo '<br>';
echo $formid;
*/
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

	// tblbasvuruyetiskin
/*$sql = "insert into dictionary(parent_id) values ('".$danisanid."')";
if (mysqli_query($mysqli,$sql))
    echo "veriler eklendi";
*/

/*
    $geri=$_GET['geri'];

    if($geri) { 
//kaydetme
        } else {
        	//kaydet
        }
*/
  
 // $geri=$_GET['geri'];
    if (isset($_GET['geri'])) { 

 $result=mysqli_query($mysqli,"SELECT * FROM tbldanisan WHERE danisanID=".$danisanid."" );
while ($row=mysqli_fetch_array($result)) {
$danisanAd=$row["danisanAd"];
$danisanSoyad=$row["danisanSoyad"];
$isim=$danisanAd.' '.$danisanSoyad;
$danisanTel=$row["danisanTel"];
$danisanEposta=$row["danisanEposta"];
}

                                     
               $result=mysqli_query($mysqli,"SELECT * FROM tblbasvuruyetiskin WHERE danisanID=".$danisanid."" );
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $gelen_cinsiyet=$row["cinsiyeti"];
                                                 $gelen_yas=$row["yas"];
                                                 $gelen_egitim_durumu=$row["egitimDurumuID"];
                                                 $gelen_ikamet_il=$row["ikametilID"];
                                                 $gelen_ikamet_ilce=$row["ikametilceID"];
                                                 $gelen_memleket_il=$row["memleketilID"];
                                                 $gelen_memleket_ilce=$row["memleketilceID"];
                                                 $gelen_sekil=$row["gelmeSekliID"];
                                                 $gelen_medeni_durum=$row["medeniDurum"];
                                                 $gelen_meslek_id=$row["meslekID"];
                                                 $gelen_meslek=$row["meslek"];
                                                 $gelen_basvuru_nedeni=$row["basvuruNedeniID"];
                                                 $gelen_alt_basvuru_nedeni=$row["altBasvuruNedeniID"];
                                                 $gelen_danismanlik_alma_nedeni=$row["danismanlikAlmaNedeni"];
                                                                                 
                                                
                                       }
                                  
      


       } else {

       	 $result=mysqli_query($mysqli,"SELECT * FROM tbldanisan WHERE danisanID=".$danisanid."" );
while ($row=mysqli_fetch_array($result)) {
$danisanAd=$row["danisanAd"];
$danisanSoyad=$row["danisanSoyad"];
$isim=$danisanAd.' '.$danisanSoyad;
$danisanTel=$row["danisanTel"];
$danisanEposta=$row["danisanEposta"];
}


                                                 $gelen_cinsiyet='';
                                                 $gelen_yas='';
                                                 $gelen_egitim_durumu='';
                                                 $gelen_ikamet_il='';
                                                 $gelen_ikamet_ilce='';
                                                 $gelen_memleket_il='';
                                                 $gelen_memleket_ilce='';
                                                 $gelen_sekil='';
                                                 $gelen_medeni_durum='';
                                                 $gelen_meslek_id='';
                                                 $gelen_meslek='';
                                                 $gelen_basvuru_nedeni='';
                                                 $gelen_alt_basvuru_nedeni='';
                                                 $gelen_danismanlik_alma_nedeni='';


 

}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Title</title>
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

        .form-wizard a, .form-wizard a:hover, .form-wizard a:focus {
            color: #ea2803;
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
                <form role="form" action="yetiskinform2.php" method="post">

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
                        <div class="form-wizard-step">
                            
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
                    <fieldset >

                        <h4>Kişisel Bilgiler <span>Adım 1 - 3</span></h4>
                        <div class="form-group">
                            <label>Adınız -Soyadınız <span>*</span></label>
                            <input type="text" name="yetiskin_ad" placeholder="<?php echo $isim; ?>" class="form-control" readonly="">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Telefon Numaranız<span>*</span></label>
                            <input type="number" name="telefon_numarasi" placeholder="<?php echo $danisanTel; ?>" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Mail Adresiniz<span>*</span></label>
                            <input type="email" name="eposta" placeholder="<?php echo $danisanEposta; ?>" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Cinsiyetiniz &nbsp &nbsp</label>
                            <label class="radio-inline">&nbsp
                                <input type="radio" name="cinsiyet" value="1" <?php if ($gelen_cinsiyet=='1') {echo "checked"; } else { } ?> checked="checked">  Kadın &nbsp &nbsp
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="cinsiyet" value="2" <?php if ($gelen_cinsiyet=='2') {echo "checked"; } else { } ?> >  Erkek
                            </label>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <label>Yaşınız</label>
                            <select class="form-control" name="yas">
                                <?php 
                                   for($i=18; $i<=90; $i++){
                                   
                                     echo '<option value="'; echo $i; echo'"'; if ($gelen_yas==$i) { echo "  selected" ; } else { }  echo'>'; echo $i; echo' </option>';

                                    }
                                ?>
                             </select>
                        </div>
                        <br>
                        <div class="form-group">
                                 <label>Eğitim Durumunuz </label>
                                 <?php
                                echo '<SELECT class="form-control" name="egitim_durum">';
                                   $result=mysqli_query($mysqli,"SELECT * FROM tnmegitimdurum");
                                   while ($row=mysqli_fetch_array($result)) {

                                             $egitimDurumID=$row["egitimDurumID"];
                                             $egitimDurumAdi=$row["egitimDurumAdi"];
                                echo '<option value="'; echo $egitimDurumID; echo'"'; if ($gelen_egitim_durumu==$egitimDurumID) { echo "  selected"; } else { }  echo'>'; echo $egitimDurumAdi; echo' </option>';
                                   }
                                 echo '</SELECT>';
                                ?>
                        </div>
                        <br>
                    
                    
                         <div class="form-group">
                         <label>İkamet </label>
                                <?php
                                 echo '<SELECT class="form-control" id="mark" name="yetiskin_ikamet_il" required>';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmil");
                                       echo  '<option disabled>Seçiniz </option>';
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $ilID=$row["ilID"];
                                                 $ilAdi=$row["ilAdi"];

                                   // echo ' <option value='.$ilID.'>'.$ilAdi.'</option>';      
                                  echo '<option value="'; echo $ilID; echo'"'; if ($gelen_ikamet_il==$ilID) { echo "  selected "; } else { }  echo'>'; echo $ilAdi; echo' </option>';
                                       }
                                   echo '</SELECT>';
                                   ?>
                        </div>
                        <br>
                        <div class="form-group">
                         <label>ilçe </label>
                                 <?php
                                 echo '<SELECT class="form-control" id="series" name="yetiskin_ikamet_ilce" required>';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmilce");
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $ilceID=$row["ilceID"];
                                                 $ilceAdi=$row["ilceAdi"];
                                                 $ilID=$row["ilID"];

                                    echo'<option value="'.$ilceID.'" class="'.$ilID.'">'.$ilceAdi.'</option>';
                                      }
                                   echo '</SELECT>';
                                   ?> 
                        </div>
                        <br>
                        <div class="form-group">
                                 <label>Memleket İl </label>
                                 <?php
                                 echo '<SELECT class="form-control" id="mark1" name="yetiskin_memleket_il">';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmil");
                                       echo  '<option>Seçiniz </option>';
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $ilID=$row["ilID"];
                                                 $ilAdi=$row["ilAdi"];
                                    echo '<option value="'; echo $ilID; echo'"'; if ($gelen_memleket_il==$ilID) { echo "  selected"; } else { }  echo'>'; echo $ilAdi; echo' </option>';
                                       }
                                   echo '</SELECT>';
                                ?>
                        </div>
                        <br>
                        <div class="form-group">
                                 <label>Memleket ilçe </label>
                                  <?php
                                 echo '<SELECT class="form-control" id="series1" name="yetiskin_memleket_ilce" required>';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmilce");
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $ilceID=$row["ilceID"];
                                                 $ilceAdi=$row["ilceAdi"];
                                                 $ilID=$row["ilID"];

                                   // echo'<option value="'.$ilceID.'" class="'.$ilID.'">'.$ilceAdi.'</option>';
                                     echo '<option value="'; echo $ilceID; echo'"'; echo 'class="'.$ilID.'"'; if ($gelen_memleket_ilce==$ilceID) { echo "  selected"; } else { }  echo'>'; echo $ilceAdi; echo' </option>';
                                    
                                       }
                                   echo '</SELECT>';
                                
                                   ?> 
                        </div>
                        <br>
                        <div class="form-group">
                         <label>Bize Nereden Ulaştınız? </label>
                         <?php
                                 echo '<SELECT class="form-control" name="ulasim">';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmcagriyonlenme");
                                       echo  '<option>Seçiniz </option>';
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $cagriYonlenmeID=$row["cagriYonlenmeID"];
                                                 $cagriYonlenmeAdi=$row["cagriYonlenmeAdi"];
                                    
                                    echo '<option value="'; echo $cagriYonlenmeID; echo'"'; if ($gelen_sekil==$cagriYonlenmeID) { echo "  selected"; } else { }  echo'>'; echo $cagriYonlenmeAdi; echo' </option>';
                                       }
                                   echo '</SELECT>';
                                   ?>  
                        
                        </div>
                        <br>
                        <div class="form-group">
                         <label>Medeni Durumunuz</label>
                         <select name="medeni_durum" class="form-control">
                              <option value="1" <?php if ($gelen_medeni_durum=='1') {echo "selected"; } else { } ?> >Evli</option>
                              <option value="2" <?php if ($gelen_medeni_durum=='2') {echo "selected"; } else { } ?> >Bekar</option>
                              <option value="3" <?php if ($gelen_medeni_durum=='3') {echo "selected"; } else { } ?> >Boşanmış</option>
                          </select>
                      </div>



                       <br>
                        <div class="form-group">
                         <label>Mesleğiniz </label>
                        <?php
                                 echo '<SELECT class="form-control" name="meslek">';
                                       $result=mysqli_query($mysqli,"SELECT * FROM tnmmeslek");
                                       while ($row=mysqli_fetch_array($result)) {

                                                 $meslekID=$row["meslekID"];
                                                 $meslekAdi=$row["meslekAdi"];
                                    echo '<option value="'; echo $meslekID; echo'"'; if ($gelen_meslek_id==$meslekID) { echo "  selected"; } else { }  echo'>'; echo $meslekAdi; echo' </option>';
                                       }
                                   echo '</SELECT>';
                                   ?> 
                        
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Meslek Açıklama</label>
                            <input type="text" name="meslek_aciklama" value="<?php echo $gelen_meslek; ?>" placeholder="" class="form-control">
                            </div>


                        <br>

                        <div class="form-group">
                         <label>Başvuru nedeniniz ?</label>
                         <?php
                         echo '<SELECT class="form-control" id="basvuru" name="basvuru_nedeni">';
                               $result=mysqli_query($mysqli,"SELECT * FROM tnmbasvurunedeni");
                               while ($row=mysqli_fetch_array($result)) {

                                         $basvuruNedeniID=$row["basvuruNedeniID"];
                                         $basvuruNedeniAdi=$row["basvuruNedeniAdi"];
                            echo '<option value="'; echo $basvuruNedeniID; echo'"'; if ($gelen_basvuru_nedeni==$basvuruNedeniID) { echo "  selected"; } else { }  echo'>'; echo $basvuruNedeniAdi; echo' </option>';
                               }
                           echo '</SELECT>';
                           ?>
                         </div>
                         <br>
                          <div class="form-group">
                         <label>Alt Başvuru nedeniniz ?</label>
                         <?php
                             echo '<SELECT class="form-control" id="altbasvuru" name="alt_basvuru_nedeni">';
                                   $result=mysqli_query($mysqli,"SELECT * FROM tnmaltbasvurunedeni");
                                   while ($row=mysqli_fetch_array($result)) {

                                             $altBasvuruNedeniID=$row["altBasvuruNedeniID"];
                                             $altBasvuruNedeniAdi=$row["altBasvuruNedeniAdi"];
                                             $basvuruNedeniID=$row["basvuruNedeniID"];

                                echo'<option value="'.$altBasvuruNedeniID.'" class="'.$basvuruNedeniID.'">'.$altBasvuruNedeniAdi.'</option>';
                                   }
                               echo '</SELECT>';
                               ?>
                         </div>
                         <br>
                         <div class="form-group">
                            <label>Danışmanlık Alma Nedeniniz <span>*</span></label>
                            <input type="text" name="basvuru_aciklama" value="<?php echo $gelen_danismanlik_alma_nedeni; ?>" placeholder="Kısaca Açıklayınız" class="form-control required">
                        </div>
                        <br>

                     </fieldset>
             

                 
               

            </div>
            <div class="form-wizard-buttons">
                            <?php
                                echo '<input type="hidden" name="danisanid" value="'.$danisanid.' ">';
                                echo '<input type="hidden" name="formid" value="'.$formid.' ">';
                            ?>
                            <div>
                                <input style="border-radius: 5px; padding: 15px 25px; font-size: 22px; text-decoration: none; margin: 20px; color: #fff; position: absolute; right: 2%; display: inline-block; background-color: #0098ce" name="submit" type="submit" value="Devam Et">
                            </div>
            </div>
   </form>
        </div>

    </div>
</section>
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

</html>



    
