<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
                <div class="col-lg-12">
            <a href="<?php echo site_url('admin/users/create');?>" class="btn btn-primary">Kullanıcı Ekle</a>
            <a href="<?php echo site_url('admin/users');?>" class="btn btn-primary">Tüm Kullanıcılar</a>
            <a href="<?php echo site_url('admin/users/activeusers');?>" class="btn btn-primary">Aktif Kullanıcılar</a>
            <a href="<?php echo site_url('admin/users/passiveusers');?>" class="btn btn-primary">Pasif Kullanıcılar</a>
        </div>

        <div class="col-lg-4 col-lg-offset-4">
            <h1>Kullanıcı Ekle</h1>
            <?php echo form_open();?>
            <div class="form-group">
                <?php
                echo form_label('Ad','first_name');
                echo form_error('first_name');
                echo form_input('first_name',set_value('first_name'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Soyad','last_name');
                echo form_error('last_name');
                echo form_input('last_name',set_value('last_name'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Ofis','company');
                echo form_error('company');
                echo form_dropdown('company',$ofisler,'company','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Tel','phone');
                echo form_error('phone');
                echo form_input('phone',set_value('phone'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Kullanıcı Adı','username');
                echo form_error('username');
                echo form_input('username',set_value('username'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Email','email');
                echo form_error('email');
                echo form_input('email',set_value('email'),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Şifre','password');
                echo form_error('password');
                echo form_password('password','','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Şifreyi Tekrar','password_confirm');
                echo form_error('password_confirm');
                echo form_password('password_confirm','','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                if(isset($groups))
                {
                    echo form_label('Groups','groups[]');
                    foreach($groups as $group)
                    {
                        echo '<div class="checkbox">';
                        echo '<label>';
                        $groupid=$group->id;
                        if ($groupid=='2')  {  echo form_radio('groups[]', $group->id, $checked = TRUE, set_radio('groups[]', $group->id)); } //member default geldi
                       else { echo form_radio('groups[]', $group->id, set_radio('groups[]', $group->id));
                       } 
                        echo ' '.$group->name;
                        echo '</label>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <?php echo form_submit('submit', 'Kullanıcı Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo anchor('/admin/users', 'İptal','class="btn btn-default btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>