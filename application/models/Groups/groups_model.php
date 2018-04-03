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

    public function updatepermissions ($data = array()){ ///izinleri güncelleme
       $group_id = $this->uri->segment(4);
      // echo $group_id;

      // print_r($data['group_name']);
            $this->db->where('rol_id',$group_id);           
            $this->db->delete('ils_rolfonksiyon');
            ///////
       foreach ($data['group_name'] as $name) {
        echo $name;
            $this->db->set("rol_id", $group_id);
            $this->db->set("fonksiyon_id", $name);
            $this->db->insert("ils_rolfonksiyon");
   }
   
   $this->postal->add('Yetki Güncelleme Başarılı!','success');
   redirect('admin/groups/permissions/'.$group_id,'refresh');

    }






}