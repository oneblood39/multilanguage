<div class="container" style="margin-top:60px;">
	
   <center><img src="<?php echo site_url('/assets/admin/images/CMS.png');?>"> </center>
    <div class="row">

        <div class="col-lg-12">
            <?php
            echo anchor('admin/dashboard/clear-cache','Yeniden Yükle','class="btn btn-primary"');
            ?>



<style type="text/css"> /* METİNLERİ AYARLAYINIZ BAŞLA */ 
.onyazi{display:block;} 
.onyazi::after{content:"Mizmer Yönetim v.1.1.0";margin-top:20px;display:inline-block;} 
.gun::after{content:" Gün ";} 
.gun{display:block;} 
.saat::after{content:":";} 
.dakika::after{content:":";} 
.sayacdurdu::after{content:"Süre Doldu!";display:inline-block;margin-top:20px;} 
/* METİNLERİ AYARLAYINIZ BİTTİ */ 

/* SAYACIN GÖRÜNÜMÜNÜ AYARLAYINIZ BAŞLA */ 
#dinamiksayac { 
align-self: center;
align-items: center;
 font-weight: bold; 
position:relative;z-index:1; 
text-align:center; 
color:black;   font-size:24px;  
width:400px;   height:120px; 
padding:0px;   display:block; 
background-color:none;   border:5px double orange; 
border-radius:25px;text-decoration:none; 
line-height:100%;} 
/* SAYACIN GÖRÜNÜMÜNÜ AYARLAYINIZ BİTTİ */ 

/* SAYACA ARKAPLAN RESMİ EKLEMEK İSTERSENİZ BURAYI ÖZELLEŞTİRİNİZ. YOKSA SİLİNİZ. BAŞLA */ 
#dinamiksayac::after { 
content:"";   background-size:100% 100%; 
/*background-image:url(http://www.ibrahimay.net/wp-content/scripts/geri-sayim-sayaci.v1/html/ornekler/ornek4.png); */
background-repeat:inherit;   opacity:0.2; 
top:0;   left:0;   bottom:0;   right:0; 
position:absolute;    z-index:-1; 
background-color:white;   border-radius:25px;} 
/* SAYACA ARKAPLAN RESMİ EKLEMEK İSTERSENİZ BURAYI ÖZELLEŞTİRİNİZ. YOKSA SİLİNİZ. BİTTİ */ </style> 
<script type="text/javascript" src="http://www.ibrahimay.net/wp-content/scripts/geri-sayim-sayaci.v1/index.php?zaman=2018-05-16T00:00"></script> 
<center><div id="dinamiksayac"></div></center>




    	
    	<h3>Sistem Mesajları</h3>
         <table class="table table-hover table-bordered table-condensed">
       <?php
    $sqlduyuru = "SELECT * FROM tblduyuru order by duyuruID desc";
    $results = $this->db->query($sqlduyuru)->result();
     foreach ($results as $result) {
       $aciklama=$result->duyuruAciklama;
       $onem=$result->duyuruOnemDurumu;
       $date=$result->dateCreated;
 $dizi = explode (" ",$date);
 $tarih = explode ("-",$dizi[0]);
 $date=$tarih[2].'-'.$tarih[1].'-'.$tarih[0].' '.$dizi[1];

      echo '<tr>';
      echo '<td>';
      if($onem=='4') { echo '<img src="';echo site_url('/assets/admin/images/bilgi.png');echo '">';  } else 
      if($onem=='3') { echo '<img src="';echo site_url('/assets/admin/images/uyari.png');echo '">';  } else 
      if($onem=='2') { echo '<img src="';echo site_url('/assets/admin/images/onemli.png');echo '">';  } else 
      if($onem=='1') { echo '<img src="';echo site_url('/assets/admin/images/cokonemli.png');echo '">';  } else  { }
      echo '</td>';
      echo '<td>';
      echo '<b>'.$aciklama.'</b>';
      echo '</td><td>';
      echo $date;
      echo '</td></tr>';
     }
             
    
   

?>

 </table>

        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>



        </div>
    </div>
</div>