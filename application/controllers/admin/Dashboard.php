<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        

 $this->data['before_head'] ="
<script>
 $(document).ready(function(){
    $.ajax({

url: 'http://localhost/multilanguage/admin/raporlar/raporlar/datagrafik',
        method: 'GET',
        success: function(data) {
            console.log(data);
            var ay = [];
            var randevuyaGeldi = [];   
            var iptalRandevu=[];
            var randevuyaGelmedi=[];


            for(var i in data) {


       ay.push(data[i].ay);
              
                randevuyaGeldi.push(data[i].randevuyaGeldi);

                iptalRandevu.push(data[i].iptalRandevu);

                randevuyaGelmedi.push(data[i].randevuyaGelmedi);
                
            }

            var chartdata = {
                labels: ay,
                datasets : [
                    {
                        label: 'Gerçekleşen Randevular',
                        backgroundColor: 'rgba(109, 203, 37, 1)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(109, 203, 37, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: randevuyaGeldi
                        
                    },
                    {
                        label: 'İptal Edilen Randevular',
                        backgroundColor: 'rgba(0, 93, 224, 0.49)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(0, 93, 224, 0.49)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: iptalRandevu
                        
                    },
                   {
                        label: 'Danışanın Gelmediği Randevular',
                        backgroundColor: 'rgba(224, 11, 0, 0.97)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(224, 11, 0, 0.97)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: randevuyaGelmedi
                        
                    }
                ]
            };

            var ctx = $('#mycanvas');

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>
";


        //$this->render('admin/dashboard_view');
        $this->render('admin/dashboard_view','admin_master',$this->data);

    }

    public function clear_cache() ///cache temizleme
    {
        $leave_files = array('.htaccess', 'index.html');
        $i = 0;
        foreach( glob(APPPATH.'cache/*') as $file ) {
            if(!in_array(basename($file), $leave_files))
            {
                unlink($file);
                $i++;
            }
        }
        $this->session->set_flashdata('message', $i.' files were deleted from the cache directory.');
        redirect('admin','refresh');
    }
}