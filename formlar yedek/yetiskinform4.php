<!DOCTYPE html>
<?php
//error_reporting(0);
//echo 'testt';
$danisanid=$_POST["danisanid"];
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


    $anne_durum=$_POST["anne_durum"];
    $baba_durum=$_POST["baba_durum"];
    $kardes_sayisi=$_POST["kardes_sayisi"];
    $cocuk_sayisi=$_POST["cocuk_sayisi"];
    $alkol_durum=$_POST["alkol_durum"];
    $alkol_siklik=$_POST["alkol_siklik"];
    $sigara_durum=$_POST["sigara_durum"];
    $uyusturucu_durum=$_POST["uyusturucu_durum"];
    $uyusturucu_siklik=$_POST["uyusturucu_siklik"];

     $sql = "UPDATE tblbasvuruyetiskin SET anneHayattaMi='".$anne_durum."', babaHayattaMi='".$baba_durum."', kardesSayisi='".$kardes_sayisi."',cocukSayisi='".$cocuk_sayisi."', alkolKullaniyorMu='".$alkol_durum."', alkolDurumID='".$alkol_siklik."', sigaraKullaniyorMu='".$sigara_durum."', uyusturucuKullaniyorMu='".$uyusturucu_durum."', uyusturucuDurumID='".$uyusturucu_siklik."' WHERE danisanID=".$danisanid."";
          if(mysqli_query($mysqli, $sql)){
        //    echo "Records were updated successfully.";
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
          }



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
            padding-bottom: 10%;
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
            background:#4CAF50;
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
            text-align: left;
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
                        <div class="form-wizard-step active">
                            
                            <p>Sağlık Bilgileri</p>
                        </div>
                        <!-- Step 2 -->

                        <!-- Step 3 -->
                        <div class="form-wizard-step active">
                            
                            <p>Aile Bilgileri</p>
                        </div>
                        
                    </div>
                    <!-- Form progress -->


                    <!-- Form Step 1 -->
                    <fieldset>

                        <center><h4> FORMUMUZU DOLDURDUĞUNUZ İÇİN TEŞEKKÜR EDERİZ</h4></center>
                        <center><img src="assets/admin/images/smile.png" width="10%" height="10%" > </center>
                         <center><h5> <a href="admin/user/login/index.php"> Sisteme Dönmek İçin Tıklayınız </a> </h5></center>
               </fieldset>
                </form>
                <!-- Form Wizard -->
            </div>
        </div>

    </div>
</section>

</html>