<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <h1>Yetki Düzenle</h1>
            <?php echo form_open_multipart($form_link, 'id="product_form"');?>
 <div class="form-group">
<?php
         
  
echo "<table>";
$query=$this->db->query('Select * FROM fonksiyon');
      foreach ($query->result() as $row){
$fonksiyon_id=$row->fonksiyon_id;
$fonk_adi=$row->fonksiyon_adi;  
 
$rol_id = $this->uri->segment(4);

  $query=$this->db->query('Select * FROM ils_rolfonksiyon where rol_id='.$rol_id);
  foreach ($query->result() as $row){
$fonk_id=$row->fonksiyon_id;

      }
}

$query=$this->db->query('Select * FROM fonksiyon');
$query2=$this->db->query('Select * FROM ils_rolfonksiyon where rol_id='.$rol_id);
      foreach ($query->result() as $row)
      {
            $fonksiyon_id=$row->fonksiyon_id;
            $fonk_adi=$row->fonksiyon_adi;  
            $f = "";
            
            foreach ($query2->result() as $row)
            {
                $fonk_id=$row->fonksiyon_id;             
                
                if($fonksiyon_id==$fonk_id) 
                    { 
                        
                        echo form_checkbox('group_name[]',set_value('group_name[]',$fonk_id),'class="form-control",style="margin:10px;"');
                        echo form_label($fonk_adi,'group_name');
                        $f = $fonksiyon_id;
                        echo "<br>";
                        break;
                    }

            }
            if ($f=='') {
            
            
            $data = array(
                            'name'          => 'group_name[]',
                            'value'         => $fonksiyon_id,
                            'checked'       => FALSE
                            
                        );
                        echo form_checkbox($data);
                        echo form_label($fonk_adi,'group_name');
                        echo "<br>";
            }

        }


      echo '
</table>';

  ?>  

  </div>
      
            <?php //echo form_hidden('group_id',set_value('group_id',$group->id));?>
            <?php echo form_submit('submit', 'Güncelle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/groups', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>
