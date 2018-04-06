<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Randevu_model extends MY_Model
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



     public function createRandevuStep1 ($data) {
$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7); 
    
echo '<br><br><br><br>';
                $data = array(
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel')
                   
                );
          //  print_r($data);
            echo '<br>';

         $this->db->insert("tbldanisan",$data);   

          //  echo "Tarih:".$date.'<br>';
           // echo "DanışmanID:".$danisman_id.'<br>';
           // echo "Zaman:".$time.'<br>';

    $sql = "SELECT * FROM tbldanisan order by danisanID desc limit 0,1";
    $results = $this->db->query($sql)->result();
         foreach ($results as $result) {
               $danisanID=$result->danisanID;
               $danisanad=$result->danisanID;
               $danisansoyad=$result->danisanID;
             //  echo "Danışan ID:".$danisanID;
                } 
}

  public function getOfficesForDropdown($firstElement=array()){
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

    public function getTerapiForDropdown($firstElement=array(),$danisman_id){
    $results = $this->db->query('SELECT * FROM vwdanismanterapi where userID='.$danisman_id.'')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->terapiTipID] = $result->terapiAdi;
    }

    return $dropdown;
  }

   public function getRandevuDurumForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmrandevudurum')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->randevuDurumID] = $result->randevuDurumAdi;
    }

    return $dropdown;
  }


   public function getOfis($ofisID){ /////////editte kullandığımız 

    if($ofisID && (int)$ofisID>0){
      $this->db->where('ofisID', $ofisID);
      $result = $this->db->get('tblOfis')->result()[0];
      return $result;
    }else{
      return false;
    }
    return false;
  }

       public function createRandevuStep2 () {
/*
$date= $this->uri->segment(5);
$danisman_id= $this->uri->segment(6); 
$time= $this->uri->segment(7); 
  */  



echo '<br><br><br><br>';
                $data = array(
                    'randevuDanismanTerapiTipID' => $this->input->post('terapi'),
                    'randevuDurumuID' => $this->input->post('randevu'),
                    'ofisID' => $this->input->post('ofis'),
                    'randevuDanisanID' => $this->input->post('danisanID'),
                    'randevuDanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time'),
                    'dakika' => $this->input->post('dakika')                   
                );

           // print_r($data);
            echo '<br>';
            $dakika=$this->input->post('dakika');
           // echo $dakika;

$time = $this->input->post('time');
$date = $this->input->post('date');
$datelast= $date.' '.$time.':'.$dakika.':'.'00';
//echo $datelast;


$terapi=$this->input->post('terapi');
$danisman_id=$this->input->post('danismanID');
 // if($danisman_id=='') { $danisman_id=$this->session->userdata('randevuDanismanID'); }
 //if($terapi=='') {   }

    $sql = "SELECT * FROM vwdanismanterapi where terapiTipID=".$terapi." and userID=".$danisman_id;
    $results = $this->db->query($sql)->result();
     foreach ($results as $result) {
       $ucret=$result->DanismanSeansUcret;
     }

$userID=$this->ion_auth->user()->row()->id;

$datakayit = array(
'randevuDanisanID' => $this->input->post('danisanID'),
'randevuDanismanTerapiTipID' => $terapi,
'ofisID' => $this->input->post('ofis'),
'randevuDurumuID' => $this->input->post('randevu'),
'randevuSeansUcret' => $ucret,
'randevuBaslangicTarihSaat' => $datelast,
'islemKullaniciID' => $userID

);

//print_r($datakayit);

$this->db->insert("tblrandevu",$datakayit);   
$this->postal->add('Randevu Ekleme Başarılı!','success');
redirect('admin/terapi/randevu/','refresh');



 
}











}