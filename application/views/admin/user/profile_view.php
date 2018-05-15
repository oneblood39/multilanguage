<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <h1>Profil</h1>
            <?php echo form_open('',array('class'=>'form-horizontal'));?>
            <div class="form-group">
                <?php
                echo form_label('Ad','first_name');
                echo form_error('first_name');
                echo form_input('first_name',set_value('first_name',$user->first_name),'class="form-control" readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Soyad','last_name');
                echo form_error('last_name');
                echo form_input('last_name',set_value('last_name',$user->last_name),'class="form-control" readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Ofis','company');
                echo form_error('company');
                echo form_input('company',set_value('company',$user->company),'class="form-control" readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Tel','phone');
                echo form_error('phone');
                echo form_input('phone',set_value('phone',$user->phone),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Kullanıcı Adı','username');
                echo form_error('username');
                echo form_input('username',set_value('username',$user->username),'class="form-control" readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Email','email');
                echo form_error('email');
                echo form_input('email',set_value('email',$user->email),'class="form-control" readonly');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Şifre Değiştir','password');
                echo form_error('password');
                echo form_password('password','','class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Şifreyi Tekrar Giriniz','password_confirm');
                echo form_error('password_confirm');
                echo form_password('password_confirm','','class="form-control"');
                ?>
            </div>
            <?php echo form_submit('submit', 'Profili Kaydet', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>