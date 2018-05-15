<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<footer>
    <div class="container">
        <p class="footer"><center>Bu sayfa <strong>{elapsed_time}</strong> saniyede yüklendi. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></center><center><strong>Mizmer-BT Panel v.1.1.0</strong> Her hakkı saklıdır.&copy; 2018</center></p>
        <p class="footer"><center>Sorun, öneri ve talepleriniz için     
<a href="mailto:birkan@mizmer.com.tr">birkan@mizmer.com.tr</a> adresine mail gönderebilirsiniz.</center></p>
    </div>
</footer>
<script src="<?php echo site_url('assets/admin/js/bootstrap.min.js');?>"></script>
<script src="<?php echo site_url('assets/admin/js/bootstrap-datetimepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            locale: 'en',
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true,
            showTodayButton: true
        });
    });
</script>

    

          <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ae1d2e05f7cdf4f0533a376/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->  
   

<?php echo $before_body;?>
</body>
</html>