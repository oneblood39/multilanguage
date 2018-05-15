<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Ilac_dt extends Admin_Controller
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

   if($group_id=='11' or $group_id=='10' or $group_id=='9') {
    $icon='<span title=\"randevu ile eşleştir\" class=\"glyphicon glyphicon-random\"></span>';
    $icon2='<span title=\"düzenle\" class=\"glyphicon glyphicon-pencil\"></span>';
   } else {
     $icon='';
     $icon2='';
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
    $query = $this->db->query("SELECT COUNT(psikiyatriilacID) as total FROM tnmpsikiyatriilac");
   
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM tnmpsikiyatriilac WHERE psikiyatriilacAdi like ".$this->db->escape('%'.$search.'%')."  ORDER BY psikiyatriilacID desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM tnmpsikiyatriilac ORDER BY psikiyatriilacID desc LIMIT ".$start.",".$length;
    }
    
    $query = $this->db->query($queryString);

    $ilaclar = $query->result();  ////mainCategories olan satır

    $data = '[';

    if($search){
      $rFiltered = 0;
    }else{
      $rFiltered = $total; //filtrelenmiş kayıt sayısı
    }
    $recordsTotal = $total; // toplam kayıt sayısı

    foreach ($ilaclar as $cat) {      ///mainCategories olan satır  
      if($search){
        $rFiltered++;
      }
          
    // if($search){



       if($cat->psikiyatriilacID>0){  
         // $parent = $this->db->query("SELECT * FROM products")->row()->product_name;
          $ilacID = $cat->psikiyatriilacID;
          $ilacAdi = $cat->psikiyatriilacAdi;
          $toplamdoz = $cat->kutuDozMiktari;
          $tarih = $cat->dateCreated;


        }else{

          $ilacID = $cat->psikiyatriilacID;
          $ilacAdi = $cat->psikiyatriilacAdi;
          $toplamdoz = $cat->kutuDozMiktari;
          $tarih = $cat->dateCreated;

        
        }
        $data .= '["'.$tarih.'","'.$ilacID.'","'.$ilacAdi.'","'.$toplamdoz.'","  <a href=\"'.site_url('admin/terapi/cagri/bireyselcagriduzenle/').$cat->psikiyatriilacID.'\">'.$icon2.'</a> "],';
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


