<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Danisan extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/danisan/danisan_model');
       /* if(!$this->ion_auth->in_group('admin','member'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index($datas = NULL) ///çağrılar index sayfası
    {
        $this->data['page_title'] = 'Danişan Takip';
         $this->load->library('session');
        $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#danisanListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/danisan_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

echo "<br><br><br><br>";

                $data = array(
                  
                    'DanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time')
                                     
                );
                $date = $this->input->post('date');
                $time =$this->input->post('time');
                $danismanID = $this->input->post('danismanID');
                //print_r($data);

                //echo $date.'  '.$time.' '.$danismanID;
    /*   $datasessionmevcut = $this->session->flashdata('item'); 

      print_r($datasessionmevcut);*/
      //$this->session->set_userdata('item', $datasessionmevcut);
//$datasessionmevcutyaz = $this->session->userdata('item'); 

//print_r($datasessionmevcutyaz);
      echo $this->session->userdata('randevuDanismanID'); 

        $this->render('admin/terapi/danisan/index_view','admin_master',$this->data);
	}

      public function create()   /////danisan ekleme sayfası
    {
     
        $this->data['page_title'] = 'Danışan Ekle';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ad','Ad','trim|required');
        $this->form_validation->set_rules('soyad','Soyad','trim');
        $this->form_validation->set_rules('tel','Tel','trim');
        $this->form_validation->set_rules('eposta','Eposta','trim|required|valid_email');
        $this->form_validation->set_rules('mizac','Mizac','trim');

        if($this->form_validation->run()===FALSE)
        {
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->load->helper('form');
            $this->render('admin/terapi/danisan/create_view');
        }
        else
        {



   /*
            $ad = $this->input->post('ad');
            $soyad = $this->input->post('soyad');
            $tel = $this->input->post('tel');
            $eposta = $this->input->post('eposta');
            $mizac = $this->input->post('mizac');
           /* $additional_data = array(
                'first_name' => $this->input->post('mizac')

            );
            $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
            $this->postal->add($this->ion_auth->messages(),'success'); ///diğer durumda $data eklenecek...*/
           // redirect('admin/terapi/danisan');

        $this->danisan_model->createDanisan($this->input->post());
        $this->render('admin/terapi/danisan/create_view');

        }


    }


    public function lastcreate ($data=array())    /////danisan ekleme
    {

  $this->danisan_model->createDanisanLast();
   }




}