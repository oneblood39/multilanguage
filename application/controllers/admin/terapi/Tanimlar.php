<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanimlar extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/tanimlar/tanimlar_model');
      /*  if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index() 
    {
       $this->data['page_title'] = 'Tanımlar';
       $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#productsListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/ilac_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/tanimlar/tanimlar_index_view','admin_master',$this->data);
  }
      
      public function ilacekle() 
    {
       $this->data['page_title'] = 'Tanımlar';
       $this->load->library('form_validation');
       $this->data['users'] = $this->ion_auth->users(array())->result();

     $this->render('admin/terapi/tanimlar/ilac_ekle_view','admin_master',$this->data);
    }

   public function ilackaydet() {
   $this->tanimlar_model->ilackaydet($this->input->post());
   }

 


}