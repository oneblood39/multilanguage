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







}