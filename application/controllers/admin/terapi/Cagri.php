<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cagri extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
       // $this->load->model('groups/groups_model');
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









}