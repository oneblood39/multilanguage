<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Cagri_dt extends Admin_Controller
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
    $query = $this->db->query("SELECT COUNT(cagriID) as total FROM tblcagri");
   
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM tblcagri WHERE cagriYapanAd like ".$this->db->escape('%'.$search.'%')." or cagriYapanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapilanAd like ".$this->db->escape('%'.$search.'%')." or cagriTarihSaat like ".$this->db->escape('%'.$search.'%')." or cagriYapilanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapanTel like ".$this->db->escape('%'.$search.'%')." ORDER BY cagriID desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM tblcagri ORDER BY cagriID desc LIMIT ".$start.",".$length;
    }
    
    $query = $this->db->query($queryString);

    $Cagrilar = $query->result();  ////mainCategories olan satır

    $data = '[';

    if($search){
      $rFiltered = 0;
    }else{
      $rFiltered = $total; //filtrelenmiş kayıt sayısı
    }
    $recordsTotal = $total; // toplam kayıt sayısı

    foreach ($Cagrilar as $cat) {      ///mainCategories olan satır  
      if($search){
        $rFiltered++;
      }
          
    // if($search){
       if($cat->cagriID>0){  
         // $parent = $this->db->query("SELECT * FROM products")->row()->product_name;
          $Ad = $cat->cagriYapanAd;
          $Soyad = $cat->cagriYapanSoyad;
          $Yad = $cat->cagriYapilanAd;
          $Ysoyad = $cat->cagriYapilanSoyad;
          $Tel = $cat->cagriYapanTel;

        }else{
          $Ad = $cat->cagriYapanAd;
          $Soyad = $cat->cagriYapanSoyad;
          $Yad = $cat->cagriYapilanAd;
          $Ysoyad = $cat->cagriYapilanSoyad;
          $Tel = $cat->cagriYapanTel;
        }
        $data .= '["'.$cat->cagriTarihSaat.'","'.$Ad.'","'.$Soyad.'","'.$Yad.'","'.$Ysoyad.'","'.$Tel.'"," <a href=\"'.site_url('admin/terapi/cagri/cagridetay/').$cat->cagriID.'\"><span title=\"özellikler\" class=\"glyphicon glyphicon-random\"></span></a>"],';
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


