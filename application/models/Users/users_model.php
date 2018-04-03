<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Users_model extends MY_Model
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

  public function getOfficesForDropdown($firstElement=array()){
    //$this->data['groups'] = $this->users_model->getUserGroups();

    $results = $this->db->query('SELECT * FROM tblOfis')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->ofisID] = $result->ofisAdi;
    }

    return $dropdown;
  }

   /* public function getOfis($ofisID){ /////////editte kullandığımız 

    if($ofisID && (int)$ofisID>0){
      $this->db->where('ofisID', $ofisID);
      $result = $this->db->get('tblOfis')->result()[0];
      return $result;
    }else{
      return false;
    }
    return false;
  }*/






}