<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Seans_model extends MY_Model
{
    public $table = 'menus';
    public $primary_key = 'id';

    public function __construct()
    {
        $this->has_many['items'] = array('Menu_item_model','menu_id','id');
        $this->pagination_delimiters = array('<li>','</li>');
        $this->pagination_arrows = array('<span aria-hidden="true">&laquo;</span>','<span aria-hidden="true">&raquo;</span>');
        parent::__construct();
    }

    public $rules = array(
        'insert' => array(
            'title' => array('field'=>'title','label'=>'Title','rules'=>'trim|required')
        ),
        'update' => array(
            'title' => array('field'=>'title','label'=>'Title','rules'=>'trim|required'),
            'menu_id' => array('field'=>'menu_id', 'label'=>'ID', 'rules'=>'trim|is_natural_no_zero|required')
        )
    );



 public function paketrandevukaydet ($data) {
                $data = array(                
                    'randevuPaketID' => $this->input->post('paketid')                      
                );

$data2 = $this->input->post('coklu') ;
$arraycount=count($data2);
$paketid=$this->input->post('paketid');

for ($i = 0; $i <= $arraycount-1; $i++) {
  $datasave = array( 
   'randevuID' => $data2[$i]
  );

  $randevuid=$data2[$i];

$this->db->where('randevuID', $randevuid);
$this->db->update("tblrandevu",$data);

}
$this->postal->add('Pakete randevular eklendi!','success');
redirect('admin/terapi/seans/','refresh');

  }

 public function paketkaydet () {
  $userid=$this->ion_auth->user()->row()->id;
                $data = array(                
                    'paketNo' => $this->input->post('paketno'),
                    'paketAdi' => $this->input->post('paket_adi'),  
                    'paketUcret' => $this->input->post('ucret'),  
                    'paketSeansSayi' => $this->input->post('toplam_seans'),
                    'islemKullaniciID' => $userid                       
                );

//print_r($data);

$this->db->insert("tblpaket",$data);
$this->postal->add('Yeni paket oluşturuldu!','success');
redirect('admin/terapi/seans/','refresh');
 }






}