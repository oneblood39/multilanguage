<?php
//require_once("mysql.php");

if(isset($_GET['il'])){


echo 'birkan';
	
	$il=(int)$_GET['il'];
	
	if($il>0){
		$dk=$db->q("SELECT `id`,`ilce_adi` FROM `tnmilce` WHERE `il_id`='$il' ORDER BY `id` ASC");
		$list='{"0":"Seçiniz",';
		while($ilr=$db->fassoc($dk)){
			$list.='"'.$ilr['id'].'":"'.$ilr['ilce_adi'].'",';
		}
		$list=substr($list,0,-1);
		$list.="}";
		
		echo $list;
	}
}
else if(isset($_GET['ilce'])){
	$ilce=(int)$_GET['ilce'];
	
	if($ilce>0){
		$dk=$db->q("SELECT `id`,`semt_adi` FROM `semt` WHERE `ilce_id`='$ilce' ORDER BY `id` ASC");
		$list='{"0":"Seçiniz",';
		while($ilr=$db->fassoc($dk)){
			$list.='"'.$ilr['id'].'":"'.$ilr['semt_adi'].'",';
		}
		$list=substr($list,0,-1);
		$list.="}";
		
		echo $list;
	}
}
else if(isset($_GET['semt'])){
	$semt=(int)$_GET['semt'];
	
	if($semt>0){
		$dk=$db->q("SELECT `id`,`mahalle_adi` FROM `mahalle` WHERE `semt_id`='$semt' ORDER BY `id` ASC");
		$list='{"0":"Seçiniz",';
		while($ilr=$db->fassoc($dk)){
			$list.='"'.$ilr['id'].'":"'.$ilr['mahalle_adi'].'",';
		}
		$list=substr($list,0,-1);
		$list.="}";
		
		echo $list;
	}
}

//$db->close();
?>