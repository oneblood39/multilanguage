<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cagri extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/cagri/cagri_model');
      /*  if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index() ///çağrılar index sayfası
    {
        $this->data['page_title'] = 'Çağrı Takip';
        $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#productsListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/cagri_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/cagri/index_view','admin_master',$this->data);
	}


  public function cagriekle() {
    $this->data['page_title'] = 'Çağrı Takip';
    $this->data['users'] = $this->ion_auth->users(array())->result();

 $this->render('admin/terapi/cagri/create_view_1');

  }

 public function bireysel() {
    $this->data['page_title'] = 'Çağrı Ekle';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad','Ad','trim|required');
    $this->form_validation->set_rules('soyad','Soyad','trim');
    $this->data['users'] = $this->ion_auth->users(array())->result();

    $this->data['yakinlik'] = $this->cagri_model->getcagriyakinlikForDropdown(array());
    $this->data['yonlenme'] = $this->cagri_model->getcagriyonlenmeForDropdown(array());
    $this->data['neden'] = $this->cagri_model->getcagrinedenForDropdown(array());

 $this->render('admin/terapi/cagri/bireysel_view','admin_master',$this->data);

  }


  public function bireyselcagrikaydet() {
  $this->cagri_model->bireyselcagrikaydet($this->input->post());
  }

 public function kurumsal() {
    $this->data['page_title'] = 'Çağrı Ekle';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad','Ad','trim|required');
    $this->form_validation->set_rules('soyad','Soyad','trim');
    $this->data['users'] = $this->ion_auth->users(array())->result();
    $this->data['before_head'] = '<link href="../../../assets/admin/css/multiselect.css" media="screen" rel="stylesheet" type="text/css"> 
    <script type="text/javascript">$("#my-select").multiSelect();</script>';
    $this->data['before_body'] ='

  <!-- Bootstrap JavaScript -->
 
  <script src="../../../assets/admin/js/jquery.multi-select.js" type="text/javascript"></script>
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

    $this->data['yakinlik'] = $this->cagri_model->getcagriyakinlikForDropdown(array());
    $this->data['yonlenme'] = $this->cagri_model->getcagriyonlenmeForDropdown(array());
    $this->data['neden'] = $this->cagri_model->getcagrinedenForDropdown(array());

   $this->render('admin/terapi/cagri/kurumsal_view','admin_master',$this->data);

  }




  public function kurumsalcagrikaydet() {
  $this->cagri_model->kurumsalcagrikaydet($this->input->post());
  }


  public function kurumsalcagri() ///çağrılar index sayfası
  {
      $this->data['page_title'] = 'Çağrı Takip';
      $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#kurumsalcagriListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/kurumsalcagri_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';
        $this->render('admin/terapi/cagri/kurumsal_index_view','admin_master',$this->data);
  }



}