<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Randevu_dt extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
  //  $this->load->model('dt/cagri_dt_model');
  }

  public function index()
  {

  }

  public function getall(){

    $start = 0;
    $length =10;

    $ofis=$this->ion_auth->user()->row()->company;
    if ($ofis==3) {  $filtre=' '; $filtresearch=' WHERE '; } else { $filtre=' WHERE ofisID='.$ofis; $filtresearch=$filtre.' and '; }

    if($this->input->get('start')){
      $start = (int)$this->input->get('start');
    }

    if($this->input->get('length')){
      $length = (int)$this->input->get('length');
    }

    $search = '';

    if($this->input->get('search')['value']){
      $search = $this->input->get('search')['value'];
    }

    $draw = 1; //tablonun yenilenme sayısı
    
    if($this->input->get('draw')){
      $draw = (int)$this->input->get('draw') + 1;
    }

   $data = array();

    // toplam kategori sayısı
    $query = $this->db->query("SELECT COUNT(randevuID) as total  FROM tblrandevu");
   
    $total = $query->row()->total;


    if($search){
      $queryString = "SELECT 
 danisanID
,danisanAd
,danisanSoyad
,ofisAdi
,ofisID
,randevuID
,randevuBaslangicTarihSaat
,randevuBitisTarihSaat
,odaID
,odaAdi
,odaKisaltma
,DanismanUserID
,DanismanAd
,DanismanSoyad
,terapiAdi
,RandevuDurumID
,RandevuDurumAdi
,RandevuPaketi
,RandevuPaketSeansSayisi
,KacinciSeans
FROM vwrandevu 

".$filtresearch." (danisanAd like ".$this->db->escape('%'.$search.'%').
" or danisanSoyad like ".$this->db->escape('%'.$search.'%').
" or DanismanAd like ".$this->db->escape('%'.$search.'%').
" or DanismanSoyad like ".$this->db->escape('%'.$search.'%').
" or terapiAdi like ".$this->db->escape('%'.$search.'%').
") ORDER BY randevuID desc LIMIT ".$start.",".$length;
    }else{


     
      $queryString = "SELECT 
 danisanID
,danisanAd
,danisanSoyad
,ofisAdi
,ofisID
,randevuID
,randevuBaslangicTarihSaat
,randevuBitisTarihSaat
,odaID
,odaAdi
,odaKisaltma
,DanismanUserID
,DanismanAd
,DanismanSoyad
,terapiAdi
,RandevuDurumID
,RandevuDurumAdi
,RandevuPaketi
,RandevuPaketSeansSayisi
,KacinciSeans
FROM vwrandevu 
".$filtre." ORDER BY danisanID desc LIMIT ".$start.",".$length;
    }                                                                           

      ///WHERE tblofis.ofisID=".$ofis."
    
    $query = $this->db->query($queryString);

    $Danisanlar = $query->result();  ////mainCategories olan satır

    $data = '[';

    if($search){
      $rFiltered = 0;
    }else{
      $rFiltered = $total; //filtrelenmiş kayıt sayısı
    }
    $recordsTotal = $total; // toplam kayıt sayısı

    foreach ($Danisanlar as $cat) {      
      if($search){
        $rFiltered++;
      }
          
    // if($search){
       if($cat->danisanID>0){  
       
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
          $Dad = $cat->DanismanAd;
          $Dsoyad = $cat->DanismanSoyad;
          $terapitip = $cat->terapiAdi;
          $tarih = $cat->randevuBaslangicTarihSaat;
          $paketadi = $cat->RandevuPaketi;
          $toplamseans = $cat->RandevuPaketSeansSayisi;
          $seans = $cat->KacinciSeans;
          $durum = $cat->RandevuDurumAdi;
          $yazi=$seans.'/'.$toplamseans;
          if($paketadi!=''){     $yazi=$seans.'/'.$toplamseans;  } else { $yazi='';  }


        }else{
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
          $Dad = $cat->DanismanAd;
          $Dsoyad = $cat->DanismanSoyad;
          $terapitip = $cat->terapiAdi;
          $tarih = $cat->randevuBaslangicTarihSaat;
          $paketadi = $cat->RandevuPaketi;
          $toplamseans = $cat->RandevuPaketSeansSayisi;
          $durum = $cat->RandevuDurumAdi;
          $seans = $cat->KacinciSeans;
          if($paketadi!=''){     $yazi=$seans.'/'.$toplamseans;  } else { $yazi='';  }

        
        }
        $data .= '["'.$Ad.'","'.$Soyad.'","'.$Dad.'","'.$Dsoyad.'","'.$terapitip.'","'.$tarih.'","'.$paketadi.'","'.$yazi.'","'.$durum.'"," <a href=\"'.site_url('admin/terapi/cagri/cagridetay/').$cat->danisanID.'\"><span title=\"özellikler\" class=\"glyphicon glyphicon-random\"></span></a>"],';
  //print_r($data);

    }
    
    $data = substr($data, 0, strlen($data)-1);
    $data .= ']';


    // echo $data;
    if($data == ']'){$data='[]';}
    // echo $data;



    echo '
    {
    "draw": '.$draw.',
    "recordsTotal": '.$recordsTotal.',
    "recordsFiltered": '.$rFiltered.',
    "data": '.$data.'}';
  }
}


