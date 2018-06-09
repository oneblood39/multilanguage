<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Raporlar_model extends MY_Model
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










  public function ankara_gunluk_randevu(){ 

    header('Content-Encoding: UTF-8');
    header('Content-Type: text/plain; charset=utf-8'); 
    header("Content-disposition: attachment; filename=test.xls");

$sql ="SELECT * FROM vwrandevu order by randevuID desc limit 0,1";
$results = $this->db->query($sql)->result();

$columns=array();
$data=array();

/* Sütun Başlıkları */
$columns=array(
    'Sıra No',
    'Sipariş No',
    'Adı Soyadı',
    'Telefon',
    'Adres'
);

foreach ($results as $result) {
  $danisanID=$result->danisanID;
  $danisanAd=$result->danisanAd;
  $danisanSoyad=$result->danisanSoyad;
  $data=$danisanAd.$danisanSoyad;
}




  }




 
     











}