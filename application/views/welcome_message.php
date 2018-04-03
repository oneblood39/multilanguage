<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<div id="container">
	<h1>PHP CodeIgniter Panele Hoşgeldiniz!</h1>
	<p class="footer"><center>Bu sayfa <strong>{elapsed_time}</strong> saniyede yüklendi. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></center></p>
</div>

</body>
</html>