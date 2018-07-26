<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
         $this->load->model('users/users_model');
        if(!$this->ion_auth->in_group('admin'))
        {
            $this->postal->add('Bu sayfayı görme yetkiniz bulunmamaktadır! Lütfen sistem yöneticinize başvurun.','error');
            redirect('admin');
        }
    }

    public function index($group_id = NULL) ///kullanıcılar sayfası
    {
        $this->data['page_title'] = 'Kullanıcılar';
        //$this->data['users'] = $this->ion_auth->users($group_id)->result();
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/users/index_view');
	}

    public function create()    /////kullanıcı ekleme sayfası
    {
        $this->data['page_title'] = 'Kullanıcı Ekle';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name','First name','trim');
        $this->form_validation->set_rules('last_name','Last name','trim');
        $this->form_validation->set_rules('company','Company','trim');
        $this->form_validation->set_rules('phone','Phone','trim');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
        $this->form_validation->set_rules('groups[]','Groups','required|integer');
        $this->data['ofisler'] = $this->users_model->getOfficesForDropdown(array("0"," -- "));

        if($this->form_validation->run()===FALSE)
        {
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->load->helper('form');
            $this->render('admin/users/create_view');
        }
        else
        {
   
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $group_ids = $this->input->post('groups');
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'  => $this->input->post('company'),
                'phone'      => $this->input->post('phone')
            );
            $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
            $this->postal->add($this->ion_auth->messages(),'success'); ///diğer durumda $data eklenecek...
            redirect('admin/users');
        }
    }

    public function edit($user_id = NULL, $ofisID = NULL)   ////kullanıcı güncelleme
    {
        $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
        if($this->data['current_user']->id == $user_id)
        {
            $this->postal->add('Use the profile page to change your own credentials.','error');
            redirect('admin/users');
        }
        $this->data['page_title'] = 'Edit user';
        $this->load->library('form_validation');
        $ofis = $this->users_model->getOfis((int) $ofisID);

        $this->form_validation->set_rules('first_name','First name','trim');
        $this->form_validation->set_rules('last_name','Last name','trim');
        $this->form_validation->set_rules('company','Company','trim');
        $this->form_validation->set_rules('phone','Phone','trim');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','min_length[6]');
        $this->form_validation->set_rules('password_confirm','Password confirmation','matches[password]');
        $this->form_validation->set_rules('groups[]','Groups','required|integer');
        $this->form_validation->set_rules('user_id','User ID','trim|integer|required');
        $this->data['ofisler'] = $this->users_model->getOfficesForDropdown(array("0"," -- "));

        if($this->form_validation->run() === FALSE)
        {
            if($user = $this->ion_auth->user((int) $user_id)->row())
            {
                $this->data['user'] = $user;
            }
            else
            {
                $this->postal->add('The user doesn\'t exist.','error');
                redirect('admin/users');
            }
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->data['usergroups'] = array();
            if($usergroups = $this->ion_auth->get_users_groups($user->id)->result())
            {
                foreach($usergroups as $group)
                {
                    $this->data['usergroups'][] = $group->id;
                }
            }
            $this->load->helper('form');
            $this->render('admin/users/edit_view');
        }
        else
        {
            $user_id = $this->input->post('user_id');

            $new_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone')
            );
            if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');

            $this->ion_auth->update($user_id, $new_data);

            //Update the groups user belongs to
            $groups = $this->input->post('groups');
            if (isset($groups) && !empty($groups))
            {
                $this->ion_auth->remove_from_group('', $user_id);
                foreach ($groups as $group)
                {
                    $this->ion_auth->add_to_group($group, $user_id);
                }
            }
            $this->postal->add($this->ion_auth->messages(),'success');
            redirect('admin/users');
        }
    }

    public function delete($user_id = NULL)   /////kullanıcı silme
    {
        if(is_null($user_id))
        {
            $this->postal->add('There\'s no user to delete','error');
        }
        else
        {
            $this->ion_auth->delete_user($user_id);
            $this->postal->add($this->ion_auth->messages(),'success');
        }
        redirect('admin/users');
    }

        public function activeusers($group_id = NULL) ///aktif kullanıcılar sayfası
    {
        $this->data['page_title'] = 'Aktif Kullanıcılar';       
        $this->ion_auth->where('active','1');
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/users/active_view');
    }

        public function passiveusers($group_id = NULL) ///pasif kullanıcılar sayfası
    {
        $this->data['page_title'] = 'Pasif Kullanıcılar';       
        $this->ion_auth->where('active','0');
        $this->data['users'] = $this->ion_auth->users(array())->result();
        $this->render('admin/users/passive_view');
    }

        public function pasifet($user_id = NULL) ///kullanıcı pasif et
    {
         $user_id = $this->uri->segment(4);
            $new_data = array(
                'active'      => '0'
            );    
             $this->ion_auth->where('id',$user_id);
             $this->ion_auth->update($user_id, $new_data);
             $this->postal->add('Kullanıcı Pasif Edildi!','success');
             redirect('admin/users/passiveusers');
    }


          public function aktifet($user_id = NULL) ///pasif kullanıcıyı aktif et
    {
         $user_id = $this->uri->segment(4);
            $new_data = array(  
                'active'      => '1'
            );    
             $this->ion_auth->where('id',$user_id);
             $this->ion_auth->update($user_id, $new_data);
             $this->postal->add('Kullanıcı Aktif Edildi!','success');
             redirect('admin/users/activeusers');

    }
     
    
}