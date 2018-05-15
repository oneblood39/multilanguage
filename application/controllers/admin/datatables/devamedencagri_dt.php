<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Devamedencagri_dt extends Admin_Controller
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
    $query = $this->db->query("SELECT COUNT(cagriKurumsalID) as total FROM tblcagrikurumsal WHERE cagriDurum='1'");
   
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM tblcagrikurumsal WHERE cagriDurum='1' and cagriKurum like ".$this->db->escape('%'.$search.'%')." or cagriIrtibatAd like ".$this->db->escape('%'.$search.'%')." or cagriIrtibatSoyad like ".$this->db->escape('%'.$search.'%')." or cagriKonu like ".$this->db->escape('%'.$search.'%')." or cagriIrtibatTel like ".$this->db->escape('%'.$search.'%')." or cagriIrtibatEposta like ".$this->db->escape('%'.$search.'%')." ORDER BY cagriKurumsalID desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM tblcagrikurumsal where cagriDurum='1' ORDER BY cagriKurumsalID desc LIMIT ".$start.",".$length;
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
       if($cat->cagriKurumsalID>0){  
         // $parent = $this->db->query("SELECT * FROM products")->row()->product_name;
          $Kurum = $cat->cagriKurum;
          $Ad = $cat->cagriIrtibatAd;
          $Soyad = $cat->cagriIrtibatSoyad;
          $Konu = $cat->cagriKonu;
          $Tel = $cat->cagriIrtibatTel;
          $Eposta=$cat->cagriIrtibatEposta;
           $durum=$cat->cagriDurum;
          if($durum=='1') { $durum='Devam Eden';} else { $durum='Tamamlandı'; }
  



        }else{
          $Kurum = $cat->cagriKurum;
          $Ad = $cat->cagriIrtibatAd;
          $Soyad = $cat->cagriIrtibatSoyad;
          $Konu = $cat->cagriKonu;
          $Tel = $cat->cagriIrtibatTel;
          $Eposta=$cat->cagriIrtibatEposta;
           $durum=$cat->cagriDurum;
          if($durum=='1') { $durum='Devam Eden';} else { $durum='Tamamlandı'; }
        
        }
        $data .= '["'.$cat->dateCreated.'","'.$Kurum.'","'.$Ad.'","'.$Soyad.'","'.$Konu.'","'.$Tel.'","'.$Eposta.'","'.$durum.'"," <a href=\"'.site_url('admin/terapi/cagri/cagridetay/').$cat->cagriKurumsalID.'\"></a>"],';
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


