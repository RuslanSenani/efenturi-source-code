<?php
class account extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('front/home_model');
    }



    //my profile
    public function profile()
    {
        $content = $this->load->view('admin/profile', $this->admin_model->get_admin(false, true), true);
        $this->admin_model->show($content);
    }

    //login form views
    public function login_form()
    {
        $this->load->view('admin/login', array('msg' => ''));
    }

    //login functions
    public function login()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'İstifadəçi adı', 'trim|required');
        $this->form_validation->set_rules('password', 'Şifrə', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $result = validation_errors('<div>', '</div>');
        } else {

            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $ar = $this->database_model->read_row_query("account", array('username' => $username, 'password' => md5($password)));

            if (count($ar) > 0) {
                $this->load->library('session');
                $token = get_token();
                $this->session->set_userdata('token', $token);
                $this->session->set_userdata('user_id', $ar['id']);
                $this->database_model->update_token($token, $ar['id']);
                // $this->admin_model->clear_unused_images();
                redirect(base_url() . 'admin/dashboard', 'location');
            } else {
                $result = 'Hesab səhvdir!';
            }
        }
        $this->load->view('admin/login', array('msg' => $result));
    }

    //logout functions
    public function logout()
    {

        $this->load->library('session');
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('user_id');
        redirect(base_url() . 'correct-admin', 'location');
    }

    //contact-form -delete message
    public function delete_message()
    {
        $this->admin_model->get_page_permission();
        $id = $this->input->post('id');
        if (!empty($id)) {
            $this->database_model->delete('message', $id);
        }
    }

    //change account information
    public function change_information()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'Ad', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Soyad', 'trim|required');
        $this->form_validation->set_rules('address', 'Ünvan', 'trim|required');
        $this->form_validation->set_rules('mail', 'Mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telefon', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors('<div>', '</div>');
        } else {
            $firstname  = $this->input->post('firstname');
            $lastname   = $this->input->post('lastname');
            $address    = $this->input->post('address');
            $mail       = $this->input->post('mail');
            $phone      = $this->input->post('phone');

            $ar         = array(
                'firstname' => $firstname,
                'lastname'  => $lastname,
                'mail'      => $mail,
                'address'   => $address,
                'phone'     => $phone
            );
            $this->database_model->update('account', $ar, $this->admin_model->get_admin(false, true)['id']);
            echo 'ok';
        }
    }

    //change account password
    public function change_password()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldpassword', 'Mövcut şifrə', 'trim|required');
        $this->form_validation->set_rules('password', 'Yeni şifrə', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('retrypassword', 'Təkrar yeni şifrə', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors('<div>', '</div>');
        } else {
            $oldpassword    = $this->input->post('oldpassword');
            $password       = $this->input->post('password');
            $retrypassword  = $this->input->post('retrypassword');

            $userdata = $this->admin_model->get_admin(false, true);
            if (md5($oldpassword) == $userdata['password']) {
                $ar = array(
                    'password' => md5($password)
                );
                $this->database_model->update('account', $ar, $userdata['id']);
                echo 'ok';
            } else {
                echo 'Şifrə səhvdir.';
            }
        }
    }


    //list users
    public function index()
    {
        $string = $this->home_model->string();
        $this->admin_model->get_page_permission();

        $content = '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">' . $string['account'] . '</h4>
                  <p></p>
                  ' . $this->admin_model->get_page_button('account') . '
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                        ' . $string['terms_link'] . '
                        </th>
                        <th>
                        ' . $string['name'] . '
                        </th>
                        <th>
                        ' . $string['user_name'] . '
                        </th>
                        <th>
                        ' . $string['phone_title'] . '
                        </th>
                        <th>
                        ' . $string['email'] . '
                        </th>

                        
                        <th>
                        </th>
                      </thead>
                      <tbody id="account">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     ';
        $this->load->model('admin/modal_model');
        $html = '
    <form method="post" action="' . base_url() . 'admin/account/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['user_name'] . '</label>
        <input name="username" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['password'] . '</label>
        <input name="password" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['name'] . '</label>
        <input name="firstname" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['surname'] . '</label>
        <input name="lastname" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['phone_title'] . '</label>
        <input name="phone" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['email'] . '</label>
        <input name="mail" type="text" class="form-control">
     </div>
     </div>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>' . $string['phone_title'] . '</label>
        <input name="address" type="text" class="form-control">
     </div>
     </div>
     <div class="col-12">
     <div class="form-group">
        <label>' . $string['status'] . '</label>
        <select name="position" class="form-control">
            <option value="ceo">' . $string['ceo'] . '</option>
            <option value="manager">' . $string['manager'] . '</option>
        </select>
     </div>
     </div>
     
     
     
    </form>
     ';
        $content .= $this->modal_model->dialog($html, 'account_panel', 'md', $string['save']);

        $content .= $this->modal_model->delete();
        $this->admin_model->show($content);
    }


    public function read()
    {
        $this->admin_model->get_page_permission();

        $content = '';
        $n = 0;
        $ar = $this->database_model->read('account', array('id', 'desc'), 'id', array('admin' => 'false'));
        foreach ($ar as $a) {

            $n++;
            $content .= '<tr>
        <td class="number-rel">
        ' . $n . '
        </td>
        <td>
        ' . $a['firstname'] . ' ' . $a['lastname'] . '
        </td>
        <td>
        ' . $a['username'] . '
        </td>
        <td>
        ' . $a['phone'] . '
        </td>
        <td>
        ' . $a['mail'] . '
        </td>
        <td class="text-right">
        <div class="btn-group">
            <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-warning"><i class="material-icons">edit</i></button>
            <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
        </div>
        </td>
        </tr>';
        }
        echo json_encode(array('content' => $content));
    }



    public function add()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'Ad', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Soyad', 'trim|required');
        $this->form_validation->set_rules('username', 'İstifadəçi adı', 'trim|required');
        $this->form_validation->set_rules('mail', 'Mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telefon', 'trim|required');
        $this->form_validation->set_rules('address', 'Ünvan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors('<div>', '</div>');
        } else {

            $this->admin_model->get_page_permission();
            $firstname      = $this->input->post('firstname');
            $lastname       = $this->input->post('lastname');
            $mail           = $this->input->post('mail');
            $phone          = $this->input->post('phone');
            $address        = $this->input->post('address');
            $username       = $this->input->post('username');
            $password       = $this->input->post('password');
            $position       = $this->input->post('position');
            $ch_id          = $this->input->post('ch_id');



            $ar = array(
                'username'  => $username,
                'position'  => $position,
                'firstname' => $firstname,
                'lastname'  => $lastname,
                'phone'     => $phone,
                'mail'      => $mail,
                'address'   => $address,
            );
            // if (!empty($ch_id)) {
            //     echo "Bos Deyil";
            //     echo $ch_id;
            // } else {
            //     echo "Bosdu";
            //     echo $ch_id;
            // }
            // die;

            if (!empty($ch_id)) {

                if (!empty($password)) {

                    $ar['password'] = md5($password);
                }
                $this->database_model->update('account', $ar, $ch_id);
                echo 'ok';
            } else if (empty($password)) {
                echo 'Şifrə daxil edin.';
            } else {
                if (!empty($password)) {

                    $ar['password'] = md5($password);
                }
                $this->database_model->insert('account', $ar);
                echo 'ok';
            }
        }
    }

    public function read_row()
    {
        $this->admin_model->get_page_permission();
        $id = $this->input->post('id');
        if (!empty($id) and $id != 0) {
            $result = $this->database_model->read_row('account', $id);
            echo json_encode($result);
        }
    }

    public function delete()
    {
        $this->admin_model->get_page_permission();
        $id = $this->input->post('id');
        if (!empty($id)) {
            $this->database_model->delete('account', $id);
            echo json_encode(array('msg' => 'Silindi'));
        }
    }
}
