<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Randevueslestir_dt extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
  //  $this->load->model('dt/cagri_dt_model');
  }

  public function index()
  {

  }

  public function getall($cagri_id){


    $start = 0;
    $length =10;

    $ofis=$this->ion_auth->user()->row()->company;
    if ($ofis==3) {  $filtre=' WHERE RandevuDurumID not in (3,5) '; $filtresearch=' WHERE RandevuDurumID not in (3,5) and '; } else { $filtre=' WHERE RandevuDurumID not in (3,5) and ofisID='.$ofis; $filtresearch=$filtre.' and '; }

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
    $query = $this->db->query("SELECT COUNT(randevuID) as total  FROM vwrandevu");
   
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
,randevuSeansUcret
,DanismanUserID
,DanismanAd
,DanismanSoyad
,terapiAdi
,RandevuDurumAdi
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
,randevuSeansUcret
,DanismanUserID
,DanismanAd
,DanismanSoyad
,terapiAdi
,RandevuDurumAdi
FROM vwrandevu
   ".$filtre." ORDER BY randevuID desc LIMIT ".$start.",".$length;
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
          $randevuid = $cat->randevuID;
         
      

        }else{
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
          $Dad = $cat->DanismanAd;
          $Dsoyad = $cat->DanismanSoyad;
          $terapitip = $cat->terapiAdi;
          $tarih = $cat->randevuBaslangicTarihSaat;
          $randevuid = $cat->randevuID;
       
        
        }
        $data .= '["'.$Ad.'","'.$Soyad.'","'.$Dad.'","'.$Dsoyad.'","'.$terapitip.'","'.$tarih.'","'.' '.'","'.' '.'"," <a href=\"'.site_url('admin/terapi/cagri/cagrieslestir/').$randevuid.'/'.$cagri_id.'\"><span title=\"çağrıya randevu ata\" class=\"glyphicon glyphicon-random\"></span></a>"],';
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


