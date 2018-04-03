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

    public function index() ///roller index sayfası
    {
        $this->data['page_title'] = 'Randevular';
        $this->load->library('form_validation');
        $this->data['before_head'] ='<script type="text/javascript">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
 
        </script>';

        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/terapi/randevu/index_view','admin_master',$this->data);
	}

      public function randevulistele() ///randevu listeleme datatable
    {
        $this->data['page_title'] = 'Randevu Listele';
        $this->data['users'] = $this->ion_auth->users(array())->result();

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
        </script>';

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
        //$ofis = $this->randevu_model->getOfis((int) $ofisID);
        
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->data['ofisler'] = $this->randevu_model->getOfficesForDropdown(array("0"," -- "));
        $this->data['terapiler'] = $this->randevu_model->getTerapiForDropdown(array("0"," -- "),$danisman_id);
        $this->data['randevudurum'] = $this->randevu_model->getRandevuDurumForDropdown(array());
 
  $this->randevu_model->createRandevuStep1($this->input->post(),$data);
  $this->render('admin/terapi/randevu/create_view_2','admin_master',$this->data,$data,$ofisID);
}







}