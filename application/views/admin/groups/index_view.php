<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('admin/groups/create');?>" class="btn btn-primary">Yeni Grup Ekle</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            if(!empty($groups))
            {
                echo '<table class="table table-hover table-bordered table-condensed">';
                echo '<tr><td>ID</td><td>Grup Adı</td></td><td>Grup Açıklaması</td><td>İşlemler</td></tr>';
                foreach($groups as $group)
                {
                    echo '<tr>';
                    echo '<td>'.$group->id.'</td><td>'.anchor('admin/users/index/'.$group->id, $group->name).'</td><td>'.$group->description.'</td><td>'.anchor('admin/groups/edit/'.$group->id,'<span class="glyphicon glyphicon-pencil"></span>');
                       if ($group->name=="admin") {   } else {
                       echo ' '.anchor('admin/groups/permissions/'.$group->id,'<span class="glyphicon glyphicon-user"></span>');} 
                   // if(!in_array($group->name, array('admin','members'))) echo ' '.anchor('admin/groups/delete/'.$group->id,'<span class="glyphicon glyphicon-remove"></span>');

             


                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
    </div>
</div>