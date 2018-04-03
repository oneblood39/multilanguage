<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Groups_model extends MY_Model
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

    public function cagridata (){ ///cagri_dt mvc yapısı araştırma:D
   
      // toplam kategori sayısı
    $query = $this->db->query("SELECT COUNT(cagriID) as total FROM tblcagri");
   
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM tblcagri WHERE cagriYapanAd like ".$this->db->escape('%'.$search.'%')." or cagriYapanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapilanAd like ".$this->db->escape('%'.$search.'%')." or cagriTarihSaat like ".$this->db->escape('%'.$search.'%')." or cagriYapilanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapanTel like ".$this->db->escape('%'.$search.'%')." ORDER BY cagriID LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM tblcagri ORDER BY cagriID LIMIT ".$start.",".$length;
    }
    
    $query = $this->db->query($queryString);

    $Cagrilar = $query->result();  ////mainCategories olan satır


    }






}