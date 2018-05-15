<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seans extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/seans/seans_model');
      /*  if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index() ///çağrılar index sayfası
    {
        $this->data['page_title'] = 'Seans Takip';
        $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#seansListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/seans_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/seans/index_view','admin_master',$this->data);
	}

      public function paketdanisan() ///paket için bir danışan seçme
    {
        $this->data['page_title'] = 'Seans Takip';
        $this->data['users'] = $this->ion_auth->users(array())->result();

              

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#seansListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/paketdanisan_dt/getall/",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';


$paket_id= $this->uri->segment(5);
$datasession = array(
 'paket' => $paket_id

);
$this->load->library('session');
$this->session->set_userdata($datasession);

/*echo '<br><br><br>';
echo $this->session->userdata('paket');*/

        $this->render('admin/terapi/seans/paket_danisan_view','admin_master',$this->data);
  }

  public function paketata() ///danışana paket atama
    {
    $this->data['page_title'] = 'Paket Atama';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad','Ad','trim|required');
    $this->form_validation->set_rules('soyad','Soyad','trim');
    $this->data['users'] = $this->ion_auth->users(array())->result();
    $this->data['before_head'] = '<link href="../../../../../assets/admin/css/multiselect.css" media="screen" rel="stylesheet" type="text/css"> 
    <script type="text/javascript">$("#my-select").multiSelect();</script>';
    $this->data['before_body'] ='

  <!-- Bootstrap JavaScript -->
 
  <script src="../../../../../assets/admin/js/jquery.multi-select.js" type="text/javascript"></script>
  <script type="text/javascript">
  // run callbacks
      $(\'#callbacks\').multiSelect({
      afterSelect: function(values){
      <!--  alert("Select value: "+values); -->
      },
      afterDeselect: function(values){
       <!-- alert("Deselect value: "+values);  -->
      }
    });
  </script>
    ';

   /* $this->data['yakinlik'] = $this->cagri_model->getcagriyakinlikForDropdown(array());
    $this->data['yonlenme'] = $this->cagri_model->getcagriyonlenmeForDropdown(array());
    $this->data['neden'] = $this->cagri_model->getcagrinedenForDropdown(array());*/

   $this->render('admin/terapi/seans/pakete_randevu_ekle_view','admin_master',$this->data);
  }

  public function paketrandevukaydet() ///danışana paket atama
    {
  $this->seans_model->paketrandevukaydet($this->input->post());
   }

  public function paketekle() ///paket ekleme
    {
  
     
        $this->data['page_title'] = 'Paket Ekle';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('paketno','Paket No','trim|required');
        $this->form_validation->set_rules('paket_adi','Paket Adı','trim');
        $this->form_validation->set_rules('ucret','Ücret','trim');
        $this->form_validation->set_rules('seans_sayisi','Toplam Seans Sayısı','trim');
        $this->form_validation->set_rules('min_seans','1 Ay İçinde Bitirilmesi Gereken Min. Seans Sayısı','trim|numeric|required');

        $this->data['terapiler'] = $this->seans_model->getTerapiForDropdown(array("0"," -- "));
  
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->load->helper('form');
            $this->render('admin/terapi/seans/create_view');
      

   }

  public function paketkaydet() {
  $this->seans_model->paketkaydet($this->input->post());
  }

  public function randevucikar () {
        $this->data['page_title'] = 'Paketteki Danışanlar';
        $this->data['users'] = $this->ion_auth->users(array())->result();

        $paket_id=$this->uri->segment(5);
//echo '<br><br><br>';
  //           echo $paket_id;

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#seansListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
             "ajax": "'.base_url().'/admin/datatables/paketteki_danisanlar_dt/getall/'.$paket_id.'",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/seans/paket_danisan_view','admin_master',$this->data);

  }

 public function pakettenrandevucikar()  {
    $this->data['page_title'] = 'Paketten Randevu Çıkar';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad','Ad','trim|required');
    $this->form_validation->set_rules('soyad','Soyad','trim');
    $this->data['users'] = $this->ion_auth->users(array())->result();
    $this->data['before_head'] = '<link href="../../../../../assets/admin/css/multiselect.css" media="screen" rel="stylesheet" type="text/css"> 
    <script type="text/javascript">$("#my-select").multiSelect();</script>';
    $this->data['before_body'] ='

  <!-- Bootstrap JavaScript -->
 
  <script src="../../../../../assets/admin/js/jquery.multi-select.js" type="text/javascript"></script>
  <script type="text/javascript">
  // run callbacks
      $(\'#callbacks\').multiSelect({
      afterSelect: function(values){
      <!--  alert("Select value: "+values); -->
      },
      afterDeselect: function(values){
       <!-- alert("Deselect value: "+values);  -->
      }
    });
  </script>
    ';

   $this->render('admin/terapi/seans/paketten_randevu_cikar_view','admin_master',$this->data);

    }

    public function pakettenrandevusil()  {
     $this->seans_model->paketrandevusil($this->input->post());
     }


}