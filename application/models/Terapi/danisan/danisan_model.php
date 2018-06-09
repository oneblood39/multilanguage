<?php

defined('BASEPATH') OR exit('No direct script access allowed');
////kullanıcı Grupları sayfa fonksiyonları
class Danisan_model extends MY_Model
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

    public function createDanisan (){ ///yeni danisan ekleme
       //$group_id = $this->uri->segment(4);
   
            $data = array(
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel'),
                    'danisanEposta' => $this->input->post('eposta'),
                    'danisanTestMizacTipID' => $this->input->post('mizac'),
                    'danisanTip' => $this->input->post('danisantip'),
                    'islemKullaniciID' => $this->input->post('userid')
                );
           // print_r($data);

            $ad=$this->input->post('ad');
            $soyad=$this->input->post('soyad');

    $sql = "SELECT * FROM tbldanisan WHERE  danisanAd='".$ad."' and danisanSoyad='".$soyad."'";
    $results = $this->db->query($sql)->result();
    $sayi= $this->db->query($sql)->num_rows();

        if ($sayi>'0') {  
      $this->load->library('session');
      $this->session->set_flashdata('item', $data);

foreach ($results as $result) {
  $es_ad=$result->danisanAd;
  $es_soyad=$result->danisanSoyad;
  $es_tel=$result->danisanTel;
  $es_posta=$result->danisanEposta;
}

    
 /* echo '<br><br><br><br>Bu isim ve soyisme ait bir danisan var.<br><a href="">Detayı Göster</a><br>
        <a href="../danisan/lastcreate">Kaydet</a>'; 
       $this->postal->add('
   
        ',' success');*/
       $this->postal->add('Kayıtlı olan mevcut kullanıcı:<br>'.$es_ad.' '.$es_soyad.'<br>Tel:'.$es_tel.'<br>Mail:'.$es_posta.'    <center> Bu isim ve soyisme ait bir danışan var!</center><br>
        <a href="../danisan/lastcreate">Kaydet</a><br>
        <a href="../danisan">İptal</a>','success');
          //  redirect('admin/terapi/danisan/','refresh');
    // redirect('admin/terapi/danisan/create');
          }

      else { 
            
            $this->db->insert("tbldanisan",$data);
            $this->postal->add('Danışan Ekleme Başarılı!','success');
            redirect('admin/terapi/danisan/','refresh');
       } 


    }

   
    public function createDanisanLast (){ ///yeni danisan ekleme
    $data = $this->session->flashdata('item');
    //print_r($data);
     $this->db->insert("tbldanisan",$data);
     $this->postal->add('Danışan Ekleme Başarılı!','success');
     redirect('admin/terapi/danisan/','refresh');
 
   }

public function getDanisan($danisanID){ /////////editte kullandığımız 

    if($danisanID && (int)$danisanID>0){
      $this->db->where('danisanID', $danisanID);
      $result = $this->db->get('tbldanisan')->result()[0];
      return $result;
    }else{
      return false;
    }
    return false;
  }

  public function danisanupdate(){
$danisan_id=$this->input->post('danisanID');

            $data = array(
                    'danisanAd' => $this->input->post('ad'),
                    'danisanSoyad' => $this->input->post('soyad'),
                    'danisanTel' => $this->input->post('tel'),
                    'danisanEposta' => $this->input->post('eposta'),
                    'danisanTestMizacTipID' => $this->input->post('mizac')
                );

$sql="INSERT INTO arstbldanisan (
     danisanID ,
    danisanAd ,
    danisanSoyad ,
    danisanEposta ,
    danisanTel ,
    danisanTestMizacTipID ,
    danisanUzmanMizacTipID ,
    islemKullaniciID ,
    dateCreated)
SELECT  danisanID ,
    danisanAd ,
    danisanSoyad ,
    danisanEposta ,
    danisanTel ,
    danisanTestMizacTipID ,
    danisanUzmanMizacTipID ,
    islemKullaniciID ,
    dateCreated
FROM tbldanisan
WHERE danisanID=".$danisan_id;

if ($this->db->query($sql)) {
 $this->db->where('danisanID', $danisan_id);
 $this->db->update('tbldanisan',$data);
 $this->postal->add('Danışan güncelleme başarılı!','success');
 redirect('admin/terapi/danisan');
} else {
 $this->postal->add('Danışan güncelleme başarılı değil!','error');
redirect('admin/terapi/danisan');
}


  }


public function notkaydet () {

  $datakayit=   array(
    'seansNot' => $this->input->post('not'),
    'sonrakiSeansNot' => $this->input->post('geleceknot'),
    'danisanID' => $this->input->post('danisanid'),
    'islemKullaniciID' => $this->input->post('userid')
   );
  $danisan_id=$this->input->post('danisanid');

//print_r($datakayit);
    $this->db->insert("ilsdanisanseansnot",$datakayit);
    $this->postal->add('Danışan Notu Ekleme Başarılı!','success');
    redirect('admin/terapi/danisan/danisandetay/'.$danisan_id,'refresh');

}

public function ilackaydet () {
    $datakayit=   array(
    'ilacAciklama' => $this->input->post('ilac'),
    'ilacTip' => 2,
    'danisanID' => $this->input->post('danisanid'),
    'islemKullaniciID' => $this->input->post('userid')
   );
  $danisan_id=$this->input->post('danisanid');
   // print_r($datakayit);
    $this->db->insert("ilsdanisanilac",$datakayit);
    $this->postal->add('Danışana İlaç Ekleme Başarılı!','success');
    redirect('admin/terapi/danisan/danisandetay/'.$danisan_id,'refresh');


}

public function tanikaydet () {
    $datakayit=   array(
    'taniAciklama' => $this->input->post('tani'),
    'taniID' => $this->input->post('alttanilar'),
    'danisanID' => $this->input->post('danisanid'),
    'islemKullaniciID' => $this->input->post('userid')
   );
  $danisan_id=$this->input->post('danisanid');
   // print_r($datakayit);
    $this->db->insert("ilsdanisantani",$datakayit);
    $this->postal->add('Danışana Tanı Ekleme Başarılı!','success');
    redirect('admin/terapi/danisan/danisandetay/'.$danisan_id,'refresh');

}

 public function gettestlerForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmpsikolojiktest')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->psikolojikTestID] = $result->psikolojikTestAdi;
    }

    return $dropdown;
  }


  public function testkaydet () {
    $datakayit=   array(
    'test' => $this->input->post('testler'),
    'danisanID' => $this->input->post('danisanid'),
    'islemKullaniciID' => $this->input->post('userid')
   );
   $danisan_id=$this->input->post('danisanid');
   // print_r($datakayit);
    $this->db->insert("tbldanisantest",$datakayit);
    $this->postal->add('Danışana Test Atama Başarılı!','success');
    redirect('admin/terapi/danisan/danisandetay/'.$danisan_id,'refresh');
}

 public function seansnotguncelle () {
    $datakayit=   array(
    'seansNot' => $this->input->post('not'),
    'sonrakiSeansNot' => $this->input->post('geleceknot'),
    'islemKullaniciID' => $this->input->post('userid'),
    'danismanUserID' => $this->input->post('userid')
   );

    $seansnot_id=$this->input->post('seansnotid');

 $this->db->where('danisanSeansNotID', $seansnot_id);
 $this->db->update('ilsdanisanseansnot',$datakayit);
 $this->postal->add('Seans notu güncelleme başarılı!','success');
 redirect('admin/terapi/danisan/'); //////yarın bak aq
}

 public function getilaclarForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmpsikiyatriilac')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->psikiyatriilacID] = $result->psikiyatriilacAdi;
    }

    return $dropdown;
  }

   public function getdozlarForDropdown($firstElement=array()){
    $results = $this->db->query('SELECT * FROM tnmilacdoz')->result();
    $dropdown = array();

    if($firstElement){
      $dropdown[$firstElement[0]] = $firstElement[1];
    }

    foreach ($results as $result) {
      $dropdown[$result->ilacDozID] = $result->ilacDozAdi;
    }

    return $dropdown;
  }

  public function psikiyatrikilackaydet () {
    $datakayit=   array(
    'ilacTip' => 1,
    'psikiyatriilacID' => $this->input->post('ilac'),
    'ilacDozID' => $this->input->post('doz'),
    'ilacAciklama' => $this->input->post('aciklama'),
    'islemKullaniciID' => $this->input->post('userid'),
    'danisanID' => $this->input->post('danisanid')
   );

   $danisan_id=$this->input->post('danisanid');

    $this->db->insert("ilsdanisanilac",$datakayit);
    $this->postal->add('Danışana İlaç Atama Başarılı!','success');
    redirect('admin/terapi/danisan/danisandetay/'.$danisan_id,'refresh');


  }



  public function psikiyatrikilacguncelle () {
   $datakayit=   array(
    'ilacTip' => 1,
    'psikiyatriilacID' => $this->input->post('ilac'),
    'ilacDozID' => $this->input->post('doz'),
    'ilacAciklama' => $this->input->post('aciklama'),
    'islemKullaniciID' => $this->input->post('userid'),
    'danisanID' => $this->input->post('danisanid')
   );

  $danisanilacID=$this->input->post('danisanilacID');
  $danisanid=$this->input->post('danisanid');

 $this->db->where('danisanilacID', $danisanilacID);
 $this->db->update('ilsdanisanilac',$datakayit);
 $this->postal->add('Psikiyatrik ilaç güncelleme başarılı!','success');
 redirect('admin/terapi/danisan/danisandetay/'.$danisanid); ///

  }

  public function ilacguncelle () {
       $datakayit=   array(
    'ilacAciklama' => $this->input->post('ilac'),
    'islemKullaniciID' => $this->input->post('userid')
   );
      $danisanilacID=$this->input->post('danisanilacid'); 
      $danisanid=$this->input->post('danisanid'); 

 $this->db->where('danisanilacID', $danisanilacID);
 $this->db->update('ilsdanisanilac',$datakayit);
 $this->postal->add('İlaç güncelleme başarılı!','success');
 redirect('admin/terapi/danisan/danisandetay/'.$danisanid); 

  }

  public function taniguncelle () {
  $datakayit=   array(
    'taniID' => $this->input->post('alttanilar'),
    'taniAciklama' => $this->input->post('tani'),
    'islemKullaniciID' => $this->input->post('userid')
   );
      $danisantaniid=$this->input->post('danisantaniid'); 
      $danisanid=$this->input->post('danisanid'); 


 $this->db->where('danisantaniID', $danisantaniid);
 $this->db->update('ilsdanisantani',$datakayit);
 $this->postal->add('Tanı güncelleme başarılı!','success');
 redirect('admin/terapi/danisan/danisandetay/'.$danisanid); 

  }

}