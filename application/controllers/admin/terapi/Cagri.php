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

        $this->form_validation->set_rules('ad','Ad','required');
        $this->form_validation->set_rules('soyad','Soyad','trim|required');
        $this->form_validation->set_rules('tel','Tel','trim|numeric|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('eposta','E-Posta','trim|valid_email');
        $this->form_validation->set_error_delimiters('<br><b><font color="#FF0000">', '</font></b>');
        $this->form_validation->set_message('required', 'Bu alanı doldurmak zorundasınız!');
        $this->form_validation->set_message('min_length', 'Bu alan minimum 10 karakter olmalı!');
        $this->form_validation->set_message('max_length', 'Bu alan maximum 10 karakter olmalı!');
        $this->form_validation->set_message('valid_email', 'Geçerli bir eposta adresi değil!');
        $this->form_validation->set_message('numeric', 'Bu alan sayılardan oluşmalı!');

    $this->data['yakinlik'] = $this->cagri_model->getcagriyakinlikForDropdown(array());
    $this->data['yonlenme'] = $this->cagri_model->getcagriyonlenmeForDropdown(array());
    $this->data['neden'] = $this->cagri_model->getcagrinedenForDropdown(array());
 
     if($this->form_validation->run()===FALSE)
        {           
           $this->load->helper('form');            
        }
        else
        {
        $this->cagri_model->bireyselcagrikaydet($this->input->post());
        $this->render('admin/terapi/danisan/create_view');

        }
 
   $this->render('admin/terapi/cagri/bireysel_view','admin_master',$this->data);

  }

/*
  public function bireyselcagrikaydet() {
  $this->cagri_model->bireyselcagrikaydet($this->input->post());
  }
*/
 public function kurumsal() {
    $this->data['page_title'] = 'Çağrı Ekle';
    $this->load->library('form_validation');

        $this->form_validation->set_rules('kurum','Çağrı Yapan Kurum','required');
        $this->form_validation->set_rules('ad','Ad','required');
        $this->form_validation->set_rules('soyad','Soyad','trim|required');
        $this->form_validation->set_rules('tel','Tel','trim|numeric|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('eposta','E-Posta','trim|valid_email');
        $this->form_validation->set_error_delimiters('<br><b><font color="#FF0000">', '</font></b>');
        $this->form_validation->set_message('required', 'Bu alanı doldurmak zorundasınız!');
        $this->form_validation->set_message('min_length', 'Bu alan minimum 10 karakter olmalı!');
        $this->form_validation->set_message('max_length', 'Bu alan maximum 10 karakter olmalı!');
        $this->form_validation->set_message('valid_email', 'Geçerli bir eposta adresi değil!');
        $this->form_validation->set_message('numeric', 'Bu alan sayılardan oluşmalı!');


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

   if($this->form_validation->run()===FALSE)
        {           
           $this->load->helper('form');            
        }
        else
        {
        $this->cagri_model->kurumsalcagrikaydet($this->input->post());
       // $this->render('admin/terapi/cagri/kurumsal_view');

        }



   $this->render('admin/terapi/cagri/kurumsal_view','admin_master',$this->data);

  }



/*
  public function kurumsalcagrikaydet() {
  $this->cagri_model->kurumsalcagrikaydet($this->input->post());
  }
*/

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

    public function randevueslestir() ///çağrıdan randevuya geçiş
  {
      $this->data['page_title'] = 'Randevu Listele';
        $this->data['users'] = $this->ion_auth->users(array())->result();

         $cagri_id=$this->uri->segment(5);
//echo '<br><br><br><br>';
        // echo $cagri_id;

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#randevuListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/randevueslestir_dt/getall/'.$cagri_id.'",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/cagri/randevulistele_view','admin_master',$this->data);
 }

    public function cagrieslestir() ////cagriya randevu atıyoruzzz
  {
   $this->cagri_model->cagriyarandevuata($this->input->post());
  }


    public function devamedencagrilar() ///çağrılar index sayfası
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
            "ajax": "'.base_url().'/admin/datatables/devamedencagri_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';
        $this->render('admin/terapi/cagri/kurumsal_index_view','admin_master',$this->data);
  }

  public function bireyselcagriduzenle($cagriID=NULL) {
       $this->data['page_title'] = 'Çağrı Düzenle';
       $this->load->library('form_validation');
       $cagri = $this->cagri_model->getCagri((int) $cagriID);

        $this->form_validation->set_rules('ad','Çağrı Yapan Ad','required');
        $this->form_validation->set_rules('soyad','Çağrı Yapan Soyad','trim|required');
        $this->form_validation->set_rules('tel','Çağrı Yapan Tel','trim|numeric|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('eposta','Çağrı Yapan E-Posta','trim|valid_email');
        $this->form_validation->set_error_delimiters('<br><b><font color="#FF0000">', '</font></b>');
        $this->form_validation->set_message('required', 'Bu alanı doldurmak zorundasınız!');
        $this->form_validation->set_message('min_length', 'Bu alan minimum 10 karakter olmalı!');
        $this->form_validation->set_message('max_length', 'Bu alan maximum 10 karakter olmalı!');
        $this->form_validation->set_message('valid_email', 'Geçerli bir eposta adresi değil!');
        $this->form_validation->set_message('numeric', 'Bu alan sayılardan oluşmalı!');

       $this->data['yakinlik'] = $this->cagri_model->getcagriyakinlikForDropdown(array());
       $this->data['yonlenme'] = $this->cagri_model->getcagriyonlenmeForDropdown(array());
       $this->data['neden'] = $this->cagri_model->getcagrinedenForDropdown(array());


      if($this->input->post('ad')){
        $this->data['Ad'] = $this->input->post('ad');
      }else{
        $this->data['Ad'] = $cagri->cagriYapanAd;
      }

      if($this->input->post('soyad')){
        $this->data['Soyad'] = $this->input->post('soyad');
      }else{
        $this->data['Soyad'] = $cagri->cagriYapanSoyad;
      }

      if($this->input->post('cad')){
        $this->data['Cad'] = $this->input->post('cad');
      }else{
        $this->data['Cad'] = $cagri->cagriYapilanAd;
      }

      if($this->input->post('csoyad')){
        $this->data['Csoyad'] = $this->input->post('csoyad');
      }else{
        $this->data['Csoyad'] = $cagri->cagriYapilanSoyad;
      }

      if($this->input->post('tel')){
        $this->data['Tel'] = $this->input->post('tel');
      }else{
        $this->data['Tel'] = $cagri->cagriYapanTel;
      }

      if($this->input->post('eposta')){
        $this->data['Eposta'] = $this->input->post('eposta');
      }else{
        $this->data['Eposta'] = $cagri->cagriYapanEposta;
      }

     if($this->input->post('cagriyakinlik')){
        $this->data['Cagriyakinlik'] = $this->input->post('cagriyakinlik');
      }else{
        $this->data['Cagriyakinlik'] = $cagri->cagriYakinlikID;
      }

      if($this->input->post('cagriyonlenme')){
        $this->data['Cagriyonlenme'] = $this->input->post('cagriyonlenme');
      }else{
        $this->data['Cagriyonlenme'] = $cagri->cagriYonlenmeID;
      }

      if($this->input->post('cagrineden')){
        $this->data['Nedeni'] = $this->input->post('cagrineden');
      }else{
        $this->data['Nedeni'] = $cagri->cagriNedeniID;
      }
       
      if($this->input->post('info')){
        $this->data['Info'] = $this->input->post('info');
      }else{
        $this->data['Info'] = $cagri->cagriAciklama;
      }


        //////////////////////form validation script
         if($this->form_validation->run() === FALSE)
        {
            $this->load->helper('form');
          //  $this->render('admin/terapi/cagri/bireysel_edit_view');
        }
        else
        {

                if($this->input->post()){
         $this->cagri_model->bireyselcagriupdate($this->input->post());
           }
         
           
            $this->postal->add($this->ion_auth->messages(),'success');
           // redirect('admin/terapi/cagri');
        }
        //////////////////////

       $this->render('admin/terapi/cagri/bireysel_edit_view','admin_master',$this->data);  
  }



}