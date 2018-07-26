<div class="container" style="margin-top:60px;">
  
  
    <div class="row">

        <div class="col-lg-12">
            <?php
            echo anchor('admin/raporlar/raporlar/danisman_grafik2/clear-cache','Yeniden Yükle','class="btn btn-primary"');
            echo '&nbsp;';
            ?>
<a href="<?php echo site_url('admin/raporlar/raporlar/danisman_grafik');?>" class="btn btn-primary">Danışman - Seans</a>

<br><br>

<?php  echo '<form method="post" action="'.site_url('admin/raporlar/raporlar/danisman_grafik2').'">'; ?>
<div class="form-group">
                <?php
$month=$this->input->post('aylar');

if($month=='') {  $month=date('m');   } else { $month=$month; }

echo '<label>Aylar:</label>
<select name="aylar">
<option value="05" '; if ($month=='05') { echo 'selected'; } else { } echo'>Mayıs 2018</option>
<option value="06" '; if ($month=='06') { echo 'selected'; } else { } echo'>Haziran 2018</option>
<option value="07" '; if ($month=='07') { echo 'selected'; } else { } echo'>Temmuz 2018</option>
<option value="08" '; if ($month=='08') { echo 'selected'; } else { } echo'>Ağustos 2018</option>
<option value="09" '; if ($month=='09') { echo 'selected'; } else { } echo'>Eylül 2018</option>
<option value="10" '; if ($month=='10') { echo 'selected'; } else { } echo'>Ekim 2018</option>
<option value="11" '; if ($month=='11') { echo 'selected'; } else { } echo'>Kasım 2018</option>
<option value="12" '; if ($month=='12') { echo 'selected'; } else { } echo'>Aralık 2018</option>
</select>
';
                ?>
            </div>
             <?php echo form_submit('submit', 'Filtrele', 'class="btn btn-primary"');?>
<?php echo '</form>'; ?>
<?php
/*
$sql="select concat(DanismanAd,' ',DanismanSoyad) as danisman, round(count(randevuID)  /count(distinct danisanID),1) as seansOrtalaması
from vwrandevu
join vwusers on vwusers.id=vwrandevu.DanismanUserID
where randevuBaslangicTarihSaat > '2018-05-01 00:00:00' and MONTH(randevuBaslangicTarihSaat)=5 and RandevuDurumID=4
group by DanismanUserID
order by vwusers.aktiflik";

   $dataPoints2 = array(  
   );

$results = $this->db->query($sql)->result();

  foreach ($results as $result) {
    $danisman=$result->danisman;
    $seansOrtalaması=$result->seansOrtalaması;

array_push($dataPoints2, array("label"=> $danisman, "y"=> $seansOrtalaması));

 
  }
*/
?>
<!--<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light3",
  title:{
    text: "Danışman Seans Ortalamaları"
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Seans Ortalaması",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: false,
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
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
</html> 

-->

<h3><center>Danışman Seans Ortalamaları</center></h3>
    <div id="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>

    <!-- javascript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo site_url('assets/admin/js/Chart.min.js');?>"></script>


        </div>
    </div>
</div>



