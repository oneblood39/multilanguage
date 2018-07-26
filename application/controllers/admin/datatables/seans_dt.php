<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Seans_dt extends Admin_Controller
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

        $this->data['users'] = $this->ion_auth->users(array())->result();
     $user_id=$this->ion_auth->user()->row()->id;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;
    // echo $group_id;
   }

   if($group_id=='11' or $group_id=='9' or $group_id=='10') {
    $icon='<span title=\"danışan ile eşleştir\" class=\"glyphicon glyphicon-random\"></span>';
    $icon2='<span title=\"paketten randevu çıkar\" class=\"glyphicon glyphicon-arrow-down\"></span>';
    $icon3='<span title=\"Paket Düzenle\" class=\"glyphicon glyphicon-pencil\"></span>';
   } else {
     $icon='';
     $icon2='';
     $icon3='';
   }

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
    $query = $this->db->query("SELECT COUNT(paketID) as total FROM tblpaket");
   
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM tblpaket WHERE paketNo like ".$this->db->escape('%'.$search.'%')." or paketAdi like ".$this->db->escape('%'.$search.'%')." or paketUcret like ".$this->db->escape('%'.$search.'%')." or paketSeansSayi like ".$this->db->escape('%'.$search.'%')." ORDER BY paketID desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM tblpaket ORDER BY paketID desc LIMIT ".$start.",".$length;
    }
    
    $query = $this->db->query($queryString);

    $Paketler = $query->result();  ////mainCategories olan satır

    $data = '[';

    if($search){
      $rFiltered = 0;
    }else{
      $rFiltered = $total; //filtrelenmiş kayıt sayısı
    }
    $recordsTotal = $total; // toplam kayıt sayısı

    foreach ($Paketler as $cat) {      ///mainCategories olan satır  
      if($search){
        $rFiltered++;
      }
          
    // if($search){
       if($cat->paketID>0){  
         // $parent = $this->db->query("SELECT * FROM products")->row()->product_name;
          $paketid = $cat->paketID;
          $paketno = $cat->paketNo;
          $paketAdi = $cat->paketAdi;
          $paketUcret = $cat->paketUcret;
          $paketSeansSayi = $cat->paketSeansSayi;
          $minseans = $cat->minimumSeansSayisi;

        }else{
          $paketid = $cat->paketID;
          $paketno = $cat->paketNo;
          $paketAdi = $cat->paketAdi;
          $paketUcret = $cat->paketUcret;
          $paketSeansSayi = $cat->paketSeansSayi;
          $minseans = $cat->minimumSeansSayisi;        
        }
        $data .= '["'.$paketid.'","'.$paketAdi.'","'.$paketUcret.'","'.$paketSeansSayi.'","'.$minseans.'"," <a href=\"'.site_url('admin/terapi/seans/paketdanisan/').$cat->paketID.'\">'.$icon.'</a> <a href=\"'.site_url('admin/terapi/seans/randevucikar/').$cat->paketID.'\">'.$icon2.'</a> <a href=\"'.site_url('admin/terapi/seans/paketduzenle/').$cat->paketID.'\">'.$icon3.'</a>"],';
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


