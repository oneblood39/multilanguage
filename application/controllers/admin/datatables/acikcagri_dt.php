<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Acikcagri_dt extends Admin_Controller
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
     $company=$this->ion_auth->user()->row()->company;
     $query=$this->db->query('Select * FROM vwusers where id='.$user_id);
     foreach ($query->result() as $row){
     $group_id=$row->group_id;
    // echo $group_id;
   }



   if($group_id=='11' or $group_id=='10' or $group_id=='9') {
    $icon='<span title=\"Randevu ile eşleştir\" class=\"glyphicon glyphicon-random\"></span>';
    $icon2='<span title=\"Düzenle\" class=\"glyphicon glyphicon-pencil\"></span>';
    $icon4='<span title=\"Çağrıyı sonlandır\" class=\"glyphicon glyphicon-ok\"></span>';

   } else {
     $icon='';
     $icon2='';
     $icon4='';
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
   if($company=='3') {  $query = $this->db->query("SELECT COUNT(cagriID) as total FROM vwcagri where cagriDurumu=1");   } else {
    $query = $this->db->query("SELECT COUNT(cagriID) as total FROM vwcagri where cagriDurumu=1 and ofisID=".$company);
   }
    
   
    $total = $query->row()->total;

    if($search){
       if ($company=='3') {       $queryString = "SELECT * FROM vwcagri WHERE cagriDurumu=1 and (cagriYapanAd like ".$this->db->escape('%'.$search.'%')." or cagriYapanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapilanAd like ".$this->db->escape('%'.$search.'%')." or cagriTarihSaat like ".$this->db->escape('%'.$search.'%')." or cagriYapilanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapanTel like ".$this->db->escape('%'.$search.'%').") ORDER BY cagriID desc LIMIT ".$start.",".$length; }  else {  
          
                 $queryString = "SELECT * FROM vwcagri WHERE  ofisID=".$company." and cagriDurumu=1 and (cagriYapanAd like ".$this->db->escape('%'.$search.'%')." or cagriYapanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapilanAd like ".$this->db->escape('%'.$search.'%')." or cagriTarihSaat like ".$this->db->escape('%'.$search.'%')." or cagriYapilanSoyad like ".$this->db->escape('%'.$search.'%')." or cagriYapanTel like ".$this->db->escape('%'.$search.'%').") ORDER BY cagriID desc LIMIT ".$start.",".$length;
          }

    }else{
         if ($company=='3') {  $queryString = "SELECT * FROM vwcagri where cagriDurumu=1 ORDER BY cagriID desc LIMIT ".$start.",".$length;  }
         else { $queryString = "SELECT * FROM vwcagri where ofisID=".$company." and cagriDurumu=1  ORDER BY cagriID desc LIMIT ".$start.",".$length; }
      
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
          $yakinlik=$cat->cagriYakinlikAdi;
          $neden=$cat->randevuyaDonusmemeNedeni;
          $kaynak=$cat->cagriYonlenmeAdi;
          $tarih=$cat->randevuBaslangicTarihSaat;
          $durum=$cat->randevuDurumAdi;
          $dizi=explode(' ', $tarih);
          $tarih=$dizi[0];
          $metin=explode('-', $tarih);
         // $tarihson=$metin[2];
          $danismanAd=$cat->danismanAd;
          $danismanSoyad=$cat->danismanSoyad;
          if($tarih!='') {
          
                 if($group_id=='11' or $group_id=='10' or $group_id=='9') {

               $icon3='<span title=\"randevu ile eşleme kaldır\" class=\"glyphicon glyphicon-remove\"></span>'; 
              } else {
                 $icon3='';
  
   }


        } else { $icon3=''; }

        }else{

          $Ad = $cat->cagriYapanAd;
          $Soyad = $cat->cagriYapanSoyad;
          $Yad = $cat->cagriYapilanAd;
          $Ysoyad = $cat->cagriYapilanSoyad;
          $Tel = $cat->cagriYapanTel;
          $yakinlik=$cat->cagriYakinlikAdi;
          $neden=$cat->randevuyaDonusmemeNedeni;
          $kaynak=$cat->cagriYonlenmeAdi;
          $tarih=$cat->randevuBaslangicTarihSaat;
          $durum=$cat->randevuDurumAdi;
          $dizi=explode(' ', $tarih);
          $tarih=$dizi[0];
          $metin=explode('-', $tarih);
         // $tarihson=$metin[2];
          $danismanAd=$cat->danismanAd;
          $danismanSoyad=$cat->danismanSoyad;
                   if($tarih!='') {
          
                 if($group_id=='11' or $group_id=='10' or $group_id=='9') {

               $icon3='<span title=\"randevu ile eşleme kaldır\" class=\"glyphicon glyphicon-remove\"></span>'; 
              } else {
                 $icon3='';
  
   }


        } else { $icon3=''; }
        
        }
        $data .= '["'.$cat->dateCreated.'","'.$Ad.'","'.$Soyad.'","'.$Yad.'","'.$Ysoyad.'","'.$Tel.'","'.$yakinlik.'","'.$neden.'"," <a href=\"'.site_url('admin/terapi/cagri/randevueslestir/').$cat->cagriID.'\">'.$icon.'</a>  <a href=\"'.site_url('admin/terapi/cagri/bireyselcagriduzenle/').$cat->cagriID.'\">'.$icon2.'</a> <a href=\"'.site_url('admin/terapi/cagri/cagrikapama/').$cat->cagriID.'\">'.$icon4.'</a> <a href=\"'.site_url('admin/terapi/cagri/randevueslemesil/').$cat->cagriID.'\">'.$icon3.'</a> "],';
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


