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
    
//echo '<br><br><br><br>';
                $data = array(
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel')
                   
                );
           
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
    $results = $this->db->query('SELECT * FROM tblofis')->result();
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
      $dropdown[$result->danismanTerapiID] = $result->terapiAdi;
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



//echo '<br><br><br><br>';
                $data = array(
                    'randevuDanismanTerapiTipID' => $this->input->post('terapi'),
                    'randevuDurumuID' => $this->input->post('randevu'),
                    'odaID' => $this->input->post('oda'),
                    'randevuDanisanID' => $this->input->post('danisanID'),
                    'randevuDanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time'),
                    'dakika' => $this->input->post('dakika')                   
                );

           // print_r($data);
           // echo '<br>';
            $dakika=$this->input->post('dakika');
           // echo $dakika;
$gelenoda=$this->input->post('oda');
$time = $this->input->post('time');
$date = $this->input->post('date');




$formatted_date=$date.' '.$time;


  $sqlodasorgu = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$formatted_date."%') and (odaID='".$gelenoda."')"; 
  $sayioda= $this->db->query($sqlodasorgu)->num_rows();////


if($sayioda>0) { 

/////////odada randevu var ise
$datelast= $date.' '.$time.':'.$dakika.':'.'00';
//echo $datelast;
$terapi=$this->input->post('terapi');
$danisman_id=$this->input->post('danismanID');

    $sql = "SELECT * FROM vwdanismanterapi where danismanTerapiID=".$terapi;
    $results = $this->db->query($sql)->result();
     foreach ($results as $result) {
       $ucret=$result->DanismanSeansUcret;
     }

$userID=$this->ion_auth->user()->row()->id;

    $oda=$this->input->post('oda');
    $sqloda = "SELECT * FROM tbloda where odaID=".$oda;
    $results = $this->db->query($sqloda)->result();
     foreach ($results as $result) {
       $ofisID=$result->odaOfisID;
     }


$datakayit = array(
'randevuDanisanID' => $this->input->post('danisanID'),
'randevuDanismanTerapiTipID' => $terapi,
'odaID' => $this->input->post('oda'),
'ofisID' => $ofisID,
'randevuDurumuID' => $this->input->post('randevu'),
'randevuSeansUcret' => $ucret,
'randevuBaslangicTarihSaat' => $datelast,
'islemKullaniciID' => $userID

);


//print_r($datakayit);


$this->load->library('session');
$this->session->set_userdata($datakayit);


$this->postal->add('Randevu Saatinde Seçtiğiniz Oda Dolu! Yine de randevu vermek istermisiniz?
<a href="'.site_url('admin/terapi/randevu/randevuyinedeekle').'">Evet</a> -- <a href="'.site_url('admin/terapi/randevu/').'">Hayır</a>
  ','error');
redirect('admin/terapi/randevu/','refresh');


  } else {

$datelast= $date.' '.$time.':'.$dakika.':'.'00';
//echo $datelast;
$terapi=$this->input->post('terapi');
$danisman_id=$this->input->post('danismanID');
 // if($danisman_id=='') { $danisman_id=$this->session->userdata('randevuDanismanID'); }
 //if($terapi=='') {   }

    $sql = "SELECT * FROM vwdanismanterapi where danismanTerapiID=".$terapi;
    $results = $this->db->query($sql)->result();
     foreach ($results as $result) {
       $ucret=$result->DanismanSeansUcret;
     }

$userID=$this->ion_auth->user()->row()->id;

    $oda=$this->input->post('oda');
    $sqloda = "SELECT * FROM tbloda where odaID=".$oda;
    $results = $this->db->query($sqloda)->result();
     foreach ($results as $result) {
       $ofisID=$result->odaOfisID;
     }


$datakayit = array(
'randevuDanisanID' => $this->input->post('danisanID'),
'randevuDanismanTerapiTipID' => $terapi,
'odaID' => $this->input->post('oda'),
'ofisID' => $ofisID,
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

   public function randevuiptalet() {
 $randevu_id= $this->uri->segment(5);
 $date= $this->uri->segment(6);
 $ofis= $this->uri->segment(7);

$datasession = array(
 'date' => $date,
 'ofis' => $ofis
);
$this->load->library('session');
$this->session->set_userdata($datasession);


 $durum='5';  ///randevu iptal durumu
$data =  array('randevuDurumuID' => $durum ); 

$this->db->where('randevuID', $randevu_id);
$this->db->update('tblrandevu',$data);
$this->postal->add('Randevu İptal Edildi!','success');
redirect('admin/terapi/randevu/','refresh');

 
    }




  public function getOdalarForDropdown($firstElement=array(),$ofisID){
echo '<br><br><br>';
 //   echo $ofisID;
    if($ofisID=='3') { $results=$this->db->query('SELECT * FROM tbloda')->result(); }
    else { 
         $results = $this->db->query('SELECT * FROM tbloda where odaOfisID='.$ofisID.'')->result();
    }

    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->odaID] = $result->odaAdi;
    }

    return $dropdown;
  }


public function randevudurumudegistir() {
//echo 'test';

$datakayit = array(
'randevuDurumuID' => $this->input->post('randevular')

);

$randevu_id=$this->input->post('randevuid');

$randevudurum=$this->input->post('randevular');
//print_r($randevudurum);

$ofis= $this->input->post('ofis');
$date =$this->input->post('date');

$datasession = array(
 'date' => $date,
 'ofis' => $ofis
);
$this->load->library('session');
$this->session->set_userdata($datasession);

$this->db->where('randevuID', $randevu_id);
$this->db->update('tblrandevu',$datakayit);
$this->postal->add('Randevu Durumu Değiştirildi!','success');
redirect('admin/terapi/randevu/','refresh');



}


public function randevuinfodegistir() {
//$randevuid= $this->uri->segment(5);
$datakayit = array(
 'randevuAciklama' => $this->input->post('randevuinfo')
);
$randevuid=$this->input->post('randevuid');

$this->db->where('randevuID', $randevuid);
$this->db->update('tblrandevu',$datakayit);
$this->postal->add('Randevu Açıklaması Değiştirildi!','success');
redirect('admin/terapi/randevu/','refresh');
  }

public function randevuyinedeekle() {
$datakayit = array(
'randevuDanisanID' => $this->session->userdata('randevuDanisanID'),
'randevuDanismanTerapiTipID' => $this->session->userdata('randevuDanismanTerapiTipID'),
'odaID' => $this->session->userdata('odaID'),
'ofisID' => $this->session->userdata('ofisID'),
'randevuDurumuID' => $this->session->userdata('randevuDurumuID'),
'randevuSeansUcret' => $this->session->userdata('randevuSeansUcret'),
'randevuBaslangicTarihSaat' => $this->session->userdata('randevuBaslangicTarihSaat'),
'islemKullaniciID' => $this->session->userdata('islemKullaniciID')

);
//print_r($datakayit);

$this->db->insert("tblrandevu",$datakayit);   
$this->postal->add('Randevu Ekleme Başarılı!','success');
redirect('admin/terapi/randevu/','refresh');

}


public function randevuertelekaydet() {
$date= $this->uri->segment(5);
$userid= $this->uri->segment(6);
$time= $this->uri->segment(7);
$ofis=$this->uri->segment(8);
$randevuid=$this->uri->segment(9);

$lasttime=$date.' '.$time.':00:00';

$datakayit = array(
 'randevuBaslangicTarihSaat' => $lasttime
);
$this->db->where('randevuID', $randevuid);
$this->db->update('tblrandevu',$datakayit);
$this->postal->add('Randevu Erteleme Başarılı!','success');
redirect('admin/terapi/randevu/','refresh');
  }







}