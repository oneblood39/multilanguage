<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<footer>
    <div class="container">
        <p class="footer"><center>Bu sayfa <strong>{elapsed_time}</strong> saniyede yüklendi. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></center><center><strong>Mizmer-BT</strong> Her hakkı saklıdır.</center></p>
        <p class="footer"><center>Sorun, öneri ve talepleriniz için     
<a href="mailto:birkan@mizmer.com.tr">birkan@mizmer.com.tr</a> adresine mail gönderebilirsiniz.</center></p>
    </div>
</footer>
<script src="<?php echo site_url('assets/admin/js/bootstrap.min.js');?>"></script>
<?php echo $before_body;?>
</body>
</html>