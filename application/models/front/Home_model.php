<?php

class home_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        /* if(!$this->admin_model->get_admin(false)){
           $this->output->cache(120);   
        } */
        $this->load->model('front/front_database_model');
    }

    //get_user(true);
    public function get_user($com = false, $redirect = false)
    {
        $this->load->helper('cookie');
        if (get_cookie('token') != '') {
            if ($com == true) {
                return $this->front_database_model->front_read_row('users', array('token' => get_cookie('token'), 'status' => true));
            } else {
                return true;
            }
        } else {
            if ($redirect == true) {
                redirect(base_url(), 'location');
            }
            return false;
        }
    }

    //get_user_type();
    public function get_user_type($type = "company")
    {
        $user = $this->get_user(true);

        if ($user != false) {

            if ($user['type'] == $type) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function string()
    {
        $string = array();
        $lang_setting = $this->front_database_model->front_read('lang_settings', array('l_id' => get_lang()));
        foreach ($lang_setting as $l) {
            $string = array_merge($string, array($l['selector'] => $l['value']));
        }
        return $string;
    }


    private function language()
    {
        return $this->front_database_model->front_read('language', array('share' => 'true'), array('num', 'asc'));
    }


    private function contact()
    {
        $ar = array();
        $results = $this->front_database_model->front_read('settings');
        foreach ($results as $r) {
            $ar[$r['selector']] = $r['value'];
        }
        return $ar;
    }


    public function get_header_menu($parent_id = 0)
    {
        $pages = $this->front_database_model->front_read('pages', array('parent_id' => $parent_id, 'share' => true, 'header' => true, 'l_id' => get_lang()), array('num', 'asc'));
        return $pages;
    }

    private function footer_menu($id = 0)
    {

        if ($id == 0) {
            $pages = $this->front_database_model->front_read('pages', array('share' => true, 'footer' => true, 'l_id' => get_lang()), array('num', 'asc'));
        } else {
            $pages = $this->front_database_model->front_read_row('pages', array('page_id' => $id, 'l_id' => get_lang()));
        }
        return $pages;
    }


    public function get_footer_menu()
    {
        $footer_menu = $this->footer_menu();
        $ar = array();

        foreach ($footer_menu as $m) {
            $url = '';

            if (!empty($m['parent_id'])) {

                $url = $this->footer_menu($m['parent_id'])['url_tag'] . '/';
            }

            array_push($ar, array($m['title'], $url . $m['url_tag']));
        }

        return $ar;
    }


    private function page($id)
    {
        $page = $this->front_database_model->front_read_row('pages', array('url_tag' => $id, 'share' => true));
        if (count($page) > 0) {
            $other_page = $this->other_page($page['parent_id']);
            $ar = array('page' => $page, 'other_page' => $other_page, 'include' => '');
            if (!empty($page['include'])) {
                $ar['include'] = $this->front_database_model->front_read_row('include', array('id' => $page['include']))['url_tag'];
            }
            return $ar;
        } else {
            redirect(base_url() . '404', 'location');
        }
    }


    private function other_page($id)
    {
        if ($id == 0) {
            return array();
        } else {
            return $this->front_database_model->front_read('pages', array('parent_id' => $id, 'share' => true, 'l_id' => get_lang()), array('num', 'asc'));
        }
    }


    public function blogs_list($n = 50)
    {
        return $this->front_database_model->front_read('blogs', array('share' => true, 'l_id' => get_lang()), array('c_date', 'desc'), $n);
    }


    private function blog($id)
    {
        $blog = $this->front_database_model->front_read_row('blogs', array('url_tag' => $id, 'share' => true));
        if (count($blog) > 0) {
            return $blog;
        } else {
            redirect(base_url() . '404', 'location');
        }
    }


    private function partners_list()
    {
        return $this->front_database_model->front_query("select * from partners where share=true AND (l_id=" . get_lang() . " or l_id=0) order by num asc");
    }


    private function change_language($id)
    {

        $lang = $this->front_database_model->front_read_row('language', array('url_tag' => $id));
        $this->load->helper('cookie');
        set_cookie('lang', $lang['id'], time() + 3600);
        set_cookie('url_tag', $lang['url_tag'], time() + 3600);
        redirect(base_url(), 'location');
    }


    public function check_url($url, $table = array('pages'))
    {
        foreach ($table as $t) {
            $result = $this->front_database_model->front_read_row($t, array('url_tag' => $url));
            if (count($result) > 0) {
                $template = '';
                switch ($t) {
                    case 'pages':
                        $template = 'page';
                        break;
                    case 'blogs':
                        $template = 'blog';
                        break;
                    case 'events':
                        $template = 'event';
                        break;
                    case 'language':
                        $this->change_language($url);
                        break;
                }
                $this->show($template, $result);
            }
        }
    }


    private function breadcumb()
    {
        $segment = $this->uri->segment_array();

        if (count($segment) > 0) {

            $page = $this->front_database_model->front_read_in('pages', 'url_tag', $segment);
            $blog = $this->front_database_model->front_read_in('blogs', 'url_tag', $segment);
            $event = $this->front_database_model->front_read_in('events', 'url_tag', $segment);
            $ar = array_merge($page, $blog, $event);
            $r = array();

            /*header('Content-Type: application/json');
            echo '<pre>';*/
            if (count($segment) != count($ar)) {
            } else {
                foreach ($ar as $a) {
                    $index = array_search($a['url_tag'], $segment) - 1;
                    $r[$index] = $a;
                }
            }
            return $this->show_data('theme/breadcumb', array('breadcumb' => $r));
        } else {
            return array();
        }
    }


    public function home_types()
    {
        return $this->front_database_model->front_read('types', array('share' => true, 'home' => true, 'l_id' => get_lang()));
    }

    public function get_events()
    {
        return $this->front_database_model->front_read('events', array('share' => true), array('id', 'desc'));
    }


    //read country
    public function countries()
    {
        return $this->front_database_model->front_read('countries', array('share' => true));
    }
    //read cityes
    public function get_cityes()
    {
        return $this->front_database_model->front_read('cityes');
    }

    //read city where country id
    public function cityes($country_id = 0)
    {
        return $this->front_database_model->front_read('types', array('country_id' => $country_id));
    }


    //read event types
    public function types()
    {
        return $this->front_database_model->front_read('types', array('l_id' => get_lang(), 'share' => true));
    }


    //read event streams
    public function streams()
    {
        return $this->front_database_model->front_read('streams', array('l_id' => get_lang(), 'share' => true));
    }
    public function jobs()
    {
        return $this->front_database_model->front_read('jobs', array('share' => true));
    }


    //read event industry
    public function industry()
    {

        return $this->front_database_model->front_read('industry', array('l_id' => get_lang(), 'share' => true));
    }

    public function get_user_info($user_id)
    {
        $result = $this->front_database_model->front_read_row('users', array('status' => 'true', 'type' => 'company', 'id' => $user_id));
        if (count($result) > 0) {
            return $result;
        } else {
            return array('firstname' => '', 'lastname' => '');
        }
    }

    public function get_account_info($account_id)
    {
        $result = $this->front_database_model->front_read_row('account', array('id' => $account_id));
        if (count($result) > 0) {
            return $result;
        } else {
            return array('firstname' => '', 'lastname' => '');
        }
    }


    public function get_event_images($event_id)
    {
        return $this->front_database_model->front_read('events_image', array('event_id' => $event_id));
    }

    public function get_users_images($user_id)
    {
        return $this->front_database_model->front_read('users', array('id' => $user_id));
    }
    public function get_country($country_id)
    {
        $result = $this->front_database_model->front_read_row('countries', array('country_id' => $country_id));
        if (count($result) > 0)
            return $result;
        else
            return array('title' => '');
    }

    public function get_city($city_id)
    {
        $result = $this->front_database_model->front_read_row('cityes', array('city_id' => $city_id));
        if (count($result) > 0)
            return $result;
        else
            return array('title' => '');
    }

    public function get_stream($stream_id)
    {
        $result = $this->front_database_model->front_read_row('streams', array('stream_id' => $stream_id));
        if (count($result) > 0)
            return $result;
        else
            return array('title' => '');
    }

    public function get_type($type_id)
    {
        $result = $this->front_database_model->front_read_row('types', array('type_id' => $type_id));
        if (count($result) > 0)
            return $result;
        else
            return array('title' => '');
    }
    public function get_industry($industry_id)
    {
        $result = $this->front_database_model->front_read_row('industry', array('industry_id' => $industry_id));
        if (count($result) > 0)
            return $result;
        else
            return array('title' => '');
    }


    public function search($type_id = 0, $country_id = 0, $status_id = 0, $enddate = '', $date = '', $time = '', $industry_id = 0, $stream_id = 0, $entry_id = 0)
    {

        $where = '';
        if (!empty($type_id)) {
            $where .= ' AND type_id="' . $type_id . '"';
        }
        if (!empty($country_id)) {
            $where .= ' AND country_id="' . $country_id . '"';
        }
        if (!empty($status_id)) {
            $where .= ' AND status_id="' . $status_id . '"';
        }
        if (!empty($date)) {
            $where .= ' AND `date`="' . $date . '"';
        }
        if (!empty($enddate)) {
            $where .= ' AND `enddate`="' . $enddate . '"';
        }
        if (!empty($time)) {
            $where .= ' AND `time`="' . $time . '"';
        }
        if (!empty($industry_id)) {
            $where .= ' AND industry_id="' . $industry_id . '"';
        }
        if (!empty($stream_id)) {
            $where .= ' AND stream_id="' . $stream_id . '"';
        }
        if (!empty($entry_id)) {
            $where .= ' AND entry_id="' . $entry_id . '"';
        }

        if (!empty($where)) {
            $where = ' where ' . ltrim($where, ' AND');
        }

        $sql = "select * from events $where ORDER BY num DESC";
        $results = $this->front_database_model->front_query($sql);
        return $results;
        //
    }

    /*end products function */
    public function search_type($title)
    {
        $sql = "SELECT * FROM `events` WHERE  `events`.`type_id` IN
                 (SELECT  types.type_id FROM types WHERE types.title LIKE '%$title%')
                 OR events.country_id IN 
                 (SELECT countries.country_id FROM countries WHERE countries.title LIKE '%$title%')
                 OR events.city_id IN
                 (SELECT cityes.city_id FROM cityes WHERE cityes.title LIKE '%$title%')
                 OR events.title LIKE '%$title%' ORDER BY `events`.`num`  DESC";

        $result = $this->front_database_model->front_query($sql);
        $endresult = array();
        for ($i = 0; $i < count($this->front_database_model->front_query($sql)); $i++) {
            if ($result[$i]['share'] == 'true' and $result[$i]['user_id'] != 0) {
                $endresult[$i] = $result[$i];
            }
        }
        // print_r($endresult);
        // die;
        return $endresult;
    }


    public function show($template = 'home', $result = array(), $header = true, $footer = true, $js = '', $css = '')
    {

        $ar = array(
            'content' => $result,
            'seo_index' => 1,
            'language' => $this->language(),
            'contact' => $this->contact(),
            'string' => $this->string(),
            'breadcumb' => $this->breadcumb(),
            'og_image' => base_url() . 'assets/img/logo_og.png',
            'css' => $css,
            'js' => $js,
            'edit_controller' => '',
            'edit_id' => 0,
            'sliders' => '',
            'description' => '',
            'title' => '',
            'keywords' => '',
            'content_2' => array()
        );


        switch ($template) {

            case 'page':

                $ar['title'] = $ar['content']['page_title'];
                $ar['description'] = $ar['content']['description'];
                $ar['keywords'] = $ar['content']['keywords'];
                $ar['seo_index'] = $ar['content']['seo_index'];
                //
                $ar['edit_controller'] = 'pages';
                $ar['edit_id'] = $ar['content']['id'];
                //  


                $include = $this->front_database_model->front_read_row('include', array('id' => $result['include']));

                if (!empty($include['url_tag'])) {


                    $ar['content']['include'] = $include['url_tag'];
                    switch ($include['url_tag']) {
                        case 'blogs_list':
                            $ar['content_2']['blogs_list'] = $this->blogs_list();
                            break;

                        case 'partners':
                            $ar['content_2']['partners'] = $this->partners_list();
                            break;
                    }
                }

                break;
            case 'blog':
                $ar['title'] = $ar['content']['title'] . ' - ';
                $ar['description'] = $ar['content']['description'];
                $ar['keywords'] = $ar['content']['keywords'];
                $ar['og_image'] = rtrim(base_url(), '/') . get_image($ar['content']['image']);
                //
                $ar['edit_controller'] = 'blogs';
                $ar['edit_id'] = $ar['content']['id'];
                //
                break;
            case 'event':
                $ar['title'] = $ar['content']['title'];
                $ar['edit_controller'] = 'event';
                $ar['edit_id'] = $ar['content']['id'];
                break;

                /* case 'search':
            break; */
            case '404':
                $ar['seo_index'] = 0;
                $ar['title'] = '';
                $ar['description'] = '';
                break;

            default:
                $ar['title'] = $ar['string']['home_title'];
                $ar['description'] = $ar['string']['home_description'];
                $ar['keywords'] = $ar['string']['home_keywords'];
                $ar['content_2']['blogs_list'] = $this->blogs_list(8);
                $ar['content_2']['partners'] = $this->partners_list();
                // $ar['compress']=true;
                break;
        }


        $this->load->view('front/theme/header', $ar);
        //admin control
        if ($this->admin_model->get_admin(false)) {
            $admin_menu = $this->admin_model->get_admin_menu();
            //$this->load->view('admin/easy_edit',array('admin_menu'=>$admin_menu));
        }
        //end admin  control

        //header page
        if ($header == true) {
            $this->load->view('front/theme/top', $ar);
        }

        //template page
        $this->load->view('front/' . $template, $ar);

        //footer page
        if ($footer == true) {
            $this->load->view('front/theme/bottom', $ar);
        }


        $this->load->view('front/theme/footer', $ar);
    }


    public function show_data($template, $value)
    {

        $ar = array(
            'string' => $this->string()
        );

        return $this->load->view('front/' . $template, array_merge($ar, $value), true);
    }
}
