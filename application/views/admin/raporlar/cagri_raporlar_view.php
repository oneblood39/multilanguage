<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">  
<?php
     $this->data['users'] = $this->ion_auth->users(array())->result();
     $user_id=$this->ion_auth->user()->row()->id;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;
    // echo $group_id;
   }


?>

 
        </div>
    </div>
    <div class="row"><br><br></div>
     <div class="row">
         <table class="display" cellspacing="0" width="100%" id="productsListTable">
      <thead>
        <tr>
<td><?php // echo '<a href="';echo site_url('admin/raporlar/raporlar/ankara_gunluk_randevu');echo'">Ankara Söğütözü Günlük Rapor</a>'; ?></td>
<td><?php // echo 'ikonlar'; ?></td>
        </tr>
      </thead>
<?php




?>
<tr>
  <div class="col-lg-4 col-lg-offset-4">
  <?php echo '<form id="form1" method="post" action="'.site_url('admin/raporlar/raporlar/cagri_raporlar').'">'; ?>

 <?php 
$user_id=$this->ion_auth->user()->row()->id;
$company=$this->ion_auth->user()->row()->company;

$baslangic=$this->input->post('baslangic');
$bitis=$this->input->post('bitis');
$gelenofis=$this->input->post('ofisler');

?>

          
                <label for="dtp_input1">Başlangıç Tarihi:</label>
                <div class="input-group date form_datetime form-control" data-date-format="yyyy-mm-dd HH:ii:00 p" data-link-field="dtp_input1">
                    <input name="baslangic" class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" /><br/>

                <label for="dtp_input1">Bitiş Tarihi:</label>
                <div class="input-group date form_datetime form-control" data-date-format="yyyy-mm-dd HH:ii:00 p" data-link-field="dtp_input1">
                    <input name="bitis" class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" /><br/>
         
<?php
if($company==3) { echo '<label>Ofisler:</label>
                <select name="ofisler" class="form-control">
                <option value="1">İstanbul-Bahçelievler</option>
                <option value="2">Ankara-Söğütözü</option>
                <option value="3">Tüm Ofisler</option>
                </select>'; }
 else { 
//echo $company;
  $gelenofis=$company; }               
?>

                
   
   <div class="col-lg-12" style="margin-top: 10px;">

          <input type="submit" class="btn btn-primary btn-lg btn-block" value="Filtrele">
            </form>


</tr>

</div>

    </table>

    <?php  
if($gelenofis and $baslangic and $bitis) {
if($gelenofis=='1') { $ofisadi='İstanbul-Bahçelievler'; } else {  }
if ($gelenofis=='2') { $ofisadi='Ankara-Söğütözü'; } else { }
if ($gelenofis=='3') { $ofisadi='Tüm Ofisler'; } else { }


echo '<br>';

                echo '<table class="table table-hover table-bordered table-condensed">';
                echo '<tr><td><b>Başlangıç Tarihi:'.$baslangic.'</b></td></td><td><b>Bitiş Tarihi:'.$bitis.'</b></td><td><b>Ofis:'.$ofisadi.'</b></td><td>İşlemler</td></tr>';

$metin=explode(' ', $baslangic);
$baslangic=$metin[0].' '.$metin[1];
//echo $baslangic;
$metin=explode(' ', $bitis);
$bitis=$metin[0].' '.$metin[1];
//echo $bitis;

                echo '<tr><td  colspan=3>Tüm Çağrılar</td>';
                echo'<td><a href="';echo site_url('admin/raporlar/raporlar/tum_cagrilar/'.$baslangic.'/'.$bitis.'/'.$gelenofis.'');echo'"><img src="../../../assets/admin/images/excel.png"></a></td></tr>';

                echo '<tr><td  colspan=3>Randevuya Dönüşen Çağrılar</td>';
                echo'<td><a href="';echo site_url('admin/raporlar/raporlar/randevuya_donusen_cagrilar/'.$baslangic.'/'.$bitis.'/'.$gelenofis.'');echo'"><img src="../../../assets/admin/images/excel.png"></a></td></tr>';

                echo '<tr><td  colspan=3>Randevuya Dönüşmeyen Çağrılar</td>';
                echo'<td><a href="';echo site_url('admin/raporlar/raporlar/randevuya_donusmeyen_cagrilar/'.$baslangic.'/'.$bitis.'/'.$gelenofis.'');echo'"><img src="../../../assets/admin/images/excel.png"></a></td></tr>';

echo '</table>';







} else {  }


       ?>

           

        </div>
    </div>
</div>