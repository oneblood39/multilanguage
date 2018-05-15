<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Tanimlar_model extends MY_Model
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


    
     public function ilackaydet () {
             $data = array(
                    'psikiyatriilacAdi' => $this->input->post('ilac'),
                    'kutuDozMiktari' => $this->input->post('toplamdoz'),
                    'islemKullaniciID' => $this->input->post('userid')       
                   
                );

         $this->db->insert("tnmpsikiyatriilac",$data); 
         $this->postal->add('İlaç Ekleme Başarılı!','success');
         redirect('admin/terapi/tanimlar/','refresh');

    }



  












}