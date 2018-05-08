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
    if ($ofis==3) {  $filtre=' '; $filtresearch=' WHERE '; } else { $filtre=' WHERE tblofis.ofisID='.$ofis; $filtresearch=$filtre.' and '; }

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
 tbldanisan.danisanID
,tbldanisan.danisanAd
,tbldanisan.danisanSoyad
,tblofis.ofisAdi
,tblofis.ofisID
,tblrandevu.randevuID
,tblrandevu.randevuBaslangicTarihSaat
,tblrandevu.randevuBitisTarihSaat
,tblrandevu.randevuSeansUcret

,users.ID as DanismanUserID
,users.first_name as DanismanAd
,users.last_name as DanismanSoyad
,tnmterapitip.terapiAdi
,tnmrandevudurum.RandevuDurumAdi
FROM tblrandevu 
INNER JOIN tbldanisan on tbldanisan.danisanID=tblrandevu.randevuDanisanID
INNER JOIN tnmrandevudurum on tnmrandevudurum.randevuDurumID=tblrandevu.randevuDurumuID
LEFT JOIN tblofis ON tblofis.ofisID=tblrandevu.ofisID
LEFT JOIN ilsdanismanterapi on ilsdanismanterapi.danismanTerapiID=tblrandevu.randevuDanismanTerapiTipID
left JOIN users on users.id=ilsdanismanterapi.userID
left JOIN tnmterapitip on tnmterapitip.terapiTipID=ilsdanismanterapi.terapiTipID 
".$filtresearch." (tbldanisan.danisanAd like ".$this->db->escape('%'.$search.'%').
" or danisanSoyad like ".$this->db->escape('%'.$search.'%').
" or users.first_name like ".$this->db->escape('%'.$search.'%').
" or users.last_name like ".$this->db->escape('%'.$search.'%').
" or tnmterapitip.terapiAdi like ".$this->db->escape('%'.$search.'%').
") ORDER BY tblrandevu.randevuID desc LIMIT ".$start.",".$length;
    }else{


     
      $queryString = "SELECT 
 tbldanisan.danisanID
,tbldanisan.danisanAd
,tbldanisan.danisanSoyad
,tblofis.ofisAdi
,tblofis.ofisID
,tblrandevu.randevuID
,tblrandevu.randevuBaslangicTarihSaat
,tblrandevu.randevuBitisTarihSaat
,tblrandevu.randevuSeansUcret

,users.ID as DanismanUserID
,users.first_name as DanismanAd
,users.last_name as DanismanSoyad
,tnmterapitip.terapiAdi
,tnmrandevudurum.RandevuDurumAdi
FROM tblrandevu 
INNER JOIN tbldanisan on tbldanisan.danisanID=tblrandevu.randevuDanisanID
INNER JOIN tnmrandevudurum on tnmrandevudurum.randevuDurumID=tblrandevu.randevuDurumuID
LEFT JOIN tblofis ON tblofis.ofisID=tblrandevu.ofisID
LEFT JOIN ilsdanismanterapi on ilsdanismanterapi.danismanTerapiID=tblrandevu.randevuDanismanTerapiTipID
left JOIN users on users.id=ilsdanismanterapi.userID
left JOIN tnmterapitip on tnmterapitip.terapiTipID=ilsdanismanterapi.terapiTipID   ".$filtre." ORDER BY tbldanisan.danisanID desc LIMIT ".$start.",".$length;
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
         
      

        }else{
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
          $Dad = $cat->DanismanAd;
          $Dsoyad = $cat->DanismanSoyad;
          $terapitip = $cat->terapiAdi;
          $tarih = $cat->randevuBaslangicTarihSaat;
       
        
        }
        $data .= '["'.$Ad.'","'.$Soyad.'","'.$Dad.'","'.$Dsoyad.'","'.$terapitip.'","'.$tarih.'","'.' '.'","'.' '.'"," <a href=\"'.site_url('admin/terapi/cagri/cagrieslestir/').$cat->danisanID.'/'.$cagri_id.'\"><span title=\"çağrıya randevu ata\" class=\"glyphicon glyphicon-random\"></span></a>"],';
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


