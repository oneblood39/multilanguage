<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raporlar extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('raporlar/raporlar_model');
      /*  if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index() 
    {
        $this->data['page_title'] = 'Raporlar';
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/raporlar/index_view','admin_master',$this->data);
	  }

    public function randevu_raporlar() 
    {
        $this->data['page_title'] = 'Randevu Raporları';
        $this->data['users'] = $this->ion_auth->users(array())->result();

  $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();

( function( factory ) {
  if ( typeof define === "function" && define.amd ) {

    // AMD. Register as an anonymous module.
    define( [ "../widgets/datepicker" ], factory );
  } else {

    // Browser globals
    factory( jQuery.datepicker );
  }
}( function( datepicker ) {

datepicker.regional.tr = {
  closeText: "kapat",
  prevText: "&#x3C;geri",
  nextText: "ileri&#x3e",
  currentText: "bugün",
  monthNames: [ "Ocak","Şubat","Mart","Nisan","Mayıs","Haziran",
  "Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık" ],
  monthNamesShort: [ "Oca","Şub","Mar","Nis","May","Haz",
  "Tem","Ağu","Eyl","Eki","Kas","Ara" ],
  dayNames: [ "Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi" ],
  dayNamesShort: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  dayNamesMin: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  weekHeader: "Hf",
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.tr );

return datepicker.regional.tr;

} ) );


  } );
 
</script>
//////////////////////////////////////////////////
 <script>
  $( function() {
    $( "#datepicker2" ).datepicker();

( function( factory ) {
  if ( typeof define === "function" && define.amd ) {

    // AMD. Register as an anonymous module.
    define( [ "../widgets/datepicker" ], factory );
  } else {

    // Browser globals
    factory( jQuery.datepicker );
  }
}( function( datepicker ) {

datepicker.regional.tr = {
  closeText: "kapat",
  prevText: "&#x3C;geri",
  nextText: "ileri&#x3e",
  currentText: "bugün",
  monthNames: [ "Ocak","Şubat","Mart","Nisan","Mayıs","Haziran",
  "Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık" ],
  monthNamesShort: [ "Oca","Şub","Mar","Nis","May","Haz",
  "Tem","Ağu","Eyl","Eki","Kas","Ara" ],
  dayNames: [ "Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi" ],
  dayNamesShort: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  dayNamesMin: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  weekHeader: "Hf",
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.tr );

return datepicker.regional.tr;

} ) );


  } );
 
</script>

<link href="../../../assets/admin/locales/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
';


$this->data['before_body'] ='
<!--<script type="text/javascript" src="../../../assets/admin/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../../assets/admin/bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="../../../assets/admin/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../../assets/admin/locales/bootstrap-datetimepicker.tr.js" charset="UTF-8"></script>

<script type="text/javascript">
    $(\'.form_datetime\').datetimepicker({
        language:  \'tr\',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $(\'.form_date\').datetimepicker({
        language:  \'tr\',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $(\'.form_time\').datetimepicker({
        language:  \'tr\',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>
';

        $this->render('admin/raporlar/randevu_raporlar_view','admin_master',$this->data);
    }

public function tum_randevular() 
    {
 $this->load->view('admin/raporlar/excel/tum_randevular_view');
}

public function gelinen_randevular() 
    {
 $this->load->view('admin/raporlar/excel/gelinen_randevular_view');
}

public function iptal_randevular() 
    {
 $this->load->view('admin/raporlar/excel/iptal_randevular_view');
}


 public function cagri_raporlar() 
    {
        $this->data['page_title'] = 'Randevu Raporları';
        $this->data['users'] = $this->ion_auth->users(array())->result();

  $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();

( function( factory ) {
  if ( typeof define === "function" && define.amd ) {

    // AMD. Register as an anonymous module.
    define( [ "../widgets/datepicker" ], factory );
  } else {

    // Browser globals
    factory( jQuery.datepicker );
  }
}( function( datepicker ) {

datepicker.regional.tr = {
  closeText: "kapat",
  prevText: "&#x3C;geri",
  nextText: "ileri&#x3e",
  currentText: "bugün",
  monthNames: [ "Ocak","Şubat","Mart","Nisan","Mayıs","Haziran",
  "Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık" ],
  monthNamesShort: [ "Oca","Şub","Mar","Nis","May","Haz",
  "Tem","Ağu","Eyl","Eki","Kas","Ara" ],
  dayNames: [ "Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi" ],
  dayNamesShort: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  dayNamesMin: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  weekHeader: "Hf",
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.tr );

return datepicker.regional.tr;

} ) );


  } );
 
</script>
//////////////////////////////////////////////////
 <script>
  $( function() {
    $( "#datepicker2" ).datepicker();

( function( factory ) {
  if ( typeof define === "function" && define.amd ) {

    // AMD. Register as an anonymous module.
    define( [ "../widgets/datepicker" ], factory );
  } else {

    // Browser globals
    factory( jQuery.datepicker );
  }
}( function( datepicker ) {

datepicker.regional.tr = {
  closeText: "kapat",
  prevText: "&#x3C;geri",
  nextText: "ileri&#x3e",
  currentText: "bugün",
  monthNames: [ "Ocak","Şubat","Mart","Nisan","Mayıs","Haziran",
  "Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık" ],
  monthNamesShort: [ "Oca","Şub","Mar","Nis","May","Haz",
  "Tem","Ağu","Eyl","Eki","Kas","Ara" ],
  dayNames: [ "Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi" ],
  dayNamesShort: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  dayNamesMin: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
  weekHeader: "Hf",
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.tr );

return datepicker.regional.tr;

} ) );


  } );
 
</script>

<link href="../../../assets/admin/locales/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
';


$this->data['before_body'] ='
<!--<script type="text/javascript" src="../../../assets/admin/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../../assets/admin/bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="../../../assets/admin/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../../assets/admin/locales/bootstrap-datetimepicker.tr.js" charset="UTF-8"></script>

<script type="text/javascript">
    $(\'.form_datetime\').datetimepicker({
        language:  \'tr\',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $(\'.form_date\').datetimepicker({
        language:  \'tr\',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $(\'.form_time\').datetimepicker({
        language:  \'tr\',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>
';


        $this->render('admin/raporlar/cagri_raporlar_view','admin_master',$this->data);
    }

public function tum_cagrilar() 
    {
 $this->load->view('admin/raporlar/excel/tum_cagrilar_view');
}

public function randevuya_donusen_cagrilar() 
    {
 $this->load->view('admin/raporlar/excel/randevuya_donusen_cagrilar_view');
}

public function randevuya_donusmeyen_cagrilar() 
    {
 $this->load->view('admin/raporlar/excel/randevuya_donusmeyen_cagrilar_view');
}



public function datagrafik ()/////dashboard grafik
{
header('Content-Type: application/json');

//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');


//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("UTF8");
if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}


$query2=("SET lc_time_names = 'tr_TR'");
$result2 = $mysqli->query($query2);

$query = "
select MONTHname(randevuBaslangicTarihSaat) as ay, 
count(case when RandevuDurumID=4 then 1 end) as randevuyaGeldi,
count(case when RandevuDurumID=5 then 1 end) as iptalRandevu,
count(case when RandevuDurumID=3 then 1 end) as randevuyaGelmedi
from vwrandevu
where RandevuDurumID in(3,4,5) and randevuBaslangicTarihSaat > '2018-05-01 00:00:00'
group by MONTHNAME(randevuBaslangicTarihSaat)
order by month(randevuBaslangicTarihSaat)";

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//print_r($data);

//free memory associated with result
$result->close();


//now print the data
print json_encode($data);
}


public function cagri_grafik ()
{
        $this->data['page_title'] = 'Çağrı Grafikler';
        $this->data['users'] = $this->ion_auth->users(array())->result();


 $this->data['before_head'] ="
<script>
 $(document).ready(function(){
    $.ajax({

   url: 'http://localhost/multilanguage/admin/raporlar/raporlar/cagrigrafik',
        method: 'GET',
        success: function(data) {
            console.log(data);
            var ay = [];
            var cagriSayisi = [];   
            var randevuyaDonusen=[];
            var randevuyaDonusmeyen=[];

            for(var i in data) {

                ay.push(data[i].ay);
              
                cagriSayisi.push(data[i].cagriSayisi);

                randevuyaDonusen.push(data[i].randevuyaDonusen);

                randevuyaDonusmeyen.push(data[i].randevuyaDonusmeyen);
                
            }

            var chartdata = {
                labels: ay,
                datasets : [
                    {
                        label: 'Tüm Çağrılar',
                        backgroundColor: 'rgba(109, 203, 37, 1)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(109, 203, 37, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: cagriSayisi
                        
                    },
                    {
                        label: 'Randevuya Dönüşen Çağrılar',
                        backgroundColor: 'rgba(0, 93, 224, 0.49)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(0, 93, 224, 0.49)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: randevuyaDonusen
                        
                    },
                   {
                        label: 'Randevuya Dönüşmeyen Çağrılar',
                        backgroundColor: 'rgba(224, 11, 0, 0.97)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(224, 11, 0, 0.97)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: randevuyaDonusmeyen
                        
                    }
                ]
            };

            var ctx = $('#mycanvas');

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>
";

 $this->render('admin/raporlar/cagri_grafik_view','admin_master',$this->data); 
}


public function cagrigrafik ()/////cagri grafik
{
header('Content-Type: application/json');

//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("UTF8");
if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

$query2=("SET lc_time_names = 'tr_TR'");
$result2 = $mysqli->query($query2);


$query = "select MONTHNAME(dateCreated) as ay, 
count(cagriID) as cagriSayisi,
count(case when randevuyaDonusmeDurumu=1 then 1 end) as randevuyaDonusen,
count(case when randevuyaDonusmeDurumu=2 or randevuyaDonusmeDurumu is null  then 1 end) as randevuyaDonusmeyen
from vwcagri
where dateCreated > '2018-05-01 00:00:00'
group by MONTHNAME(dateCreated)
order by month(dateCreated)";

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//print_r($data);

//free memory associated with result
$result->close();

//close connection
//$mysqli->close();

//now print the data
print json_encode($data);
}


public function randevu_grafik ()
{
        $this->data['page_title'] = 'Randevu Grafikler';
        $this->data['users'] = $this->ion_auth->users(array())->result();

 $this->data['before_head'] ="
<script>
 $(document).ready(function(){
    $.ajax({

url: 'http://localhost/multilanguage/admin/raporlar/raporlar/datagrafik',
        method: 'GET',
        success: function(data) {
            console.log(data);
            var ay = [];
            var randevuyaGeldi = [];   
            var iptalRandevu=[];
            var randevuyaGelmedi=[];


            for(var i in data) {


       ay.push(data[i].ay);
              
                randevuyaGeldi.push(data[i].randevuyaGeldi);

                iptalRandevu.push(data[i].iptalRandevu);

                randevuyaGelmedi.push(data[i].randevuyaGelmedi);
                
            }

            var chartdata = {
                labels: ay,
                datasets : [
                    {
                        label: 'Gerçekleşen Randevular',
                        backgroundColor: 'rgba(109, 203, 37, 1)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(109, 203, 37, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: randevuyaGeldi
                        
                    },
                    {
                        label: 'İptal Edilen Randevular',
                        backgroundColor: 'rgba(0, 93, 224, 0.49)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(0, 93, 224, 0.49)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: iptalRandevu
                        
                    },
                   {
                        label: 'Danışanın Gelmediği Randevular',
                        backgroundColor: 'rgba(224, 11, 0, 0.97)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(224, 11, 0, 0.97)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: randevuyaGelmedi
                        
                    }
                ]
            };

            var ctx = $('#mycanvas');

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>
";

 $this->render('admin/raporlar/randevu_grafik_view','admin_master',$this->data); 
}


public function randevugrafik ()/////cagri grafik
{
header('Content-Type: application/json');

//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');


//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("UTF8");
if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}


$query2=("SET lc_time_names = 'tr_TR'");
$result2 = $mysqli->query($query2);

$query = "
select MONTHname(randevuBaslangicTarihSaat) as ay, 
count(case when RandevuDurumID=4 then 1 end) as randevuyaGeldi,
count(case when RandevuDurumID=5 then 1 end) as iptalRandevu,
count(case when RandevuDurumID=3 then 1 end) as randevuyaGelmedi
from vwrandevu
where RandevuDurumID in(3,4,5) and randevuBaslangicTarihSaat > '2018-05-01 00:00:00'
group by MONTHNAME(randevuBaslangicTarihSaat)
order by month(randevuBaslangicTarihSaat)";

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//print_r($data);

//free memory associated with result
$result->close();

//close connection
//$mysqli->close();

//now print the data
print json_encode($data);
}


public function danisman_grafik ()
{
        $this->data['page_title'] = 'Danışman Performans Grafikleri';
        $this->data['users'] = $this->ion_auth->users(array())->result();
         $this->load->library('form_validation');


$month=$this->input->post('aylar');

if($month=='') {  $month=date('m');   } else { $month=$month; }


$date = '2018-'.$month.'-01 00:00:00';

/*
$month= '06';
$date = '2018-06-01 00:00:00';
*/

         $datasessionmevcut = array(                       
                    'date' => $date,
                    'month' =>  $month                                         
                );


$this->load->library('session');
$this->session->set_userdata($datasessionmevcut);
//echo $this->session->userdata('randevuDanismanID'); 
// print_r($datasessionmevcutyaz);



 $this->data['before_head'] ="
<script>
 $(document).ready(function(){
    $.ajax({

url: 'http://localhost/multilanguage/admin/raporlar/raporlar/danismangrafik',
        method: 'GET',
        success: function(data) {
            console.log(data);
            var danisman = [];
            var seansSayisi = [];   
            var danisanSayisi=[];

            for(var i in data) {

       danisman.push(data[i].danisman);
              
                seansSayisi.push(data[i].seansSayisi);
                danisanSayisi.push(data[i].danisanSayisi);

                
            }

            var chartdata = {
                labels: danisman,
                datasets : [
                    {
                        label: 'Seans Sayısı',
                        backgroundColor: 'rgba(109, 203, 37, 1)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(109, 203, 37, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: seansSayisi
                        
                    },
                    {
                        label: 'Danışan Sayısı',
                        backgroundColor: 'rgba(0, 93, 224, 0.49)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(0, 93, 224, 0.49)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: danisanSayisi
                        
                    }

                ]
            };

            var ctx = $('#mycanvas');

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>
";

 $this->render('admin/raporlar/danisman_grafik_view','admin_master',$this->data); 
}

public function danismangrafik() {
header('Content-Type: application/json');
//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("UTF8");
if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

$tarih=$this->session->userdata('date'); 
$month=$this->session->userdata('month'); 

//echo 'test';

$query2=("SET lc_time_names = 'tr_TR'");
$result2 = $mysqli->query($query2);

$query="select concat(DanismanAd,' ',DanismanSoyad) as danisman, count(randevuID) as seansSayisi,count(distinct danisanID) as danisanSayisi
from vwrandevu
join vwusers on vwusers.id=vwrandevu.DanismanUserID
where randevuBaslangicTarihSaat > '".$tarih."' and MONTH(randevuBaslangicTarihSaat)='".$month."' and RandevuDurumID=4
group by DanismanUserID
order by vwusers.aktiflik";

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}


//free memory associated with result
$result->close();


//now print the data
print json_encode($data);

}

public function danisman_grafik2 ()
{
        $this->data['page_title'] = 'Danışman Performans Grafikleri';
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->load->library('form_validation');


$month=$this->input->post('aylar');

if($month=='') {  $month=date('m');   } else { $month=$month; }


$date = '2018-'.$month.'-01 00:00:00';

/*
$month= '06';
$date = '2018-06-01 00:00:00';
*/

         $datasessionmevcut = array(                       
                    'date' => $date,
                    'month' =>  $month                                         
                );


$this->load->library('session');
$this->session->set_userdata($datasessionmevcut);
//echo $this->session->userdata('randevuDanismanID'); 
// print_r($datasessionmevcutyaz);
 

 $this->data['before_head'] ="
<script>
 $(document).ready(function(){
    $.ajax({

url: 'http://localhost/multilanguage/admin/raporlar/raporlar/danismangrafik2',
        method: 'GET',
        success: function(data) {
            console.log(data);
            var danisman = [];
            var seansOrtalaması = [];   



            for(var i in data) {


       danisman.push(data[i].danisman);
              
                seansOrtalaması.push(data[i].seansOrtalaması);

           

                
            }

            var chartdata = {
                labels: danisman,
                datasets : [
                    {
                        label: 'Seans Ortalaması',
                        backgroundColor: 'rgba(109, 203, 37, 1)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(109, 203, 37, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: seansOrtalaması
                        
                    }
     

                ]
            };

            var ctx = $('#mycanvas');

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>
";

 $this->render('admin/raporlar/danisman_grafik_view2','admin_master',$this->data); 
}

public function danismangrafik2() {
header('Content-Type: application/json');

//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');


//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("UTF8");
if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

$tarih=$this->session->userdata('date'); 
$month=$this->session->userdata('month'); 


$query2=("SET lc_time_names = 'tr_TR'");
$result2 = $mysqli->query($query2);

$query="select concat(DanismanAd,' ',DanismanSoyad) as danisman, round(count(randevuID)  /count(distinct danisanID),1) as seansOrtalaması
from vwrandevu
join vwusers on vwusers.id=vwrandevu.DanismanUserID
where randevuBaslangicTarihSaat > '".$tarih."' and MONTH(randevuBaslangicTarihSaat)=".$month." and RandevuDurumID=4
group by DanismanUserID
order by vwusers.aktiflik";


/*$query = "
select MONTHname(randevuBaslangicTarihSaat) as ay, 
count(case when RandevuDurumID=4 then 1 end) as randevuyaGeldi,
count(case when RandevuDurumID=5 then 1 end) as iptalRandevu,
count(case when RandevuDurumID=3 then 1 end) as randevuyaGelmedi
from vwrandevu
where RandevuDurumID in(3,4,5) and randevuBaslangicTarihSaat > '2018-05-01 00:00:00'
group by MONTHNAME(randevuBaslangicTarihSaat)
order by month(randevuBaslangicTarihSaat)";
*/
//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}


//free memory associated with result
$result->close();


//now print the data
print json_encode($data);

}





}