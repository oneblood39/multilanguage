<div class="container" style="margin-top:60px;">
	
  
    <div class="row">

        <div class="col-lg-12">
            <?php
            echo anchor('admin/raporlar/raporlar/randevu_grafik/clear-cache','Yeniden Yükle','class="btn btn-primary"');
            ?>


<h3><center>Aylara Göre Randevular</center></h3>
    <div id="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>

    <!-- javascript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo site_url('assets/admin/js/Chart.min.js');?>"></script>


      


        </div>
    </div>
</div>