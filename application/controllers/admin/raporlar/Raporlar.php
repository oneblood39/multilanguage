<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raporlar extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('raporlar/raporlar_model');
      /*  if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index() 
    {
        $this->data['page_title'] = 'Raporlar';
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/raporlar/index_view','admin_master',$this->data);
	  }

    public function randevu_raporlar() 
    {
        $this->data['page_title'] = 'Randevu Raporları';
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/raporlar/randevu_raporlar_view','admin_master',$this->data);
    }

     public function ankara_gunluk_randevu() 
    {

  // $this->load->library('excel');    
/*     $this->raporlar_model->ankara_gunluk_randevu(array());
    }

 function exportExcel($filename='ExportExcel',$columns=array(),$data=array(),$replaceDotCol=array()){
    header('Content-Encoding: UTF-8');
    header('Content-Type: text/plain; charset=utf-8'); 
    header("Content-disposition: attachment; filename=test.xlsx");

    $columns=array(
    'Sıra No',
    'Sipariş No',
    'Adı Soyadı',
    'Telefon',
    'Adres'
    );

*/
 $this->load->view('admin/spreadsheet_view');

}


    public function toExcel()
  {
    $this->load->view('admin/spreadsheet_view');
  }










}