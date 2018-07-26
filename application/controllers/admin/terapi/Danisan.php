<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Danisan extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('terapi/danisan/danisan_model');
       /* if(!$this->ion_auth->in_group('admin','member'))
        {
            $this->session->set_flashdata('message','Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.');
            redirect('admin','refresh');
        }*/
    }

    public function index($datas = NULL) ///index sayfası
    {
        $this->data['page_title'] = 'Danişan Takip';
         $this->load->library('session');
        $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#danisanListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/danisan_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';


                $data = array(                  
                    'DanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time')                                    
                );
                $date = $this->input->post('date');
                $time =$this->input->post('time');
                $danismanID = $this->input->post('danismanID');

   //   echo $this->session->userdata('randevuDanismanID'); 

        $this->render('admin/terapi/danisan/index_view','admin_master',$this->data);
	}


        public function indexrandevuekle($datas = NULL) ///çağrılar index sayfası
    {
        $this->data['page_title'] = 'Danişan Takip';
        $this->load->library('session');
        $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#danisanListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/randevudanisan_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

                $data = array(
                  
                    'DanismanID' => $this->input->post('danismanID'),                  
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time')
                                     
                );
                $date = $this->input->post('date');
                $time =$this->input->post('time');
                $danismanID = $this->input->post('danismanID');

    //  echo $this->session->userdata('randevuDanismanID'); 

        $this->render('admin/terapi/danisan/index_view','admin_master',$this->data);
    }


      public function create()   /////danisan ekleme sayfası
    {
     
        $this->data['page_title'] = 'Danışan Ekle';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('ad','Ad','required');
        $this->form_validation->set_rules('soyad','Soyad','trim|required');
        $this->form_validation->set_rules('tel','Tel','trim|numeric|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('eposta','E-Posta','trim|valid_email');
        $this->form_validation->set_error_delimiters('<br><b><font color="#FF0000">', '</font></b>');
        $this->form_validation->set_message('required', 'Bu alanı doldurmak zorundasınız!');
        $this->form_validation->set_message('min_length', 'Bu alan minimum 10 karakter olmalı!');
        $this->form_validation->set_message('max_length', 'Bu alan maximum 10 karakter olmalı!');
        $this->form_validation->set_message('valid_email', 'Geçerli bir eposta adresi değil!');
        $this->form_validation->set_message('numeric', 'Bu alan sayılardan oluşmalı!');

        if($this->form_validation->run()===FALSE)
        {
            //$this->data['groups'] = $this->ion_auth->groups()->result();
            $this->load->helper('form');
           // 
        }
        else
        {
        $this->danisan_model->createDanisan($this->input->post());
      //  $this->render('admin/terapi/danisan/create_view');

        }
       $this->render('admin/terapi/danisan/create_view','admin_master',$this->data);

    }


    public function lastcreate ($data=array())    /////danisan ekleme
    {

  $this->danisan_model->createDanisanLast();
   }

   public function danisandetay ()    /////danisan detayı
   {
    $this->data['before_head'] ='<style>
body {font-family: Arial;}

.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 1170px;
    margin-left:-15px;
}

.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
}

.tab button:hover {
    background-color: #ddd;
}

.tab button.active {
    background-color: #ccc;
}

.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
        width: 1170px;
    margin-left:-15px;
}
</style>';


$this->data['before_body'] ='<script type="text/javascript">
       function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
        </script>';
   $this->render('admin/terapi/danisan/detay_view','admin_master',$this->data);
   }
   
  
  public function danisanduzenle ($danisanID=NULL) {
       $this->data['page_title'] = 'Danışan Düzenle';
       $this->load->library('form_validation');
       $danisan = $this->danisan_model->getDanisan((int) $danisanID);

        $this->form_validation->set_rules('ad','Ad','required');
        $this->form_validation->set_rules('soyad','Soyad','trim|required');
        $this->form_validation->set_rules('tel','Tel','trim|numeric|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('eposta','E-Posta','trim|valid_email');
        $this->form_validation->set_error_delimiters('<br><b><font color="#FF0000">', '</font></b>');
        $this->form_validation->set_message('required', 'Bu alanı doldurmak zorundasınız!');
        $this->form_validation->set_message('min_length', 'Bu alan minimum 10 karakter olmalı!');
        $this->form_validation->set_message('max_length', 'Bu alan maximum 10 karakter olmalı!');
        $this->form_validation->set_message('valid_email', 'Geçerli bir eposta adresi değil!');
        $this->form_validation->set_message('numeric', 'Bu alan sayılardan oluşmalı!');



      if($this->input->post('ad')){
        $this->data['Ad'] = $this->input->post('ad');
      }else{
        $this->data['Ad'] = $danisan->danisanAd;
      }

      if($this->input->post('soyad')){
        $this->data['Soyad'] = $this->input->post('soyad');
      }else{
        $this->data['Soyad'] = $danisan->danisanSoyad;
      }

      if($this->input->post('eposta')){
        $this->data['Eposta'] = $this->input->post('eposta');
      }else{
        $this->data['Eposta'] = $danisan->danisanEposta;
      }

       if($this->input->post('tel')){
        $this->data['Tel'] = $this->input->post('tel');
      }else{
        $this->data['Tel'] = $danisan->danisanTel;
      }

            if($this->input->post('mizac')){
        $this->data['Mizac'] = $this->input->post('mizac');
      }else{
        $this->data['Mizac'] = $danisan->danisanTestMizacTipID;
      }


        //////////////////////form validation script
         if($this->form_validation->run() === FALSE)
        {
            $this->load->helper('form');
          //  $this->render('admin/terapi/cagri/bireysel_edit_view');
        }
        else
        {

               if($this->input->post()){
         $this->danisan_model->danisanupdate($this->input->post());
           }
         
           
            $this->postal->add($this->ion_auth->messages(),'success');
           // redirect('admin/terapi/cagri');
        }
        //////////////////////

      $this->render('admin/terapi/danisan/danisan_edit_view','admin_master',$this->data);  

   }

   public function notekle () {
       $this->data['page_title'] = 'Danışan Notu Ekle';
       $this->load->library('form_validation');
       

   $this->render('admin/terapi/danisan/not_ekle_view','admin_master',$this->data);     
   }

   public function notkaydet () {
   $this->danisan_model->notkaydet($this->input->post());
    }


   public function ilacekle () {
       $this->data['page_title'] = 'İlaç Ekle';
       $this->load->library('form_validation');
   $this->render('admin/terapi/danisan/ilac_ekle_view','admin_master',$this->data);     
   }
  
  public function ilackaydet () {
  $this->danisan_model->ilackaydet($this->input->post());
   }

  public function taniekle () {
       $this->data['page_title'] = 'Tanı Ekle';
       $this->load->library('form_validation');



   $this->data['tanilar'] = $this->danisan_model->gettanilarForDropdown(array("0"," -- "));
   $this->render('admin/terapi/danisan/tani_ekle_view','admin_master',$this->data);     
   }

  public function tanikaydet () {
  $this->danisan_model->tanikaydet($this->input->post());
   }

   public function testekle () {
       $this->data['page_title'] = 'Test Talebinde Bulun';
       $this->load->library('form_validation');

   $this->data['testler'] = $this->danisan_model->gettestlerForDropdown(array());
   $this->render('admin/terapi/danisan/test_ekle_view','admin_master',$this->data);     
   }

  public function testkaydet () {
  $this->danisan_model->testkaydet($this->input->post());
   }

   public function seansnotuduzenle() {
     $this->data['page_title'] = 'Seans Notu Düzenle';
     $this->load->library('form_validation');
   $this->render('admin/terapi/danisan/not_duzenle_view','admin_master',$this->data); 
   }

   public function seansnotguncelle() {
   $this->danisan_model->seansnotguncelle($this->input->post()); 
   }

   public function psikiyatrikilacekle () {
       $this->data['page_title'] = 'Psikiyatrik İlaç Öner';
       $this->load->library('form_validation');
        $this->data['ilac'] = $this->danisan_model->getilaclarForDropdown(array("0"," -- "));
        $this->data['doz'] = $this->danisan_model->getdozlarForDropdown(array("0"," -- "));

   $this->render('admin/terapi/danisan/psikiyatrikilac_ekle_view','admin_master',$this->data);     
   }

   public function psikiyatrikilackaydet () {
   $this->danisan_model->psikiyatrikilackaydet($this->input->post());
   }

   public function psikiyatrikilacduzenle () {
    $this->data['page_title'] = 'Psikiyatrik İlaç Öner';
    $this->load->library('form_validation');

    $this->data['ilac'] = $this->danisan_model->getilaclarForDropdown(array("0"," -- "));
    $this->data['doz'] = $this->danisan_model->getdozlarForDropdown(array("0"," -- "));
   
   $this->render('admin/terapi/danisan/psikiyatrikilac_duzenle_view','admin_master',$this->data);
   }
   
   public function psikiyatrikilacguncelle () {
    $this->danisan_model->psikiyatrikilacguncelle($this->input->post());
   }

   public function digerilacduzenle () {
    $this->data['page_title'] = 'Diğer İlaç Düzenle';
    $this->load->library('form_validation');

    $this->render('admin/terapi/danisan/digerilac_duzenle_view','admin_master',$this->data);
   }

   public function ilacguncelle () {
    $this->danisan_model->ilacguncelle($this->input->post());
   }

   public function kendidanisanlarim($datas = NULL) 
    {
        $this->data['page_title'] = 'Danişan Takip';
         $this->load->library('session');
        $this->data['users'] = $this->ion_auth->users(array())->result();

       $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#danisanListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/kendidanisanlarim_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';

        $this->render('admin/terapi/danisan/danisanlarim_view','admin_master',$this->data);
  }


   public function danisantaniduzenle () {
       $this->data['page_title'] = 'Tanı Düzenle';
       $this->load->library('form_validation');

   $this->render('admin/terapi/danisan/tani_duzenle_view','admin_master',$this->data);     
   }

  public function taniguncelle () {
  $this->danisan_model->taniguncelle($this->input->post());    
   }


 public function droplar () {
        $this->data['page_title'] = 'Droplar';
        $this->load->library('session');
        $this->data['users'] = $this->ion_auth->users(array())->result();

        $this->data['before_body'] ='<script type="text/javascript">
        <!--
         $(document).ready(function(){
          $("#danisanListTable").DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "'.base_url().'/admin/datatables/droplar_dt/getall",
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }
          } );    
         });
        -->
        </script>';
        $this->render('admin/terapi/danisan/droplar_view','admin_master',$this->data);

 }

 public function drop_neden () {
       $this->data['page_title'] = 'Drop Nedenleri';
       $this->load->library('form_validation');

       $this->data['nedenler'] = $this->danisan_model->getdropnedenlerForDropdown(array("0"," -- "));

 $this->render('admin/terapi/danisan/drop_nedeni_gir_view','admin_master',$this->data); 
 }

 public function dropkaydet () {
   $this->danisan_model->dropkaydet($this->input->post());  
 }


 public function formatama () {
       $this->data['page_title'] = 'Danışana Form Ata';
       $this->load->library('form_validation');

  $this->data['formlar'] = $this->danisan_model->getformlarForDropdown(array());      
  $this->render('admin/terapi/danisan/form_ata_view','admin_master',$this->data);   

   }


 public function form_goruntule () {
     $this->data['page_title'] = 'Form Goruntule';
     $this->load->library('form_validation');

      // $this->data['nedenler'] = $this->danisan_model->getdropnedenlerForDropdown(array("0"," -- "));

 $this->render('admin/terapi/danisan/form_goruntule_view','admin_master',$this->data); 
 }


 public function form_ata_kaydet () {
   $this->danisan_model->formatakaydet($this->input->post());  
 }

 public function formagit () {
       $this->data['page_title'] = 'Danışana Form Ata';
       $this->load->library('form_validation');
   $this->danisan_model->formagit($this->input->post());  

//   $this->load->view('admin/formlar/form3_view');

 //  $this->render('admin/formlar/form3_view','admin_master',$this->data); 
 }


 public function mizactesti () {

//define('MIZAC_TEST_API_KEY','49e09551-1e12-4564-883f-b656268f1ce3');
define('MIZAC_TEST_API_KEY','B29CE927-71E2-4A0D-80B1-395D67C44A71');
define('MIZAC_TEST_ID_YETISKIN',3);
define('MIZAC_TEST_API_URL',"http://api.mizactesti.com/api/v1/ExternalSiteTests");
define('MIZAC_TEST_SONUC_URL',"https://www.mizmeryonetim.com/admin/terapi/danisan");
define('MIZAC_TEST_URL',"http://www.mizactesti.com/RefererSite");

/*
$apiKey= 'B29CE927-71E2-4A0D-80B1-395D67C44A71';
//$testTypeID=MIZAC_TEST_ID_YETISKIN;
$testTypeID='3';

//$kullaniciID=$this->session->kullaniciID;
//$kullaniciBilgileri=$this->modelim->fnkullaniciCinsiyetYasGetir($kullaniciID);
//$cinsiyet=$kullaniciBilgileri[0]['kullaniciCinsiyet'];
//$yas=$kullaniciBilgileri[0]['yas'];

$sex=1;
$age=35;
$curl = curl_init();
// curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID}");
//curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID\",\"yas\": \"$yas\", \"cinsiyet\": \"$cinsiyet}" ); 
curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID,\"age\": $age, \"sex\": $sex}" );
curl_setopt($curl, CURLOPT_URL, MIZAC_TEST_API_URL);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Accept: text/plain";
$headers[] = "Content-Type: application/json";
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$sonuc = json_decode(curl_exec($curl));
$hata = curl_error($curl);
if ($sonuc->result)
$testID = $sonuc->data->testId;
curl_close($curl);
//$this->modelim->fnMizacTestIDEkle($testID, $this->session->kullaniciID);
// redirect(MIZAC_TEST_URL . "?TestID=" . $testID);
//return $testID;

}

public function fnMizacTestSonuc($pTestID, $pTestSonuc)
{
//$this->modelim->fnMizacSonucEkle($pTestID, $pTestSonuc);
redirect("Panel/index/Testlerim");*/


      // $apiKey= MIZAC_TEST_API_KEY;
      // $testTypeID=MIZAC_TEST_ID_YETISKIN;




/*

       $apiKey= 'B29CE927-71E2-4A0D-80B1-395D67C44A71';
       $testTypeID='3';
       $sex=1;
       $age=35;
       $MIZAC_TEST_API_URL="http://api.mizactesti.com/api/v1/ExternalSiteTests";

       
      // $kullaniciID=$this->session->kullaniciID;
      // $kullaniciBilgileri=$this->modelim->fnKullaniciCinsiyetYasGetir($kullaniciID);
      // $sex=$kullaniciBilgileri[0]['sex'];
      // $age=$kullaniciBilgileri[0]['age'];
       $curl = curl_init();
      // curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID}");
       curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID,\"age\": $age, \"sex\": $sex}" );
       curl_setopt($curl, CURLOPT_URL, $MIZAC_TEST_API_URL);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_POST, 1);

       $headers = array();
       $headers[] = "Accept: text/plain";
       $headers[] = "Content-Type: application/json";
       curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

       $sonuc = json_decode(curl_exec($curl));
       $hata = curl_error($curl);
      if ($sonuc->result)
        $testID = $sonuc->data->testId;
       curl_close($curl);
      // $this->modelim->fnMizacTestIDEkle($testID, $this->session->kullaniciID);
//        redirect(MIZAC_TEST_URL . "?TestID=" . $testID);
       return $testID;

*/









       $apiKey= MIZAC_TEST_API_KEY;
       $testTypeID=MIZAC_TEST_ID_YETISKIN;
       
      // $kullaniciID=$this->session->kullaniciID;
      // $kullaniciBilgileri=$this->modelim->fnKullaniciCinsiyetYasGetir($kullaniciID);
       $sex=$this->input->post('cinsiyet');
       $age=$this->input->post('yas');
       $curl = curl_init();
      // curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID}");
       curl_setopt($curl, CURLOPT_POSTFIELDS, "{ \"apiKey\": \"$apiKey\", \"testTypeId\": $testTypeID,\"age\": $age, \"sex\": $sex}" );
       curl_setopt($curl, CURLOPT_URL, MIZAC_TEST_API_URL);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_POST, 1);

       $headers = array();
       $headers[] = "Accept: text/plain";
       $headers[] = "Content-Type: application/json";
       curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

       $sonuc = json_decode(curl_exec($curl));
       $hata = curl_error($curl);
       if ($sonuc->result)
           $testID = $sonuc->data->testId;
       curl_close($curl);


    $datakayit=   array(
    'danisanID' => $this->input->post('danisanid'),
    'testDurum' => 2,
    'danisanYas' => $this->input->post('yas'),
    'danisanCinsiyet' => $this->input->post('cinsiyet'),
    'mizacTestGuid' => $testID,
    'islemKullaniciID' => $this->input->post('userid')
   );
   $this->db->insert("ilsdanisanmizactest",$datakayit);

    //   $this->modelim->fnMizacTestIDEkle($testID, $this->session->kullaniciID);
       redirect(MIZAC_TEST_URL . "?TestID=" . $testID);
       return $testID;


 }



public function MizacTestSonuc($pTestID,$pTestSonuc)
   {
      // $this->modelim->fnMizacSonucEkle($pTestID, $pTestSonuc);
  /*  echo $pTestID;

    echo '<br><br>';

    echo $pTestSonuc;*/

       // $sql="Select * From ilsdanisanmizactest where mizacTestGuid=".''.$pTestID;

        $sql="SELECT * from ilsdanisanmizactest where mizacTestGuid = "."'".$pTestID."'";
        $results = $this->db->query($sql)->result();
          foreach ($results as $result) {
        $danisanID=$result->danisanID;
                }


    $datakayit=   array(
    'danisanTestMizacTipID' => $pTestSonuc
   );

 $this->db->where('danisanID', $danisanID);
 $this->db->update('tbldanisan',$datakayit);


    $datakayittestdurum=   array(
    'testDurum' => 3
   );

 $this->db->where('mizacTestGuid', $pTestID);
 $this->db->update('ilsdanisanmizactest',$datakayittestdurum);


 $this->postal->add('Danışan Mizaç Belirleme Başarılı!','success');


$this->session->sess_destroy();
redirect('admin/user/login','refresh');



       //redirect("Panel/index/Testlerim");
   }


 public function mizactestiata () {
       $this->data['page_title'] = 'Mizaç Testi Başlat';
       $this->load->library('form_validation');
$this->render('admin/terapi/danisan/mizac_testi_ata_view','admin_master',$this->data); 
 }  






////////sinan+makbule//////////

 public function danisan_formlari () {
       $this->data['page_title'] = 'Danışan Formları';
       $this->load->library('form_validation');

      // $this->data['nedenler'] = $this->danisan_model->getdropnedenlerForDropdown(array("0"," -- "));

$this->render('formlar/form1_view','admin_master',$this->data); 

 }
 ////////sinan+makbule//////////

public function ilkgorusmenotuekle() {
    $this->data['page_title'] = 'İlk Görüşme Notu Ekle';
    $this->load->library('form_validation');

     $this->data['mizac'] = $this->danisan_model->getmizacForDropdown(array("0"," -- "));

$this->render('admin/terapi/danisan/ilk_gorusme_ekle_view','admin_master',$this->data); 
}

public function ilkgorusmekaydet() {
   $this->danisan_model->ilkgorusmekaydet($this->input->post());  
}

public function ilkgorusmeduzenle() {
    $this->data['page_title'] = 'İlk Görüşme Notu Düzenle';
    $this->load->library('form_validation');
    $this->render('admin/terapi/danisan/ilk_gorusme_duzenle_view','admin_master',$this->data); 
  }

public function ilkgorusmeguncelle() {
   $this->danisan_model->ilkgorusmeguncelle($this->input->post());  
}

public function mizacgir() {
    $this->data['page_title'] = 'Mizaç Gir';
    $this->load->library('form_validation');
     $this->data['mizaclar'] = $this->danisan_model->getmizacForDropdown(array("0"," -- "));
    $this->render('admin/terapi/danisan/mizac_gir_view','admin_master',$this->data); 
}

public function mizac_gir_kaydet () {
   $this->danisan_model->mizacgirkaydet($this->input->post()); 
}




}