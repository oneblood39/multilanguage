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

    public function index($datas = NULL) ///index sayfası
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


                $data = array(
                  
                    'DanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time')
                                     
                );
                $date = $this->input->post('date');
                $time =$this->input->post('time');
                $danismanID = $this->input->post('danismanID');

   //   echo $this->session->userdata('randevuDanismanID'); 

        $this->render('admin/terapi/danisan/index_view','admin_master',$this->data);
	}


        public function indexrandevuekle($datas = NULL) ///çağrılar index sayfası
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
            "ajax": "'.base_url().'/admin/datatables/randevudanisan_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

                $data = array(
                  
                    'DanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time')
                                     
                );
                $date = $this->input->post('date');
                $time =$this->input->post('time');
                $danismanID = $this->input->post('danismanID');

    //  echo $this->session->userdata('randevuDanismanID'); 

        $this->render('admin/terapi/danisan/index_view','admin_master',$this->data);
    }


      public function create()   /////danisan ekleme sayfası
    {
     
        $this->data['page_title'] = 'Danışan Ekle';
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

        if($this->form_validation->run()===FALSE)
        {
            //$this->data['groups'] = $this->ion_auth->groups()->result();
            $this->load->helper('form');
           // 
        }
        else
        {
        $this->danisan_model->createDanisan($this->input->post());
      //  $this->render('admin/terapi/danisan/create_view');

        }
       $this->render('admin/terapi/danisan/create_view','admin_master',$this->data);

    }


    public function lastcreate ($data=array())    /////danisan ekleme
    {

  $this->danisan_model->createDanisanLast();
   }

   public function danisandetay ()    /////danisan detayı
   {
    $this->data['before_head'] ='<style>
body {font-family: Arial;}

.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 1170px;
    margin-left:-15px;
}

.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
}

.tab button:hover {
    background-color: #ddd;
}

.tab button.active {
    background-color: #ccc;
}

.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
        width: 1170px;
    margin-left:-15px;
}
</style>';


$this->data['before_body'] ='<script type="text/javascript">
       function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
        </script>';
   $this->render('admin/terapi/danisan/detay_view','admin_master',$this->data);
   }
   
  
  public function danisanduzenle ($danisanID=NULL) {
       $this->data['page_title'] = 'Danışan Düzenle';
       $this->load->library('form_validation');
       $danisan = $this->danisan_model->getDanisan((int) $danisanID);

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



      if($this->input->post('ad')){
        $this->data['Ad'] = $this->input->post('ad');
      }else{
        $this->data['Ad'] = $danisan->danisanAd;
      }

      if($this->input->post('soyad')){
        $this->data['Soyad'] = $this->input->post('soyad');
      }else{
        $this->data['Soyad'] = $danisan->danisanSoyad;
      }

      if($this->input->post('eposta')){
        $this->data['Eposta'] = $this->input->post('eposta');
      }else{
        $this->data['Eposta'] = $danisan->danisanEposta;
      }

       if($this->input->post('tel')){
        $this->data['Tel'] = $this->input->post('tel');
      }else{
        $this->data['Tel'] = $danisan->danisanTel;
      }

            if($this->input->post('mizac')){
        $this->data['Mizac'] = $this->input->post('mizac');
      }else{
        $this->data['Mizac'] = $danisan->danisanTestMizacTipID;
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
         $this->danisan_model->danisanupdate($this->input->post());
           }
         
           
            $this->postal->add($this->ion_auth->messages(),'success');
           // redirect('admin/terapi/cagri');
        }
        //////////////////////

      $this->render('admin/terapi/danisan/danisan_edit_view','admin_master',$this->data);  

   }

   public function notekle () {
       $this->data['page_title'] = 'Danışan Notu Ekle';
       $this->load->library('form_validation');
       

   $this->render('admin/terapi/danisan/not_ekle_view','admin_master',$this->data);     
   }

   public function notkaydet () {
   $this->danisan_model->notkaydet($this->input->post());
    }


   public function ilacekle () {
       $this->data['page_title'] = 'İlaç Ekle';
       $this->load->library('form_validation');
   $this->render('admin/terapi/danisan/ilac_ekle_view','admin_master',$this->data);     
   }
  
  public function ilackaydet () {
  $this->danisan_model->ilackaydet($this->input->post());
   }

  public function taniekle () {
       $this->data['page_title'] = 'Tanı Ekle';
       $this->load->library('form_validation');
       $this->data['tanilar'] = $this->danisan_model->gettanilarForDropdown(array("0"," -- "));
   $this->render('admin/terapi/danisan/tani_ekle_view','admin_master',$this->data);     
   }

  public function tanikaydet () {
  $this->danisan_model->tanikaydet($this->input->post());
   }

   public function testekle () {
       $this->data['page_title'] = 'Test Talebinde Bulun';
       $this->load->library('form_validation');

   $this->data['testler'] = $this->danisan_model->gettestlerForDropdown(array());
   $this->render('admin/terapi/danisan/test_ekle_view','admin_master',$this->data);     
   }

  public function testkaydet () {
  $this->danisan_model->testkaydet($this->input->post());
   }

   public function seansnotuduzenle() {
     $this->data['page_title'] = 'Seans Notu Düzenle';
     $this->load->library('form_validation');
   $this->render('admin/terapi/danisan/not_duzenle_view','admin_master',$this->data); 
   }

   public function seansnotguncelle() {
   $this->danisan_model->seansnotguncelle($this->input->post()); 
   }

   public function psikiyatrikilacekle () {
       $this->data['page_title'] = 'Psikiyatrik İlaç Öner';
       $this->load->library('form_validation');
        $this->data['ilac'] = $this->danisan_model->getilaclarForDropdown(array("0"," -- "));
        $this->data['doz'] = $this->danisan_model->getdozlarForDropdown(array("0"," -- "));

   $this->render('admin/terapi/danisan/psikiyatrikilac_ekle_view','admin_master',$this->data);     
   }

   public function psikiyatrikilackaydet () {
   $this->danisan_model->psikiyatrikilackaydet($this->input->post());
   }

   public function psikiyatrikilacduzenle () {
    $this->data['page_title'] = 'Psikiyatrik İlaç Öner';
    $this->load->library('form_validation');

    $this->data['ilac'] = $this->danisan_model->getilaclarForDropdown(array("0"," -- "));
    $this->data['doz'] = $this->danisan_model->getdozlarForDropdown(array("0"," -- "));
   
   $this->render('admin/terapi/danisan/psikiyatrikilac_duzenle_view','admin_master',$this->data);
   }
   
   public function psikiyatrikilacguncelle () {
    $this->danisan_model->psikiyatrikilacguncelle($this->input->post());
   }

   public function digerilacduzenle () {
    $this->data['page_title'] = 'Diğer İlaç Düzenle';
    $this->load->library('form_validation');

    $this->render('admin/terapi/danisan/digerilac_duzenle_view','admin_master',$this->data);
   }

   public function ilacguncelle () {
    $this->danisan_model->ilacguncelle($this->input->post());
   }

   public function kendidanisanlarim($datas = NULL) 
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
            "ajax": "'.base_url().'/admin/datatables/kendidanisanlarim_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/danisan/danisanlarim_view','admin_master',$this->data);
  }

}