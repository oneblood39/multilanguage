<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Randevu extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/randevu/randevu_model');
      /*  if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index($randevuID = NULL) ///roller index sayfası
    {
        $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();

/* Turkish initialisation for the jQuery UI date picker plugin. */
/* Written by Izzet Emre Erkan (kara@karalamalar.net). */
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
<style>

.couponcode:hover .coupontooltip {
    display: block;

}

.test {
    display: block;

}
.coupontooltip {
    display: none;
    background: #C8C8C8;
    margin-left: -200px;
    margin-top: -150px;
    padding: 10px;
    position: inherit;
    z-index: 100000; !important;
    width:150px;
    height:60px;

}

.couponcode:hover .coupontooltiprandevu {
    display: block;

}

.test {
    display: block;

}
.coupontooltiprandevu {
    display: none;
    background: #C8C8C8;
    margin-left: 0px;
    margin-top: 0px;
    padding: 10px;
    position: inherit;
    z-index: 100000; !important;
    width:250px;
    height:130px;

}
</style>


<script>var tooltip = document.querySelectorAll(\'.coupontooltip\');

document.addEventListener(\'mousemove\', fn, false);

function fn(e) {
    for (var i=tooltip.length; i--;) {
        tooltip[i].style.left = e.pageX + \'300px\';
        tooltip[i].style.top = e.pageY + \'300px\';
    }
}</script>

///////////////////////////////////////////////////////
 <script>
  $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  } );
  </script>
  ///////////////////////
<script>

$(\'.autoSubmit, .autoSubmit select, .autoSubmit input, .autoSubmit textarea\').change(function () {
    const el = $(this);
    let form;

    if (el.is(\'form\')) { form = el; }
    else { form = el.closest(\'form\'); }

    form.submit();
});

</script>




        ';


        $this->data['before_body'] ='<script type="text/javascript">
var tooltip = document.querySelectorAll(\'.coupontooltip\');

document.addEventListener(\'mousemove\', fn, false);

function fn(e) {
    for (var i=tooltip.length; i--;) {
        tooltip[i].style.left = e.pageX + \'500px\';
        tooltip[i].style.top = e.pageY + \'500px\';
    }
}
</script>

<script>

$(\'.autoSubmit, .autoSubmit select, .autoSubmit input, .autoSubmit textarea\').change(function () {
    const el = $(this);
    let form;

    if (el.is(\'form\')) { form = el; }
    else { form = el.closest(\'form\'); }

    form.submit();
});
</script>



';

        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/terapi/randevu/index_view','admin_master',$this->data);
	}

      public function randevulistele() ///randevu listeleme datatable
    {
        $this->data['page_title'] = 'Randevu Listele';
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->data['before_head'] = '
    

';

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#randevuListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/randevu_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>


        ';

        $this->render('admin/terapi/randevu/randevulistele_view','admin_master',$this->data);
  }

public function randevuekle (){ //randevu ekleme ilk sayfa

        $this->data['page_title'] = 'Randevu Ekle';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ad','Ad','trim|required');
        $this->form_validation->set_rules('soyad','Soyad','trim');
$this->data['before_head'] ='
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "input" ).checkboxradio();
    $( "fieldset" ).controlgroup();
  } );
  </script>';
$this->data['before_head'] =' 
<script>
$(document).ready(function(){
    $("#birkan").click(function(){
        $("#form1").toggle();
    });
});
</script>
  ';
 $this->data['before_body'] =' 
<script>
$(document).ready(function(){
    $("#birkan").click(function(){
        $("#form1").toggle();
    });
});
</script>
  ';


$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7); 
$ofis= $this->uri->segment(8); 

echo "<br><br><br><br>";

         $sqlkontrol = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$date."%') and (DanismanUserID='".$danisman_id."') and (ofisID!='".$ofis."') and (randevuDurumID!='5')"; 
         $sayikontrol= $this->db->query($sqlkontrol)->num_rows();////

         if($sayikontrol>0) {
         $this->postal->add('Aynı gün içinde sadece bir merkezde randevu eklenebilir!','error');
         redirect('admin/terapi/randevu/','refresh'); }


         //$resultrenk = $this->db->query($sqlrenk)->result();



//echo $date;

 $datasessionmevcut = array(
                    'randevuDanismanID' => $danisman_id,                  
                    'date' => $date,
                    'time' => $time                                    
                );

$this->load->library('session');
$this->session->set_userdata($datasessionmevcut);
echo $this->session->userdata('randevuDanismanID'); 

// print_r($datasessionmevcutyaz);

        $this->render('admin/terapi/randevu/create_view_1','admin_master',$this->data);
  }

public function randevuekle_step1 ($data, $ofisID){
        $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../../../../../../assets/admin/js/selectchained.js" type="text/javascript"></script>

';


        $this->data['before_body'] =' <script>


        </script>';

        $danisman_id= $this->uri->segment(6); 
        $ofisID=$this->ion_auth->user()->row()->company;
        //$ofis = $this->randevu_model->getOfis((int) $ofisID);
        
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->data['ofisler'] = $this->randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->randevu_model->getRandevuDurumForDropdown(array());
        $this->data['odalar'] = $this->randevu_model->getOdalarForDropdown(array("0"," -- "),$ofisID);
 
  $this->randevu_model->createRandevuStep1($this->input->post(),$data);
  $this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$data,$ofisID,$this->input->post());
}

public function randevuekle_step2 (){
        $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->load->library('session');


       $danisman_id=$this->session->userdata('randevuDanismanID');
        //$ofis = $this->randevu_model->getOfis((int) $ofisID);
       
      //  $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->data['ofisler'] = $this->randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->randevu_model->getRandevuDurumForDropdown(array());

$danisan_id= $this->uri->segment(6); 
if ($danisan_id!='') {
 echo $danisan_id; 

  $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../../../../../../assets/admin/js/selectchained.js" type="text/javascript"></script>
';


echo "<br><br><br><br>";
echo "burda";
       //$datasessionmevcut = $this->session->flashdata('item'); 
 /*     
echo $this->session->userdata('randevuDanismanID');
echo "<br>";
echo $this->session->userdata('date');
echo "<br>";
echo $this->session->userdata('time'); 
*/
//$this->randevu_model->createRandevuStep2($this->input->post());

  //$this->randevu_model->createRandevuStep2($this->input->post());
  //$this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$this->input->post());






      //print_r($datasessionmevcut);

$this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data);
} else {  
 $this->randevu_model->createRandevuStep2($this->input->post());
}
//$this->randevu_model->createRandevuStep2($this->input->post());
 // $this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$data,$ofisID);

}

public function randevuekle_step3 (){
          $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->load->library('session');
        $ofisID=$this->ion_auth->user()->row()->company;

       $danisman_id=$this->session->userdata('randevuDanismanID');
      // $company=$user->company;

        $this->data['ofisler'] = $this->randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->randevu_model->getRandevuDurumForDropdown(array());
        $this->data['odalar'] = $this->randevu_model->getOdalarForDropdown(array("0"," -- "),$ofisID);

         $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../../../../../../assets/admin/js/selectchained.js" type="text/javascript"></script>
';



$this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data);
}

public function randevuekle_step4 (){
$this->load->library('session');
$this->randevu_model->createRandevuStep2($this->input->post());
  }

public function randevuiptal (){  
$this->randevu_model->randevuiptalet($this->input->post());
  }

public function randevudurumudegistir (){
  
$this->randevu_model->randevudurumudegistir($this->input->post());
  }

 public function randevuinfodegistir (){  
$this->randevu_model->randevuinfodegistir($this->input->post());
  } 

public function pakettekirandevular (){  

 $this->data['page_title'] = 'Randevu Listele';
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->data['before_head'] = '
';

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#randevuListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/randevupaket_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>


        ';

        $this->render('admin/terapi/randevu/randevulistele_view','admin_master',$this->data);
  } 


  public function randevuertele (){

$this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();

/* Turkish initialisation for the jQuery UI date picker plugin. */
/* Written by Izzet Emre Erkan (kara@karalamalar.net). */
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
<style>

.couponcode:hover .coupontooltip {
    display: block;

}

.test {
    display: block;

}
.coupontooltip {
    display: none;
    background: #C8C8C8;
    margin-left: -200px;
    margin-top: -150px;
    padding: 10px;
    position: inherit;
    z-index: 100000; !important;
    width:150px;
    height:60px;

}

.couponcode:hover .coupontooltiprandevu {
    display: block;

}

.test {
    display: block;

}
.coupontooltiprandevu {
    display: none;
    background: #C8C8C8;
    margin-left: 0px;
    margin-top: 0px;
    padding: 10px;
    position: inherit;
    z-index: 100000; !important;
    width:250px;
    height:130px;

}
</style>


<script>var tooltip = document.querySelectorAll(\'.coupontooltip\');

document.addEventListener(\'mousemove\', fn, false);

function fn(e) {
    for (var i=tooltip.length; i--;) {
        tooltip[i].style.left = e.pageX + \'300px\';
        tooltip[i].style.top = e.pageY + \'300px\';
    }
}</script>

///////////////////////////////////////////////////////
 <script>
  $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  } );
  </script>
  ///////////////////////
<script>

$(\'.autoSubmit, .autoSubmit select, .autoSubmit input, .autoSubmit textarea\').change(function () {
    const el = $(this);
    let form;

    if (el.is(\'form\')) { form = el; }
    else { form = el.closest(\'form\'); }

    form.submit();
});

</script>




        ';


        $this->data['before_body'] ='<script type="text/javascript">
var tooltip = document.querySelectorAll(\'.coupontooltip\');

document.addEventListener(\'mousemove\', fn, false);

function fn(e) {
    for (var i=tooltip.length; i--;) {
        tooltip[i].style.left = e.pageX + \'500px\';
        tooltip[i].style.top = e.pageY + \'500px\';
    }
}
</script>

<script>

$(\'.autoSubmit, .autoSubmit select, .autoSubmit input, .autoSubmit textarea\').change(function () {
    const el = $(this);
    let form;

    if (el.is(\'form\')) { form = el; }
    else { form = el.closest(\'form\'); }

    form.submit();
});
</script>



';

        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/terapi/randevu/ertele_view','admin_master',$this->data);


}

public function randevuerteleson(){
$this->randevu_model->randevuertelekaydet();
}


}