<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Mazeretler_dt extends Admin_Controller
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
    $query = $this->db->query("SELECT COUNT(danismanMazeretID) as total FROM vwdanismanmazeret");
   
    $total = $query->row()->total;

    if($search){
      $queryString = "SELECT * FROM vwdanismanmazeret WHERE DanismanAd like ".$this->db->escape('%'.$search.'%')." or DanismanSoyad like ".$this->db->escape('%'.$search.'%')." or mazeretAdi like ".$this->db->escape('%'.$search.'%')." or mazeretAciklama like ".$this->db->escape('%'.$search.'%')." ORDER BY mazeretBaslangicTarihSaat desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "SELECT * FROM vwdanismanmazeret ORDER BY danismanMazeretID desc LIMIT ".$start.",".$length;
    }
    
    $query = $this->db->query($queryString);

    $Mazeretler = $query->result();  ////mainCategories olan satır

    $data = '[';

    if($search){
      $rFiltered = 0;
    }else{
      $rFiltered = $total; //filtrelenmiş kayıt sayısı
    }
    $recordsTotal = $total; // toplam kayıt sayısı

    foreach ($Mazeretler as $cat) {      
      if($search){
        $rFiltered++;
      }

      //$datasessionmevcut = $this->session->flashdata('item'); 

//print_r($datasessionmevcut);
          
    // if($search){
       if($cat->danismanMazeretID>0){  
       
          $Ad = $cat->DanismanAd;
          $Soyad = $cat->DanismanSoyad;
          $baslangic = $cat->mazeretBaslangicTarihSaat;
          $bitis = $cat->mazeretBitisTarihSaat;
          $mazeret = $cat->mazeretAdi;
          $aciklama = $cat->mazeretAciklama;
          $aktiflik = $cat->aktifMi;
      
      if ($aktiflik=='1' and $group_id=='11' or $group_id=='9') { 
       
        $span='<span title=\"mazeret pasif et\" class=\"glyphicon glyphicon-arrow-down\">'; 
     
      } else if ($aktiflik=='0' and $group_id=='11' or $group_id=='9') {
     
       $span='<span title=\"mazeret aktif et\" class=\"glyphicon glyphicon-arrow-up\">'; 

     } else { $span=''; }

        }else{
          $Ad = $cat->DanismanAd;
          $Soyad = $cat->DanismanSoyad;
          $baslangic = $cat->mazeretBaslangicTarihSaat;
          $bitis = $cat->mazeretBitisTarihSaat;
          $mazeret = $cat->mazeretAdi;
          $aciklama = $cat->mazeretAciklama;
          $aktiflik = $cat->aktifMi;
      
      if ($aktiflik=='1' and $group_id=='11' or $group_id=='9') { 
       
        $span='<span title=\"mazeret pasif et\" class=\"glyphicon glyphicon-arrow-down\">'; 
     
      } else if ($aktiflik=='0' and $group_id=='11' or $group_id=='9') {
     
       $span='<span title=\"mazeret aktif et\" class=\"glyphicon glyphicon-arrow-up\">'; 

     } else { $span=''; }

        
        }
        $data .= '["'.$Ad.'","'.$Soyad.'","'.$baslangic.'","'.$bitis.'","'.$mazeret.'","'.$aciklama.'", 
        "<a href=\"'.site_url('admin/terapi/randevu/mazeretdurumdegistir/').$cat->danismanMazeretID.'\">'.$span.' </a> "],';
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


//////<a href=\"'.site_url('admin/terapi/randevu/mazeretduzenle/').$cat->DanismanAd.'\"> <span title=\"mazeret düzenleme\" class=\"glyphicon glyphicon-pencil\"></span></a>