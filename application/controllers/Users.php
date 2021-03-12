<?php
class users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('front/home_model');
        $this->load->model('front/front_database_model');
        $this->load->library('session');
    }

    public function login()
    {
        $this->home_model->show('login');
    }

    public function login_submit()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

        $error = array();
        $error['password']  = '';
        $error['email']     = '';
        if ($this->form_validation->run() == FALSE) {

            $error['password']      = form_error('password', '<div class="error">', '</div>');
            $error['email']         = form_error('email', '<div class="error">', '</div>');
        } else {

            $password   = get_password($this->input->post('password'));
            $email      = $this->input->post('email');
            $result = $this->front_database_model->front_read_row('users', array('email' => $email, 'password' => $password));
            if (count($result) > 0) {

                if ($result['status'] == "true") {
                    $token = get_token();
                    $this->load->helper('cookie');
                    $this->load->library('session');
                    $this->session->set_userdata("user", $result);
                    set_cookie('token', $token, time() + 9000000);

                    $this->front_database_model->front_update('users', array('token' => $token), array('id' => $result['id']));

                    $error['success'] = 'Welcome
                        <script>
                        setTimeout(function(){';

                    if (empty($url)) {
                        $error['success'] .= 'window.location.href="' . base_url() . '"';
                    } else {
                        $error['success'] .= 'location.reload();';
                    }

                    $error['success'] .= '
                        },500);
                        </script>
                        ';
                } else {
                    $error['success'] = 'Account deactive, Please  check mail.';
                }
            } else {
                $error['success'] = 'Account not found';
            }
        }
        echo json_encode($error);
    }

    public function logout()
    {
        if ($this->home_model->get_user()) {
            $this->load->helper('cookie');
            delete_cookie('token');
            redirect(base_url(), 'location');
        }
    }

    public function register()
    {
        $this->home_model->show('register');
    }

    public function register_submit()
    {

        $string = $this->home_model->string();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('passwordretry', 'Password Retry', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('terms', 'Qeydiyyat Şərtləri', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('company', 'Company name', 'trim');
        $this->form_validation->set_rules('terms', 'Terms', 'required');
        $this->form_validation->set_rules('positions', 'Positions', 'required');
        //trim|required|valid_date


        $error = array();
        $error['firstname']     = '';
        $error['lastname']      = '';
        $error['email']         = '';
        $error['location']      = '';
        $error['password']      = '';
        $error['passwordretry'] = '';
        $error['success']       = '';
        $error['company']       = '';
        $error['type']          = '';
        $error['positions']     = '';

        if ($this->form_validation->run() == FALSE) {
            $error = array();
            $error['firstname']     = form_error('firstname', '<div class="error">', '</div>');
            $error['lastname']      = form_error('lastname', '<div class="error">', '</div>');
            $error['email']         = form_error('email', '<div class="error">', '</div>');
            $error['location']      = form_error('location', '<div class="error">', '</div>');
            $error['password']      = form_error('password', '<div class="error">', '</div>');
            $error['passwordretry'] = form_error('passwordretry', '<div class="error">', '</div>');
            $error['company']       = form_error('company', '<div class="error">', '</div>');
            $error['positions']     = form_error('positions', '<div class="error">', '</div>');
            echo json_encode($error);
        } else {

            $this->load->model('admin/mail_model');
            $firstname  = $this->input->post('firstname', true);
            $lastname   = $this->input->post('lastname', true);
            $password   = $this->input->post('password', true);
            $company    = $this->input->post('company', true);
            $email      = $this->input->post('email', true);
            $location   = $this->input->post('location', true);
            $terms      = $this->input->post('terms', true);
            $type       = $this->input->post('type', true);
            $positions  = $this->input->post('positions', true);

            if ($terms != 1 or ($type != 'user' and $type != 'company')) {

                die;
            }
            $code               = rand(1000, 9999);
            $token              = get_token();
            $ar = array(
                'firstname'     => $firstname,
                'lastname'      => $lastname,
                'password'      => get_password($password),
                'company'       => $company,
                'email'         => $email,
                'location'      => $location,
                'positions'     => $positions,
                'type'          => $type,
                'code'          => $code,
                'token'         => $token
            );



            $this->front_database_model->front_insert('users', $ar);

            $content = 'Hesabınızı təsdiq etmək üçün aşağıdakı linki klikləyin.
            </br>
            <a href="' . base_url() . 'verification/' . $token . '/' . $code . '">Təsdiq et</a>
            <p><b>Qeyd</b>:Əgər link yoxdursa aşağıdakı linki browserinizdə açın.</p>
            ' . base_url() . 'verification/' . $token . '/' . $code . '
            ';

            $this->mail_model->send_mail('Hesabınızı Təsdiqləyin', $email, $content);


            $error['success'] = $string['login_success'] . '
            <script>
            setTimeout(function(){
            window.location.href="' . base_url() . 'login";
            },1000);
            </script>
            ';
            echo json_encode($error);
        }
    }

    public function verification($token, $code)
    {

        $ar = array('text' => '', 'type' => 'danger');
        if (!empty($token) and !empty($code)) {
            $results = $this->front_database_model->front_read_row('users', array('token' => $token, 'code' => $code));

            if (count($results) > 0) {
                $ar = array(
                    'status'        => true,
                    'code'          => rand(1000, 9999),
                    'token'         => get_token()
                );
                $this->front_database_model->front_update('users', $ar, array('token' => $results['token'], 'code' => $results['code']));
                $ar['type'] = 'success';
                $ar['text'] = 'Hesabınız Aktiv edildi';
            } else {
                $ar['text'] = 'Hesabınız təsdiqlənmədi';
            }
        }
        $this->home_model->show('theme/alert', $ar);
    }


    public function forgot_password()
    {
        $this->home_model->show('forgot-password');
    }

    public function edit_user()
    {
        $firstname  = $this->input->post('firstname', true);
        $lastname   = $this->input->post('lastname', true);
        $password   = $this->input->post('password', true);
        $company    = $this->input->post('company', true);
        $email      = $this->input->post('email', true);
        $location   = $this->input->post('location', true);
        $positions  = $this->input->post('positions', true);
        $user_id    = $this->input->post('user_id', true);




        $confirm_password = $this->front_database_model->front_read('users', array('password' => get_password($password)));
        $string = $this->home_model->string();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        if (!empty($password) and count($confirm_password) == 0) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        }
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('company', 'Company name', 'trim|required');
        $this->form_validation->set_rules('positions', 'Positions', 'required');
        $this->form_validation->set_rules('user_id', 'User ID', 'required');
        //trim|required|valid_date
        $error = array();
        $error['firstname']     = '';
        $error['lastname']      = '';
        $error['email']         = '';
        $error['location']      = '';
        if (!empty($password) and count($confirm_password) == 0) {
            $error['password']      = '';
        }
        $error['company']       = '';
        $error['positions']     = '';
        $error['user_id']     = '';
        if ($this->form_validation->run() == FALSE) {
            $error = array();
            $error['firstname']     = form_error('firstname', '<div class="error">', '</div>');
            $error['lastname']      = form_error('lastname', '<div class="error">', '</div>');
            $error['email']         = form_error('email', '<div class="error">', '</div>');
            $error['location']      = form_error('location', '<div class="error">', '</div>');
            if (!empty($password) and count($confirm_password) == 0) {
                $error['password']      = form_error('password', '<div class="error">', '</div>');
            }
            $error['company']       = form_error('company', '<div class="error">', '</div>');
            $error['positions']     = form_error('positions', '<div class="error">', '</div>');
            $error['user_id']     = form_error('user_id', '<div class="error">', '</div>');
            echo json_encode($error);
        } else {
            $ar2 = array(
                'id' => $user_id
            );
            $ar = array(
                'firstname'     => $firstname,
                'lastname'      => $lastname,
                'company'       => $company,
                'email'         => $email,
                'location'      => $location,
                'positions'     => $positions
            );
            if (!empty($_FILES['image']['name'])) {
                $this->load->model("admin/upload_model");
                $ar = array_merge($ar, array('image' => $this->upload_model->image("image", 300)));
            }
            if (!empty($password) and count($confirm_password) == 0) {
                $ar = array(
                    'password'      => get_password($password)
                );
            }
            if ($this->session->userdata("user")['id'] == $user_id) {
                $this->front_database_model->front_update('users', $ar, $ar2);
            }
            if (!empty($password) and count($confirm_password) == 0) {
                $this->logout();
            }
        }
    }

    public function delete_user($id)
    {
        if ($this->session->userdata("user")['id'] == $id) {
            $this->front_database_model->front_delete('users', array('id' => $id));
            $this->logout();
        } else {
            $this->logout();
        }
    }
}
