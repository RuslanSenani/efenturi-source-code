<?php
class admin_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('front/home_model');
    }
    /* public function clear_all_cache(){
        if($this->get_admin(false)){
            $path=APPPATH.'cache/';
            $dir=opendir($path);
            while($file=readdir($dir)){
                if(is_file($path.$file)){
                    unlink($path.$file);
                }
            }
        }
    } */

    public function get_category($id)
    {
        $result = $this->database_model->read_row('categories', array('category_id' => $id), array('id', 'asc'));
        return $result != null ? $result : array('title' => '');
    }


    public function get_page_permission()
    {

        $result = $this->get_admin_menu(true);
        $data   = $this->uri->segment_array();
        if (in_array($data[1] . '/' . $data[2], $result)) {
            return true;
        } else {
            echo 'Bu səhifəyə girməyə icazəniz yoxdur.';
            die;
            return false;
        }
    }

    public function get_admin_menu($com = false)
    {

        $data       = $this->get_admin(true, true);
        if ($data['position'] == 'ceo') {
            $result = $this->database_model->read('admin_menu', array('num', 'asc'), 'id');
        } else {
            $result = $this->database_model->query("select * from admin_menu where permission like '%$position%' order by num asc");
        }

        if ($com == true) {

            $ar = array();
            foreach ($result as $r) {
                array_push($ar, $r['url_tag']);
            }
            return $ar;
        } else {
            return $result;
        }
    }


    public function show($content, $script = '')
    {

        $menu = $this->get_admin_menu();
        $message = $this->database_model->read('message');
        $uri = $this->uri->segment(1) . '/' . $this->uri->segment(2);
        //$this->admin_model->clear_all_cache();
        $this->load->view("admin/home", array('content' => $content, 'menu' => $menu, 's_menu' => $uri, 'message' => $message, 'script' => $script));
    }


    public function get_page_header()
    {
        $language = $this->database_model->read('language', array('id', 'asc'));
        $html = '<div class="col-md-6 header_lang_btn btn-group">';
        foreach ($language as $l) {
            $html .= '
                <button class="btn btn-sm btn-primary" id="' . $l['id'] . '">
                <i class="material-icons">language</i> ' . $l['url_tag'] . '
                </button>';
        }
        $html .= '</div>';
        return $html;
    }


    public function get_page_button($page_id, $copy = false, $settings = false, $delete = false)
    {
        $string = $this->home_model->string();
        $html = '
        <div class="btn-group dropdown text-right h_btn">
            <button data-target="#' . $page_id . '_panel" data-toggle="modal" type="button" class="btn btn-sm btn-info waves-effect waves-light">
                <i class="material-icons">add</i>' . $string['new'] . '
            </button>';

        if ($copy == true or $delete == true) {
            $html .= '
            <button type="button" class="btn btn-sm btn-info waves-effect waves-light dropdown-toggle-split dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropright</span>
            </button>
            <div class="dropdown-menu">';

            if ($copy == true) {

                $html .= '
                <a id="allcopy" class="dropdown-item">
                    <i class="material-icons">file_copy</i>
                    ' . $string['file_copy'] . '
                </a>';
            }
            if ($settings == true) {
                $html .= '
                <a id="allsettings" class="dropdown-item">
                    <i class="material-icons">settings</i>
                    ' . $string['settings'] . '
                </a>';
            }
            if ($delete == true) {
                $html .= '
                <a id="alldelete" class="dropdown-item">
                    <i class="material-icons">delete_forever</i>
                    ' . $string['delete'] . '
                </a>';
            }


            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }



    ///////////////


    public function get_lang($id)
    {
        $result = $this->database_model->read_row('language', $id);
        if ($result == null) {
            return array('url_tag' => '', 'title' => '');
        } else {
            return $result;
        }
    }


    public function get_admin($com = false, $data_read = false)
    {

        $this->load->library('session');
        if ($this->session->has_userdata('token') and $this->session->has_userdata('user_id')) {
            //return true;
            if ($data_read == false) {
                return true;
            } else {
                $user_id    = $this->session->userdata('user_id');
                $token      = $this->session->userdata('token');
                return $this->database_model->read_row('account', array('id' => $user_id, 'token' => $token));
            }
        } else {
            if ($com == true) {
                redirect(base_url(), 'location');
            }
            return false;
        }
    }


    private function get_is_image($image)
    {

        // http://localhost/correcttechno/admin/account/read_file


        $sql        = "select count(*) as say from pages where image like '%$image%' or content like '%$image%'";
        $pages      = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from blogs where image like '%$image%' or content like '%$image%'";
        $blogs      = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from sliders where image like '%$image%'";
        $sliders    = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from service where image like '%$image%'";
        $service    = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from portfolio where image like '%$image%' or preview like '%$image%'";
        $portfolio  = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from partners where image like '%$image%'";
        $partners   = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from categories where image like '%$image%'";
        $categories = $this->database_model->query_row($sql);

        $sql        = "select count(*) as say from products_image where image like '%$image%'";
        $products_images = $this->database_model->query_row($sql);




        if ($pages['say'] > 0 or $blogs['say'] > 0 or $sliders['say'] > 0 or $service['say'] > 0 or $portfolio['say'] > 0 or $partners['say'] > 0 or $categories['say'] > 0 or $products_images['say'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    //read country
    public function countries()
    {
        return $this->database_model->read('countries', array('share' => true));
    }
    public function clear_unused_images()
    {

        $r          = opendir('uploads/images');
        while ($d = readdir($r)) {
            $file   = 'uploads/images/' . $d;
            $webp   = 'uploads/webp/' . $d;
            $thumb  = 'uploads/thumb/' . $d;
            if (is_file($file)) {
                if (!$this->get_is_image($d)) {

                    unlink($file);
                    if (is_file($webp)) {
                        unlink($webp);
                    }
                    if (is_file($thumb)) {
                        unlink($thumb);
                    }
                }
            }
        }
    }
}
