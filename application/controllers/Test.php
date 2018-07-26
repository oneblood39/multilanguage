<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()///test sayfası birşey deneyeceğim zaman burda çalışıyorum!
    {
       // echo 'testpage';
        $this->data['page_title'] = 'Form1';
       //  $this->load->library('form_validation');
       // $this->data['users'] = $this->ion_auth->users(array())->result();

      $this->render('formlar/form1_view','admin_master',$this->data); 
    }
}