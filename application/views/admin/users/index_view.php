<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('admin/users/create');?>" class="btn btn-primary">Kullanıcı Ekle</a>
            <a href="<?php echo site_url('admin/users');?>" class="btn btn-primary">Tüm Kullanıcılar</a>
            <a href="<?php echo site_url('admin/users/activeusers');?>" class="btn btn-primary">Aktif Kullanıcılar</a>
            <a href="<?php echo site_url('admin/users/passiveusers');?>" class="btn btn-primary">Pasif Kullanıcılar</a>
        </div>
    </div>
    <div class="row">
        <h2>Tüm Kullanıcılar</h2>
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            if(!empty($users))
            {
                echo '<table class="table table-hover table-bordered table-condensed">';
                echo '<tr><td>ID</td><td>Kullanıcı Adı</td></td><td>İsim</td><td>Email</td><td>Son Giriş</td><td>İşlemler</td></tr>';
                foreach($users as $user)
                {
                    echo '<tr>';
                    echo '<td>'.$user->id.'</td><td>'.$user->username.'</td><td>'.$user->first_name.' '.$user->last_name.'</td></td><td>'.$user->email.'</td><td>'.date('Y-m-d H:i:s', $user->last_login).'</td><td>';
                   if($current_user->id != $user->id) echo anchor('admin/users/edit/'.$user->id,'<span class="glyphicon glyphicon-pencil"></span>');//.' './/anchor('admin/users/delete/'.$user->id,'<span class="glyphicon glyphicon-remove"></span>');
                    else echo '&nbsp;';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
    </div>
</div>