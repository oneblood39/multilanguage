<div class="container" style="margin-top:60px;">
	
   <center><img src="<?php echo site_url('/assets/admin/images/CMS.png');?>"> </center>
    <div class="row">

        <div class="col-lg-12">
            <?php
            echo anchor('admin/dashboard/clear-cache','Yeniden Yükle','class="btn btn-primary"');
            ?>
    	
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