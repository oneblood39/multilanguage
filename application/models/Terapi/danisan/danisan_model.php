<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Danisan_model extends MY_Model
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

    public function createDanisan (){ ///yeni danisan ekleme
       //$group_id = $this->uri->segment(4);
   
            $data = array(
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel'),
                    'danisanEposta' => $this->input->post('eposta'),
                    'danisanTestMizacTipID' => $this->input->post('mizac'),
                    'islemKullaniciID' => $this->input->post('userid')
                );
           // print_r($data);

            $ad=$this->input->post('ad');
            $soyad=$this->input->post('soyad');

    $sql = "SELECT * FROM tbldanisan WHERE  danisanAd='".$ad."' and danisanSoyad='".$soyad."'";
    $results = $this->db->query($sql)->result();
    $sayi= $this->db->query($sql)->num_rows();

        if ($sayi>'0') {  
      $this->load->library('session');
      $this->session->set_flashdata('item', $data);

foreach ($results as $result) {
  $es_ad=$result->danisanAd;
  $es_soyad=$result->danisanSoyad;
  $es_tel=$result->danisanTel;
  $es_posta=$result->danisanEposta;
}

    
  echo 'Bu isim ve soyisme ait bir danisan var.<br><a href="">Detayı Göster</a><br>
        <a href="../danisan/lastcreate">Kaydet</a>'; 
       $this->postal->add('
       <center> Bu isim ve soyisme ait bir danışan var!</center><br>
        <a href="../danisan/lastcreate">Kaydet</a><br>
        <a href="../danisan">İptal</a>
        ',' error');
       $this->postal->add('Kayıtlı olan mevcut kullanıcı:<br>'.$es_ad.' '.$es_soyad.'<br>Tel:'.$es_tel.'<br>Mail:'.$es_posta.'','success');
          //  redirect('admin/terapi/danisan/','refresh');
    // redirect('admin/terapi/danisan/create');
          }

      else { 
            
            $this->db->insert("tbldanisan",$data);
            $this->postal->add('Danışan Ekleme Başarılı!','success');
            redirect('admin/terapi/danisan/','refresh');
       } 


    }

   
    public function createDanisanLast (){ ///yeni danisan ekleme
    $data = $this->session->flashdata('item');
    //print_r($data);
     $this->db->insert("tbldanisan",$data);
     $this->postal->add('Danışan Ekleme Başarılı!','success');
     redirect('admin/terapi/danisan/','refresh');
 
   }

public function getDanisan($danisanID){ /////////editte kullandığımız 

    if($danisanID && (int)$danisanID>0){
      $this->db->where('danisanID', $danisanID);
      $result = $this->db->get('tbldanisan')->result()[0];
      return $result;
    }else{
      return false;
    }
    return false;
  }

  public function danisanupdate(){
$danisan_id=$this->input->post('danisanID');

            $data = array(
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel'),
                    'danisanEposta' => $this->input->post('eposta'),
                    'danisanTestMizacTipID' => $this->input->post('mizac')
                );

$sql="INSERT INTO arstbldanisan (
     danisanID ,
    danisanAd ,
    danisanSoyad ,
    danisanEposta ,
    danisanTel ,
    danisanTestMizacTipID ,
    danisanUzmanMizacTipID ,
    islemKullaniciID ,
    dateCreated)
SELECT  danisanID ,
    danisanAd ,
    danisanSoyad ,
    danisanEposta ,
    danisanTel ,
    danisanTestMizacTipID ,
    danisanUzmanMizacTipID ,
    islemKullaniciID ,
    dateCreated
FROM tbldanisan
WHERE danisanID=".$danisan_id;

if ($this->db->query($sql)) {
 $this->db->where('danisanID', $danisan_id);
 $this->db->update('tbldanisan',$data);
 $this->postal->add('Danışan güncelleme başarılı!','success');
 redirect('admin/terapi/danisan');
} else {
 $this->postal->add('Danışan güncelleme başarılı değil!','error');
redirect('admin/terapi/danisan');
}


  }




}