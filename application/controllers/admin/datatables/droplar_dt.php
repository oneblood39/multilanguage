<?php defined('BASEPATH') OR exit('Bu bölüme erişim engellenmiştir.');

class Droplar_dt extends Admin_Controller
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
     $ofis=$row->company;
    // echo $group_id;
   }

   if($group_id=='11' or $group_id=='9') {
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
    $query = $this->db->query("select count(*) as total from vwdrop where ofisID=".$ofis);
  //  $this->num_rows( );
     $total = $query->row()->total;




if($search){
    $queryString = "select DanismanAd,DanismanSoyad,danisanAd,danisanSoyad,danisanID,DanismanUserID,geldigiRandevuSayisi,sonRandevusu 
                        from vwdrop where ofisID=".$ofis." and 
                        (danisanAd like ".$this->db->escape('%'.$search.'%')." or danisanSoyad like ".$this->db->escape('%'.$search.'%')." or DanismanAd like ".$this->db->escape('%'.$search.'%')." or DanismanSoyad like ".$this->db->escape('%'.$search.'%').") group by  DanismanAd,DanismanSoyad,danisanAd,danisanSoyad 
                        order by DanismanAd,DanismanSoyad,sonRandevusu desc LIMIT ".$start.",".$length;
  }
  else
  {
    $queryString = "select DanismanAd,DanismanSoyad,danisanAd,danisanSoyad,danisanID,DanismanUserID,geldigiRandevuSayisi,sonRandevusu 
                        from vwdrop where ofisID=".$ofis."
                        order by DanismanAd,DanismanSoyad,sonRandevusu desc LIMIT ".$start.",".$length;

  }

  /*  if($search){
      $queryString = "select DanismanAd,DanismanSoyad,danisanAd,danisanSoyad,danisanID,DanismanUserID
,count(randevuID) as geldigiRandevuSayisi
,(select r.randevuBaslangicTarihSaat from vwrandevu r where r.RandevuDurumID=4 and r.ofisID=".$ofis." and r.danisanID=dis.danisanID and r.DanismanUserID=dis.DanismanUserID order by r.randevuBaslangicTarihSaat desc limit 1 ) as sonRandevusu
from vwrandevu dis WHERE RandevuDurumID=4 and ofisID=".$ofis." and (danisanAd like ".$this->db->escape('%'.$search.'%')." or danisanSoyad like ".$this->db->escape('%'.$search.'%')." or DanismanAd like ".$this->db->escape('%'.$search.'%')." or DanismanSoyad like ".$this->db->escape('%'.$search.'%').") group by  DanismanAd,DanismanSoyad,danisanAd,danisanSoyad 
order by DanismanAd,DanismanSoyad,randevuBaslangicTarihSaat desc LIMIT ".$start.",".$length;
    }else{
      $queryString = "select DanismanAd,DanismanSoyad,danisanAd,danisanSoyad,danisanID,DanismanUserID
,count(randevuID) as geldigiRandevuSayisi
,(select r.randevuBaslangicTarihSaat from vwrandevu r where r.RandevuDurumID=4 and r.ofisID=".$ofis." and r.danisanID=dis.danisanID and r.DanismanUserID=dis.DanismanUserID order by r.randevuBaslangicTarihSaat desc limit 1 ) as sonRandevusu
from vwrandevu dis
where RandevuDurumID=4 and ofisID=".$ofis."
group by  DanismanAd,DanismanSoyad,danisanAd,danisanSoyad 
order by DanismanAd,DanismanSoyad,randevuBaslangicTarihSaat desc LIMIT ".$start.",".$length;

    }*/
    
    $query = $this->db->query($queryString);
    //$total=$this->num_rows($query);
    

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

      $datasessionmevcut = $this->session->flashdata('item'); 

print_r($datasessionmevcut);
          
    // if($search){
       if($cat->danisanID>0){  
          $DanismanUserID=$cat->DanismanUserID;
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
          $Dad = $cat->DanismanAd;
          $Dsoyad = $cat->DanismanSoyad;
          $sonRandevusu = $cat->sonRandevusu;
          $geldigiRandevuSayisi = $cat->geldigiRandevuSayisi;
          if($geldigiRandevuSayisi<4) {
                $dropicon='<span title=\"Drop Et\" class=\"glyphicon glyphicon-circle-arrow-down\"></span>';
              } else { $dropicon=''; }
    

        }else{
          $DanismanUserID=$cat->DanismanUserID;
          $Ad = $cat->danisanAd;
          $Soyad = $cat->danisanSoyad;
          $Dad = $cat->DanismanAd;
          $Dsoyad = $cat->DanismanSoyad;
          $sonRandevusu = $cat->sonRandevusu;
          $geldigiRandevuSayisi = $cat->geldigiRandevuSayisi;
          if($geldigiRandevuSayisi<4) {
                $dropicon='<span title=\"Drop Et\" class=\"glyphicon glyphicon-circle-arrow-down\"></span>';
              } else { $dropicon=''; }
        }
        $data .= '["'.$Ad.'","'.$Soyad.'","'.$Dad.'","'.$Dsoyad.'","'.$sonRandevusu.'","'.$geldigiRandevuSayisi.'",
        "  <a href=\"'.site_url('admin/terapi/danisan/drop_neden/').$cat->danisanID.'/'.$DanismanUserID.'\">'.$dropicon.'</a>"],';
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


