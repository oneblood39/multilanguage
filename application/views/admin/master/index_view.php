<div class="container" style="margin-top:60px;">
    <div class="row">
        <div class="col-lg-12">
            <h1>Website Ayarları</h1>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo '<div class="jumbotron text-center"><p>';
                    echo anchor('admin/master/change-website-status','<span class="glyphicon glyphicon-thumbs-'.(($website->status=='1') ? 'up text-primary':'down text-danger').'" style="font-size: 40px;"></span>','onclick="return confirm(\'Panelin durumunu değiştirmek istediğinizden emin misiniz?\')"');
                    echo '<br />Panel '.(($website->status=='1') ? 'AKTİF':'PASİF');
                    echo '</p></div>';
                    ?>
                </div>
                <?php
                if(isset($writable_directories))
                {
                ?>
                <div class="col-lg-6">
                    <h2>Yazılabilir Dizinler</h2>
                    <table class="table table-hover table-condensed">
                        <tbody>
                        <?php
                        foreach ($writable_directories as $area => $directories)
                        {
                            echo '<tr><th colspan="2">'.$area.'/</th></tr>';
                            foreach($directories as $directory => $status)
                            {
                                echo '<tr>';
                                echo '<td>'.$directory.'</td>';
                                echo '<td class="text-right"><span class="glyphicon glyphicon-thumbs-'.(($status=='1') ? 'up text-success':'down text-danger').'"></span></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>
                <div class="col-lg-6">
                    <h2>Banlanmış IP'ler</h2>
                    <table class="table table-hover table-condensed">
                        <tbody>
                            <?php
                            if(!empty($banned_ips))
                            {
                                foreach ($banned_ips as $ip)
                                {
                                    echo '<tr>';
                                    echo '<td>'.$ip->ip.'</td>';
                                    echo '<td class="text-right">';
                                    echo anchor('admin/master/remove-ip/'.$ip->id,'<span class="glyphicon glyphicon-remove"></span>','onclick="return confirm(\'Bu IP nin yasağı kalkmak üzere. Emin misiniz?\')"');
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            else
                            {
                                echo '<tr><td>No IPs banned?</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    echo form_open('admin/master/add-ip');
                    echo '<div class="form-group">';
                    echo form_label('IP','ip');
                    echo form_error('ip');
                    echo form_input('ip',set_value('ip'),'class="form-control"');
                    echo '</div>';
                    $submit_button = 'IP Ekle';
                    echo form_submit('submit', $submit_button, 'class="btn btn-primary btn-lg btn-block"');
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h2>Genel Ayarlar</h2>
            <?php echo form_open('');?>
            <div class="form-group">
                <?php
                echo form_label('Website Başlığı','title');
                echo form_error('title');
                echo form_input('title',set_value('title',$website->title),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Default Sayfa Başlığı','page_title');
                echo form_error('page_title');
                echo form_input('page_title',set_value('page_title',$website->page_title),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Admin email','admin_email');
                echo form_error('admin_email');
                echo form_input('admin_email',set_value('admin_email',$website->admin_email),'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('İletişim email','contact_email');
                echo form_error('contact_email');
                echo form_input('contact_email',set_value('contact_email',$website->contact_email),'class="form-control"');
                ?>
            </div>
            <?php
            $submit_button = 'Kaydet';
            echo form_submit('submit', $submit_button, 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo form_close();?>

        </div>
        </div>