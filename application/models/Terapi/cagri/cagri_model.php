<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Cagri_model extends MY_Model
{
    public $table = 'menus';
    public $primary_key = 'id';

    public function __construct()
    {
        $this->has_many['items'] = array('Menu_item_model','menu_id','id');
        $this->pagination_delimiters = array('<li>','</li>');
        $this->pagination_arrows = array('<span aria-hidden="true">&laquo;</span>','<span aria-hidden="true">&raquo;</span>');
        parent::__construct();
    }

    public $rules = array(
        'insert' => array(
            'title' => array('field'=>'title','label'=>'Title','rules'=>'trim|required')
        ),
        'update' => array(
            'title' => array('field'=>'title','label'=>'Title','rules'=>'trim|required'),
            'menu_id' => array('field'=>'menu_id', 'label'=>'ID', 'rules'=>'trim|is_natural_no_zero|required')
        )
    );



    public function bireyselcagrikaydet ($data) {

    
//echo '<br><br><br><br>';
     
                $data = array(
                    'cagriYapanAd' => $this->input->post('ad'),
                    'cagriYapanSoyad' => $this->input->post('soyad'),
                    'cagriYapilanAd' => $this->input->post('cad'),
                    'cagriYapilanSoyad' => $this->input->post('csoyad'),
                    'cagriYonlenmeID' => $this->input->post('cagriyonlenme'),
                    'cagriYakinlikID' => $this->input->post('cagriyakinlik'),
                    'cagriNedeniID' => $this->input->post('cagrineden'),
                    'talepDanismanUserID' => $this->input->post('danisman'),
                    'cagriYapanEposta' => $this->input->post('eposta'),
                    'cagriAciklama' => $this->input->post('info'),
                    'islemKullaniciID' => $this->input->post('id'),
                    'ofisID' => $this->input->post('ofisID'),
                    'cagriDurumu' => 1,
                    'cagriYapanTel' => $this->input->post('tel'),
                    'cagriTipi' => $this->input->post('cagritipi')
                   
                );
         // print_r($data);
          //  echo '<br>';

         $this->db->insert("tblcagri",$data); 
         $this->postal->add('Bireysel Çağrı Ekleme Başarılı!','success');
         redirect('admin/terapi/cagri/','refresh');  


}

  public function getcagrinedenForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmcagrinedeni where aktifMi=1 order by cagriNedeniAdi')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->cagriNedeniID] = $result->cagriNedeniAdi;
    }

    return $dropdown;
  }

    public function getcagriyonlenmeForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmcagriyonlenme')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->cagriYonlenmeID] = $result->cagriYonlenmeAdi;
    }

    return $dropdown;
  }

   public function getcagriyakinlikForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmcagriyakinlik')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->cagriYakinlikID] = $result->cagriYakinlikAdi;
    }

    return $dropdown;
  }

    public function getdanismanForDropdown($firstElement=array(),$ofisID){
   if($ofisID=='3') { 
   $results = $this->db->query('SELECT ID,DanismanAd,DanismanSoyad FROM vwdanisman')->result();
   }  else { 
       $results = $this->db->query('SELECT ID,DanismanAd,DanismanSoyad FROM vwdanisman where ofisID='.$ofisID.' or ofisID=3 order by DanismanAd asc')->result();
   }

    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->ID] = $result->DanismanAd.' '.$result->DanismanSoyad;
    }

    return $dropdown;
  }


  public function getOfis($ofisID){ 
   if($ofisID && (int)$ofisID>0){
      $this->db->where('ofisID', $ofisID);
      $result = $this->db->get('tblOfis')->result()[0];
      return $result;
    }else{
      return false;
    }
    return false;
  }


  public function getCagri($cagriID){ 

    if($cagriID && (int)$cagriID>0){
      $this->db->where('cagriID', $cagriID);
      $result = $this->db->get('tblcagri')->result()[0];

      return $result;
    }else{
      return false;
    }
    return false;
  }
      
     
public function kurumsalcagrikaydet ($data,$id = NULL) {
    
//echo '<br><br><br><br>';
                $data = array(
                    'cagriKurum' => $this->input->post('kurum'),
                    'cagriIrtibatAd' => $this->input->post('ad'),
                    'cagriIrtibatSoyad' => $this->input->post('soyad'),
                    'cagriIrtibatTel' => $this->input->post('tel'),
                    'cagriIrtibatEposta' => $this->input->post('eposta'),
                    'cagriKonu' => $this->input->post('info'),
                    'cagriDurum' => $this->input->post('cagritipi'),
                    'cagriOfis' => $this->input->post('ofisID'),
                    'islemKullaniciID' => $this->input->post('id')
                   
                );
//print_r($data);

                $this->db->insert("tblcagrikurumsal",$data);


$sql = "SELECT * FROM tblcagrikurumsal order by cagriKurumsalID desc limit 0,1";
$results = $this->db->query($sql)->result();
         foreach ($results as $result) {
    $cagri_id=$result->cagriKurumsalID;
//    echo '<br><br>'.$cagri_id;
         }

 $data2 = $this->input->post('coklu') ;
 $arraycount=count($data2);


for ($i = 0; $i <= $arraycount-1; $i++) {

  $datasave = array(
   'kurumsalcagriID' => $cagri_id,
   'user_id' => $data2[$i]
  );
//print_r($datasave);
$this->db->insert("ilscagrikullanici",$datasave);
   
}

         $this->postal->add('Kurumsal Çağrı Ekleme Başarılı!','success');
         redirect('admin/terapi/cagri/kurumsalcagri','refresh');  

}



   public function cagriyarandevuata() {
 $randevu_id= $this->uri->segment(5);
 $cagri_id= $this->uri->segment(6);

$data =  array('cagriRandevuID' => $randevu_id ); 

$this->db->where('cagriID', $cagri_id);
$this->db->update('tblcagri',$data);
$this->postal->add('Çağrı randevu ile İlişkilendirildi!','success');
redirect('admin/terapi/cagri/','refresh');
}

 public function bireyselcagriupdate() {
  $cagri_id=$this->input->post('cagriID');

$data = array (
'cagriYapanAd' => $this->input->post('ad'),
'cagriYapanSoyad' => $this->input->post('soyad'),
'cagriYapilanAd' => $this->input->post('cad'),
'cagriYapilanSoyad' => $this->input->post('csoyad'),
'cagriYapanTel' => $this->input->post('tel'),
'cagriYapanEposta' => $this->input->post('eposta'),
'cagriYakinlikID' => $this->input->post('cagriyakinlik'),
'cagriYonlenmeID' => $this->input->post('cagriyonlenme'),
'cagriNedeniID' => $this->input->post('cagrineden'),
'talepDanismanUserID' => $this->input->post('danisman'),
'cagriAciklama' => $this->input->post('info'),
'islemKullaniciID' => $this->input->post('id')      
);

$sql="insert into arstblcagri (cagriID , 
cagriTarihSaat , 
cagriTipi , 
cagriYapanAd ,
cagriYapanSoyad ,
cagriYakinlikID ,
cagriYapilanAd , 
cagriYapilanSoyad ,
cagriYonlenmeID ,
cagriNedeniID ,
cagriRandevuID ,
cagriYapanTel ,
cagriYapanEposta , 
cagriAciklama ,
talepDanismanUserID ,
ofisID , 
cagriDurumu ,
randevuyaDonusmeDurumu,
cagriRandevuyaDonusmemeNedeniID ,
randevuyaDonusmemeNedeni,
islemKullaniciID,dateCreated )
select * from tblcagri where tblcagri.cagriID=".$cagri_id;

if ($this->db->query($sql)) {
 $this->db->where('cagriID', $cagri_id);
 $this->db->update('tblcagri',$data);
 $this->postal->add('Çağrı güncelleme başarılı!','success');
 redirect('admin/terapi/cagri');
} else {
 $this->postal->add('Çağrı güncelleme başarılı değil!','error');
redirect('admin/terapi/cagri');
}

 }

 public function cagridanrandevukaldir() {
 $cagri_id= $this->uri->segment(5);
//echo $cagri_id;

$datakayit = array(
  'cagriRandevuID' => NULL, 
  'randevuyaDonusmeDurumu' => 2 
   );

 $this->db->where('cagriID', $cagri_id);
 $this->db->update('tblcagri',$datakayit);
 $this->postal->add('Çağrı ile randevu eşleştirme kaldırıldı!','success');
 redirect('admin/terapi/cagri');

}

public function cagrisonlandir () {
$cagri_id=$this->input->post('cagriID');
                  $datakayit = array(
                    'cagriDurumu' => $this->input->post('cagridurum'),
                    'randevuyaDonusmeDurumu' => $this->input->post('randevudurumu'),
                    'cagriRandevuyaDonusmemeNedeniID' => $this->input->post('nedeni'),
                    'randevuyaDonusmemeNedeni' => $this->input->post('info')                   
                );
//print_r($datakayit);
$this->db->where('cagriID', $cagri_id);
$this->db->update('tblcagri',$datakayit);
$this->postal->add('Çağrı sonlandırıldı!','success');
 redirect('admin/terapi/cagri');


}


}