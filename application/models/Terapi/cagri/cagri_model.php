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
                    'cagriYapanEposta' => $this->input->post('eposta'),
                    'cagriAciklama' => $this->input->post('info'),
                    'islemKullaniciID' => $this->input->post('id'),
                    'ofisID' => $this->input->post('ofisID'),
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
    $results = $this->db->query('SELECT * FROM tnmcagrinedeni')->result();
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


   public function getOfis($ofisID){ /////////editte kullandığımız 

    if($ofisID && (int)$ofisID>0){
      $this->db->where('ofisID', $ofisID);
      $result = $this->db->get('tblOfis')->result()[0];
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




}