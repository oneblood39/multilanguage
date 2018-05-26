<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Kendidanisanlarim_dt extends Admin_Controller
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

$userid=$this->ion_auth->user()->row()->id;


    $start = 0;
    $length = 10;

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

   // $this->cagri_dt_model->cagridata($data);

    // toplam kategori sayısı
    $query = $this->db->query("SELECT COUNT(danisanID) as total FROM vwdanismandanisan WHERE DanismanUserID=".$userid);
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM vwdanismandanisan WHERE DanismanUserID=".$userid." and danisanAd like ".$this->db->escape('%'.$search.'%')." or danisanSoyad like ".$this->db->escape('%'.$search.'%')." ORDER BY danisanID desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM vwdanismandanisan WHERE DanismanUserID=".$userid." ORDER BY danisanID desc LIMIT ".$start.",".$length;
    }
    
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
          $geldigirandevu = $cat->geldigi_randevu_sayisi;
 
      

        }else{
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
            $geldigirandevu = $cat->geldigi_randevu_sayisi;

        
        }
        $data .= '["'.$Ad.'","'.$Soyad.'","'.$geldigirandevu.'",
        "  <a href=\"'.site_url('admin/terapi/danisan/danisandetay/').$cat->danisanID.'\"><span title=\"danışan bilgileri\" class=\"glyphicon glyphicon-modal-window\"></span</a><a href=\"'.site_url('admin/terapi/danisan/danisanduzenle/').$cat->danisanID.'\"> </span></a>"],';
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


