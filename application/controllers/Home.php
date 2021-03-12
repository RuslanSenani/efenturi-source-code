<?php
class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('front/home_model');
        $this->load->model('front/front_database_model');
    }


    public function index()
    {
        get_lang();
        $this->home_model->show();
    }


    public function check_command($url)
    {
        $table  = array('pages', 'events', 'blogs', 'language');
        $this->home_model->check_url($url, $table);
    }


    public function not_found()
    {
        $this->home_model->show('theme/404');
    }


    public function send_message()
    {
        $string = $this->home_model->string();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', $string['form_required_error']);
        $this->form_validation->set_message('valid_email', $string['form_valid_email_error']);
        $this->form_validation->set_rules('name', 'Ad', 'trim|required');
        $this->form_validation->set_rules('mail', 'Mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('msg', 'Mesaj', 'trim|required');

        $result = array(
            'name'  => '',
            'mail'  => '',
            'msg'   => '',
            'ok'    => '',
            'status' => false
        );
        if ($this->form_validation->run() == FALSE) {
            $result['name']     = form_error('name', '<span class="text-danger">', '</span>');
            $result['mail']     = form_error('mail', '<span class="text-danger">', '</span>');
            $result['msg']      = form_error('msg', '<span class="text-danger">', '</span>');
        } else {
            $name   = $this->input->post('name', true);
            $mail   = $this->input->post('mail', true);
            $msg    = $this->input->post('msg', true);

            $ar = array(
                'name'  => $name,
                'mail'  => $mail,
                'msg'   => $msg
            );

            $this->front_database_model->front_insert('message', $ar);

            //
            $this->load->model('admin/mail_model');
            $content = "
                    <table>
                        <tr>
                            <td>Ad</td>
                            <td>$name</td>
                        </tr>
                        <tr>
                            <td>Mail</td>
                            <td>$mail</td>
                        </tr>
                        <tr>
                            <td>Mesaj</td>
                            <td>$msg</td>
                        </tr>
                    </table>
                ";
            $this->mail_model->send_mail('Yeni müraciət vardır.', 'info@correcttechno.com', $content);

            //
            $result['status'] = true;
            $result['ok'] = '<span class="text-success">' . $string['contact_success'] . '<span>';
        }
        echo json_encode($result);
    }


    public function read_category()
    {
        $id = $this->input->post('id');
        if (!empty($id) and is_numeric($id)) {
            $ar = array(
                'html' => $this->home_model->get_products($id)
            );
            echo json_encode($ar);
        }
    }

    public function read_product()
    {
        $id = $this->input->post('id');
        if (!empty($id) and is_numeric($id)) {
            $product = $this->home_model->product($id);
            $product_images = $this->home_model->get_product_images($product['product_id']);
            $ar = array(
                'title' => $product['title'],
                'price' => $product['price'],
                'image' => get_image($product_images[0]['image'])
            );
            echo json_encode($ar);
        }
    }

    public function send_order()
    {
        $string = $this->home_model->string();
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', $string['form_required_error']);
        $this->form_validation->set_message('valid_email', $string['form_valid_email_error']);
        $this->form_validation->set_rules('firstname', 'Ad', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Soyad', 'trim|required');
        $this->form_validation->set_rules('phone', 'Telefon', 'trim|required');
        $this->form_validation->set_rules('email', 'Mail', 'trim|valid_email');
        $this->form_validation->set_rules('id', 'Məhsul', 'trim|required');

        $result = array(
            'firstname' => '', 'lastname' => '', 'phone' => '', 'mail' => '', 'message' => '', 'status' => false
        );
        if ($this->form_validation->run() == FALSE) {
            $result['firstname']     = form_error('firstname', '<span class="text-red">', '</span>');
            $result['lastname']      = form_error('lastname', '<span class="text-red">', '</span>');
            $result['phone']         = form_error('phone', '<span class="text-red">', '</span>');
            $result['email']          = form_error('email', '<span class="text-red">', '</span>');
        } else {
            $firstname  = $this->input->post('firstname', true);
            $lastname   = $this->input->post('lastname', true);
            $phone      = $this->input->post('phone', true);
            $email      = $this->input->post('email', true);
            $note       = $this->input->post('note', true);
            $id         = $this->input->post('id', true);

            $q = $this->front_database_model->front_read_row('products', array('id' => $id));
            if (count($q) > 0) {

                /*sen mail */
                $this->load->model('admin/mail_model');
                $content = "
                    <table>
                        <tr>
                            <td>Ad</td>
                            <td>$firstname</td>
                        </tr>
                        <tr>
                            <td>Soyad</td>
                            <td>$lastname</td>
                        </tr>
                        <tr>
                            <td>Telefon</td>
                            <td>$phone</td>
                        </tr>
                        <tr>
                            <td>Mail</td>
                            <td>$email</td>
                        </tr>
                        <tr>
                            <td>Məhsul</td>
                            <td>" . $q['title'] . " (" . base_url() . $q['url_tag'] . ")</td>
                        </tr>
                        <tr>
                            <td>Qeyd</td>
                            <td>$note</td>
                        </tr>
                    </table>
                ";
                $this->mail_model->send_mail('Yeni Sifariş vardır', 'recebli212@gmail.com', $content);
                $this->mail_model->send_mail('Yeni Sifariş vardır', 'mexri.ahadova@gmail.com', $content);
                //Mexri.ahadova@gmail.com
                $result['message']  = '<span class="text-green">Göndərildi.</span>';
                $result['status']   = true;
                /* */
            } else {
                $result['message'] = 'Error';
            }
        }
        echo json_encode($result);
    }


    //seearch 
    public function search()
    {
        $search = $this->input->get('search', true);
        if (!empty($search)) {
            $sql = "select * from products where title like '%$search%' or content like '%$search%' limit 0,16";
            $result = $this->front_database_model->front_query($sql);
            $this->home_model->show('search', $result);
        } else {
            redirect(base_url());
        }
    }


    public function read_cityes()
    {

        $country_id = $this->input->post('country_id');
        if (!empty($country_id)) {
            $results = $this->front_database_model->front_read('cityes', array('country_id' => $country_id));
            $html = '<option value="0">--choose--</option>';
            foreach ($results as $r) {
                $html .= '<option value="' . $r['city_id'] . '">' . $r['title'] . '</option>';
            }
            echo $html;
        }
    }
}
