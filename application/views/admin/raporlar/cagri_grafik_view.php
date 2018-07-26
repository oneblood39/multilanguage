<div class="container" style="margin-top:60px;">
	
  
    <div class="row">

        <div class="col-lg-12">
            <?php
            echo anchor('admin/raporlar/raporlar/cagri_grafik/clear-cache','Yeniden Yükle','class="btn btn-primary"');
            ?>

    
         <table class="table table-hover table-bordered table-condensed">
       <?php
  /*  $sqlduyuru = "SELECT * FROM tblduyuru order by duyuruID desc";
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
             
    */
   

?>

 </table>
<?php

/*

$sql="select MONTH(dateCreated) as ay, 
count(cagriID) as cagriSayisi,
count(case when randevuyaDonusmeDurumu=1 then 1 end) as randevuyaDonusen,
count(case when randevuyaDonusmeDurumu=2 or randevuyaDonusmeDurumu is null  then 1 end) as randevuyaDonusmeyen
from vwcagri
where dateCreated > '2018-05-01 00:00:00'
group by MONTH(dateCreated)
order by month(dateCreated)";


   $dataPoints1 = array(  
   );

   $dataPoints2 = array(  
   );

   $dataPoints3 = array(  
   );


$results = $this->db->query($sql)->result();

  foreach ($results as $result) {
    $ay=$result->ay;
    if($ay=='5') { $ay='Mayıs'; }
    else if($ay=='1') { $ay='Ocak'; } 
    else if($ay=='2') { $ay='Şubat'; } 
    else if($ay=='3') { $ay='Mart'; } 
    else if($ay=='4') { $ay='Nisan'; } 
    else if($ay=='6') { $ay='Haziran'; }
    else if($ay=='7') { $ay='Temmuz'; }
    else if($ay=='8') { $ay='Ağustos'; }
    else if($ay=='9') { $ay='Eylül'; }
    else if($ay=='10') { $ay='Ekim'; }
    else if($ay=='11') { $ay='Kasım'; } 
    else if($ay=='12') { $ay='Aralık'; } 

    else { }
    $sayi=$result->cagriSayisi;
    $donusen=$result->randevuyaDonusen;
    $donusmeyen=$result->randevuyaDonusmeyen;
array_push($dataPoints1, array("label"=> $ay, "y"=> $sayi));
array_push($dataPoints2, array("label"=> $ay, "y"=> $donusen));
array_push($dataPoints3, array("label"=> $ay, "y"=> $donusmeyen));
 
  

  }








 /*
$dataPoints1 = array(
  array("label"=> $ay, "y"=> 136.12),
  array("label"=> "Haziran", "y"=> 134.87),
  array("label"=> "Temmuz", "y"=> 140.30),
  array("label"=> "Ağustos", "y"=> 135.30),
  array("label"=> "Eylül", "y"=> 139.50),
  array("label"=> "Ekim", "y"=> 150.82),
  array("label"=> "Kasım", "y"=> 94.70)
);
$dataPoints2 = array(
  array("label"=> $ay, "y"=> 64.61),
  array("label"=> "Haziran", "y"=> 70.55),
  array("label"=> "Temmuz", "y"=> 72.50),
  array("label"=> "Ağustos", "y"=> 81.30),
  array("label"=> "Eylül", "y"=> 63.60),
  array("label"=> "Ekim", "y"=> 69.38),
  array("label"=> "Kasım", "y"=> 98.70)
);
$dataPoints3 = array(
  array("label"=> $ay, "y"=> 39.61),
  array("label"=> "Haziran", "y"=> 49.55),
  array("label"=> "Temmuz", "y"=> 59.50),
  array("label"=> "Ağustos", "y"=> 29.30),
  array("label"=> "Eylül", "y"=> 39.60),
  array("label"=> "Ekim", "y"=> 49.38),
  array("label"=> "Kasım", "y"=> 19.70)
);
  */
?>
<!--<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Aylara Göre Çağrı Durumları"
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Tüm Çağrılar",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  },{
    type: "column",
    name: "Randevuya Dönüşen",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
  },{
    type: "column",
    name: "Randevuya Dönüşmeyen",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 470px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> -->



<h3><center>Aylara Göre Çağrılar</center></h3>
    <div id="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>

    <!-- javascript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo site_url('assets/admin/js/Chart.min.js');?>"></script>


      


        </div>
    </div>
</div>