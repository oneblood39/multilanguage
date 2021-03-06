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

            $ad=$this->input->post('ad');
            $soyad=$this->input->post('soyad');
    $sql = "SELECT * FROM tbldanisan WHERE  danisanAd='".$ad."' and danisanSoyad='".$soyad."'";
    $results = $this->db->query($sql)->result();
    $sayi= $this->db->query($sql)->num_rows();

                    $data2 = array(  //////sessiona atılacak zımbırtılar:D
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel'),
                    'randevuDanismanID' => $danisman_id,
                    'date' => $date,
                    'time' => $time
                );

 if ($sayi>'0') {  
      $this->load->library('session');
      $this->session->set_flashdata('item', $data2);

foreach ($results as $result) {
  $es_ad=$result->danisanAd;
  $es_soyad=$result->danisanSoyad;
  $es_tel=$result->danisanTel;
  $es_posta=$result->danisanEposta;
}

 /*$datasessionmevcut = array(
                    'randevuDanismanID' => $danisman_id,                  
                    'date' => $date,
                    'time' => $time                                    
                );*/

$this->load->library('session');
$this->session->set_userdata($data2);
//echo $this->session->userdata('randevuDanismanID'); 

       $this->postal->add('Kayıtlı olan mevcut kullanıcı:<br>'.$es_ad.' '.$es_soyad.'<br>Tel:'.$es_tel.'<br>Mail:'.$es_posta.'    <center> Bu isim ve soyisme ait bir danışan var!</center><br><a href="'.site_url('admin/terapi/randevu/yinedekaydet').'">Yine de Kaydet</a>
        <br>
        <a href="'.site_url('admin/terapi/randevu').'">İptal</a>','error');
       redirect('admin/terapi/danisan/','refresh');

          } else {

   $this->db->insert("tbldanisan",$data); 



       $sql = "SELECT * FROM tbldanisan order by danisanID desc limit 0,1";
       $results = $this->db->query($sql)->result();
         foreach ($results as $result) {
               $danisanID=$result->danisanID;
               $danisanad=$result->danisanID;
               $danisansoyad=$result->danisanID;
             //  echo "Danışan ID:".$danisanID;
                } 



          }

           
      
 //$this->db->insert("tbldanisan",$data);   
          //  echo "Tarih:".$date.'<br>';
           // echo "DanışmanID:".$danisman_id.'<br>';
           // echo "Zaman:".$time.'<br>';

    /*$sql = "SELECT * FROM tbldanisan order by danisanID desc limit 0,1";
    $results = $this->db->query($sql)->result();
         foreach ($results as $result) {
               $danisanID=$result->danisanID;
               $danisanad=$result->danisanID;
               $danisansoyad=$result->danisanID;
             //  echo "Danışan ID:".$danisanID;
                } */

}

 public function yinedekaydet () {
              $data = array(
                    'danisanAd' => $this->session->userdata('danisanAd'), 
                    'danisanSoyad' => $this->session->userdata('danisanSoyad'),
                    'danisanTel' => $this->session->userdata('danisanTel')
                    //'randevuDanismanID' => $this->session->userdata('randevuDanismanID')
                   
                );
     $this->db->insert("tbldanisan",$data);  
       $sql = "SELECT * FROM tbldanisan order by danisanID desc limit 0,1";
       $results = $this->db->query($sql)->result();
         foreach ($results as $result) {
               $danisanID=$result->danisanID;
               $danisanad=$result->danisanID;
               $danisansoyad=$result->danisanID;
             //  echo "Danışan ID:".$danisanID;
                } 

       redirect('admin/terapi/randevu/randevuekle_step3/'.$this->session->userdata('date').'/'.$this->session->userdata('randevuDanismanID').'/'.$this->session->userdata('time'),'refresh');

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
        $danisan_id= $this->uri->segment(5); 
        $data = array(
                    'randevuTerapiTipID' => $this->input->post('terapi'),
                    'randevuDurumuID' => $this->input->post('randevu'),
                    'randevuSeansTipID' => $this->input->post('seans'),
                    'randevuDanismanUserID' => $this->input->post('danismanID'),
                    'odaID' => $this->input->post('oda'),
                    'randevuDanisanID' => $this->input->post('danisanID'),
                    'randevuDanismanID' => $this->input->post('danismanID'),
                    'randevuYonlenmeDurumu' => $this->input->post('sekreteryonlendirme'),
                    'randevuYonlendirenDanismanUserID' => $this->input->post('yonlendirendanismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time'),
                    'dakika' => $this->input->post('dakika')                   
                );


$gelenterapi=$this->input->post('terapi');
$gelenseans=$this->input->post('seans');
$goda=$this->input->post('oda');

if($gelenterapi=='' or $gelenseans=='' or $goda=='') {  
$this->postal->add('Randevu Eklenemedi! Randevu eklerken tüm alanların doldurulması gerekmektedir!','error');
redirect('admin/terapi/randevu/','refresh');
} else {



           // print_r($data);
           // echo '<br>';
            $dakika=$this->input->post('dakika');
           // echo $dakika;
$gelenoda=$this->input->post('oda');
$time = $this->input->post('time');
$date = $this->input->post('date');
$paket = $this->input->post('paket');


$formatted_date=$date.' '.$time;



  $sqlodasorgu = "SELECT * FROM vwrandevu WHERE (randevuBaslangicTarihSaat LIKE '%".$formatted_date."%') and (odaID='".$gelenoda."') and (RandevuDurumID<>5)"; 
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
$seans=$this->input->post('seans');

$datakayit = array(
'randevuDanisanID' => $this->input->post('danisanID'),
'randevuTerapiTipID' => $terapi,
'randevuSeansTipID' => $seans,
'randevuDanismanUserID' => $danisman_id,
'randevuYonlendirenDanismanUserID' => $this->input->post('yonlendirendanismanID'), 
'randevuYonlenmeDurumu' => $this->input->post('sekreteryonlendirme'),  
'odaID' => $this->input->post('oda'),
'ofisID' => $ofisID,
'randevuDurumuID' => $this->input->post('randevu'),
'randevuSeansUcret' => $ucret,
'randevuBaslangicTarihSaat' => $datelast,
'randevuPaketID' => $paket,
'islemKullaniciID' => $userID

);



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
$seans=$this->input->post('seans');
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
//'randevuDanismanTerapiTipID' => $terapi,
'randevuTerapiTipID' => $terapi,
'randevuSeansTipID' => $seans,
'randevuDanismanUserID' => $danisman_id,
'randevuYonlendirenDanismanUserID' => $this->input->post('yonlendirendanismanID'), 
'randevuYonlenmeDurumu' => $this->input->post('sekreteryonlendirme'),  
'odaID' => $this->input->post('oda'),
'ofisID' => $ofisID,
'randevuDurumuID' => $this->input->post('randevu'),
'randevuSeansUcret' => $ucret,
'randevuBaslangicTarihSaat' => $datelast,
'randevuPaketID' => $paket,
'islemKullaniciID' => $userID

);

 // print_r($datakayit);

$this->db->insert("tblrandevu",$datakayit);   
$this->postal->add('Randevu Ekleme Başarılı!','success');
redirect('admin/terapi/randevu/','refresh');


}
 
}
}

  public function getiptalnedenForDropdown($firstElement=array()){

    $results=$this->db->query('SELECT * FROM tnmrandevuiptalnedeni order by randevuiptalNedeniID asc')->result(); 
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }
    foreach ($results as $result) {
      $dropdown[$result->randevuiptalNedeniID] = $result->randevuiptalNedeniAdi;
    }

    return $dropdown;
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
$data =  array(
  'randevuDurumuID' => $durum,
  'randevuiptalNedeniID' => $this->input->post('iptalneden')
); 


$neden=$this->input->post('iptalneden');

  $sql="Select * from tnmrandevuiptalnedeni where randevuiptalNedeniID=".$neden;
  $results = $this->db->query($sql)->result();
    foreach ($results as $result) {
       $drop=$result->dropMu;    
    }

if ($drop=='1') { 

$randevusql="Select * from vwrandevu where randevuID=".$randevu_id;
$results=$this->db->query($randevusql)->result();
foreach ($results as $result) {
  $danisan_id=$result->danisanID;
  $danisman_id=$result->DanismanUserID;
}

$this->postal->add('Seçtiğiniz randevu iptal nedeni aynı zamanda bir drop nedeni!
<br><br> Hangisini yapmak istersiniz? <br> 
<a href="'.site_url('admin/terapi/randevu/drop_ederek_iptal/'.$danisan_id.'/'.$danisman_id.'/'.$randevu_id.'/'.$neden).'">Drop Ederek İptal Et</a> -- 
<a href="'.site_url('admin/terapi/randevu/drop_etmeden_iptal/'.$randevu_id.'/'.$date.'/'.$ofis).'">Drop Etmeden İptal Et</a> -- 
<a href="'.site_url('admin/terapi/randevu').'">İptal Etme</a> 
  ','error');

redirect('admin/terapi/randevu/','refresh');


} else {   
$this->db->where('randevuID', $randevu_id);
$this->db->update('tblrandevu',$data);
$this->postal->add('Randevu İptal Edildi!','success');
redirect('admin/terapi/randevu/','refresh');
}

 
    }


 public function getdropnedenlerForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmdevametmemenedeni')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->devamEtmemeNedeniID] = $result->devamEtmemeNedeniAdi;
    }

    return $dropdown;
  }



    public function dropetmedeniptalet() {
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
$data =  array(
  'randevuDurumuID' => $durum,
  'randevuiptalNedeniID' => $this->input->post('iptalneden')
); 

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
//'randevuDanismanTerapiTipID' => $this->session->userdata('randevuDanismanTerapiTipID'),
'randevuDanismanUserID' => $this->session->userdata('randevuDanismanUserID'),
'randevuYonlendirenDanismanUserID' => $this->session->userdata('randevuYonlendirenDanismanUserID'),  
'randevuYonlenmeDurumu' => $this->session->userdata('randevuYonlenmeDurumu'), 
'randevuTerapiTipID' => $this->session->userdata('randevuTerapiTipID'),
'randevuSeansTipID' => $this->session->userdata('randevuSeansTipID'),
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

echo '<br><br><br><br><br><br>';
//echo $randevuid;

$dakika=$this->input->post('dakika');

$lasttime=$date.' '.$time.':'.$dakika.':00';

$datakayit = array(
 'randevuBaslangicTarihSaat' => $lasttime
);
$this->db->where('randevuID', $randevuid);
$this->db->update('tblrandevu',$datakayit);
$this->postal->add('Randevu Erteleme Başarılı!','success');
redirect('admin/terapi/randevu/','refresh');
  }


  public function getDanismanlarForDropdown($firstElement=array(),$ofisID){

    if($ofisID=='3') { $results=$this->db->query('SELECT * FROM vwdanisman')->result(); }
    else { 
         $results = $this->db->query('SELECT * FROM vwdanisman where ofisID='.$ofisID.' or ofisID="3"')->result();
    }

    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->ID] = $result->DanismanAd.' '.$result->DanismanSoyad;
    }

    return $dropdown;
  }

  public function mazeretkaydet () {
    


    $datakayit = array(
   'mazeretBaslangicTarihSaat' => $this->input->post('baslangic'),
   'mazeretBitisTarihSaat' => $this->input->post('bitis'),
   'danismanUserID' => $this->input->post('danismanlar'),
   'mazeretAciklama' => $this->input->post('info'),
   'danismanMazeretTipID' => $this->input->post('mazeretler'),
   'islemKullaniciID' => $this->input->post('id'),
   'aktifMi' => 1
    );
$baslangic=$this->input->post('baslangic');
$bitis=$this->input->post('bitis');
$danismanUserID=$this->input->post('danismanlar');
$sqlkontrol="SELECT * FROM mizmeryonetim.vwrandevu
where randevuBaslangicTarihSaat > '".$baslangic."' and randevuBaslangicTarihSaat < '".$bitis."' and DanismanUserID=".$danismanUserID;
$sayi= $this->db->query($sqlkontrol)->num_rows();
    if($sayi>0) { 
    $this->postal->add('Bu saat aralığında '.$sayi.' adet randevu bulunduğundan mazeret giremezsiniz!','error');
    redirect('admin/terapi/randevu/mazeretler','refresh');
    } else {


$saat=explode(' ', $baslangic);
$saatbas=explode(':', $saat[1]);
$saatbas=$saatbas[0];

$saatbitis=explode(' ', $bitis);
$saatbit=explode(':', $saatbitis[1]);
$saatbit=$saatbitis[1];

if ($saatbas>=23 or $saatbas<=8 or $saatbit>=23 or $saatbit<=8) {
    $this->postal->add('Mesai saatleri dışında mazeret ekleyemezsiniz.','error');
    redirect('admin/terapi/randevu/mazeretler','refresh');
} else {
   $this->db->insert("ilsdanismanmazeret",$datakayit);   
    $this->postal->add('Mazeret Ekleme Başarılı!','success');
    redirect('admin/terapi/randevu/mazeretler','refresh');
}


 }

  }


   public function getMazeretlerForDropdown($firstElement=array()){

    $results=$this->db->query('SELECT * FROM tnmmazerettip')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->mazeretTipID] = $result->mazeretAdi;
    }

    return $dropdown;
  }
  
public function mazeretdurumdegistir () {

$mazeretid= $this->uri->segment(5);
//echo $mazeretid;


    $sqlmazeret = "SELECT * FROM vwdanismanmazeret where danismanMazeretID=".$mazeretid;
    $results = $this->db->query($sqlmazeret)->result();
     foreach ($results as $result) {
       $aktiflik=$result->aktifMi;
     }
if ($aktiflik=='1') { 
   $datakayit = array( 
 'aktifMi' => 0
   );
$this->db->where('danismanMazeretID', $mazeretid);
$this->db->update('vwdanismanmazeret',$datakayit);
$this->postal->add('Mazeret Pasif Etme Başarılı!','success');
redirect('admin/terapi/randevu/mazeretler','refresh');

   }
  else {  
 $datakayit = array( 
 'aktifMi' => 1
   );
$this->db->where('danismanMazeretID', $mazeretid);
$this->db->update('vwdanismanmazeret',$datakayit);
$this->postal->add('Mazeret Aktif Etme Başarılı!','success');
redirect('admin/terapi/randevu/mazeretler','refresh');

    }

  }







}