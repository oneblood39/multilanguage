<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Randevu extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/randevu/Randevu_model');
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
  
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.1.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




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
<script>
$(document).ready(function () {

    $("#btn").click(function () {
        var c = confirm("Uyarı! Bu randevuyu iptal etmek istediğinize emin misiniz?");
        if (c == true) {
        return true;
        } else {
        return false;
        }
    });
});

</script>

';

     $this->data['users'] = $this->ion_auth->users(array())->result();
     $user_id=$this->ion_auth->user()->row()->id;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;

    // echo '<br><br><br>';
    // echo $group_id;
   }

  if ($group_id=='11' or $group_id=='9') {
    $this->render('admin/terapi/randevu/index_view','admin_master',$this->data); 
   }

   else {
     $this->render('admin/terapi/randevu/danisman_index_view','admin_master',$this->data);
   }


        
       

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
        $this->form_validation->set_rules('soyad','Soyad','trim|required');
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
//echo $time;

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
//echo $this->session->userdata('randevuDanismanID'); 

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
        $this->data['ofisler'] = $this->Randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->Randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->Randevu_model->getRandevuDurumForDropdown(array());
        $this->data['odalar'] = $this->Randevu_model->getOdalarForDropdown(array("0"," -- "),$ofisID);
 
  $this->Randevu_model->createRandevuStep1($this->input->post(),$data);
  $this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$data,$ofisID,$this->input->post());
}

public function randevuekle_step2 (){
        $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->load->library('session');


       $danisman_id=$this->session->userdata('randevuDanismanID');
        //$ofis = $this->randevu_model->getOfis((int) $ofisID);
       
      //  $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->data['ofisler'] = $this->Randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->Randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->Randevu_model->getRandevuDurumForDropdown(array());

$danisan_id= $this->uri->segment(6); 
if ($danisan_id!='') {
 //echo $danisan_id; 

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
} else {  
 $this->Randevu_model->createRandevuStep2($this->input->post());
}
//$this->randevu_model->createRandevuStep2($this->input->post());
 // $this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$data,$ofisID);

}

public function randevuekle_step3 (){
         // $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->load->library('session');
        $ofisID=$this->ion_auth->user()->row()->company;

       $danisman_id=$this->session->userdata('randevuDanismanID');
       $danisan_id= $this->uri->segment(5);
      // $company=$user->company;

        $this->data['ofisler'] = $this->Randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->Randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->Randevu_model->getRandevuDurumForDropdown(array());
        $this->data['odalar'] = $this->Randevu_model->getOdalarForDropdown(array("0"," -- "),$ofisID);

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



$this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$danisan_id);
}



public function yinedekaydet (){      
$this->Randevu_model->yinedekaydet($this->input->post());
//$this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data);
}




public function randevuekle_step4 (){
$this->load->library('session');
$this->Randevu_model->createRandevuStep2($this->input->post());
  }

public function randevuiptal (){  
$this->Randevu_model->randevuiptalet($this->input->post());
  }

public function randevudurumudegistir (){
  
$this->Randevu_model->randevudurumudegistir($this->input->post());
  }

 public function randevuinfodegistir (){  
$this->Randevu_model->randevuinfodegistir($this->input->post());
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
$this->Randevu_model->randevuertelekaydet();
}

public function randevuyinedeekle(){
  $this->Randevu_model->randevuyinedeekle();
}

public function mazeretler (){

      $this->data['page_title'] = 'Mazeret Listele';
      $this->data['users'] = $this->ion_auth->users(array())->result();
      $this->data['before_head'] = '';

      $this->data['before_body'] ='<script type="text/javascript">

         $(document).ready(function(){
          $("#randevuListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/mazeretler_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });     
        </script>
        ';

        $this->render('admin/terapi/randevu/mazeretlistele_view','admin_master',$this->data);

}

public function mazeretekle(){

        $this->data['page_title'] = 'Mazeret Ekle';
        $this->load->library('form_validation');
        $this->load->library('session');
        $ofisID=$this->ion_auth->user()->row()->company;



    $this->data['danismanlar'] = $this->Randevu_model->getDanismanlarForDropdown(array("0"," -- "),$ofisID);
    $this->data['mazeretler'] = $this->Randevu_model->getMazeretlerForDropdown(array("0"," -- "));       

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
<script type="text/javascript" src="../../../assets/admin/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../../assets/admin/bootstrap/js/bootstrap.min.js"></script>
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



$this->render('admin/terapi/randevu/mazeret_ekle_view','admin_master',$this->data);
}

public function mazeretkaydet () {
$this->Randevu_model->mazeretkaydet();  
}

public function mazeretdurumdegistir () {
$this->Randevu_model->mazeretdurumdegistir();
}

  public function valid_email($email)
  {
    if (function_exists('idn_to_ascii') && defined('INTL_IDNA_VARIANT_UTS46') && $atpos = strpos($email, '@'))
    {
      $email = self::substr($email, 0, ++$atpos).idn_to_ascii(self::substr($email, $atpos), 0, INTL_IDNA_VARIANT_UTS46);
    }

    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
  }



     public function ayliktakvim($randevuID = NULL) ///roller index sayfası
    {
        $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->data['before_head'] ='<script type="text/javascript">
  
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.1.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




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
<script>
$(document).ready(function () {

    $("#btn").click(function () {
        var c = confirm("Uyarı! Bu randevuyu iptal etmek istediğinize emin misiniz?");
        if (c == true) {
        return true;
        } else {
        return false;
        }
    });
});

</script>

';

     $this->data['users'] = $this->ion_auth->users(array())->result();
     $user_id=$this->ion_auth->user()->row()->id;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;

    // echo '<br><br><br>';
    // echo $group_id;
   }


    $this->render('admin/terapi/randevu/aylik_takvim_view','admin_master',$this->data); 
}


public function mailtest () {

$this->load->library('email');
 echo $this->email->valid_email('birkan@gmail.com') ? 'yes' : 'no';

$this->email->from('birkan@gmail.com', 'Birkan Yanar');
$this->email->to('birkan@mizmer.com.tr');
$this->email->cc('mustafa@mizmer.com.tr');
//$this->email->bcc('them@their-example.com');

$this->email->subject('Email Test');
$this->email->message('Test yapıorum.');

$this->email->send();

}


}