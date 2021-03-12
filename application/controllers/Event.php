<?php

class event extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('front/home_model');
        $this->load->model('front/front_database_model');
        $this->load->model('admin/mail_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->home_model->show('addevent');
    }

    public function add()
    {

        $string = $this->home_model->string();

        if (!$this->home_model->get_user_type()) :

            //$user_id = $this->home_model->get_user(true)['id'];

            $this->load->library('form_validation');
            $this->form_validation->set_message('required', $string['form_required_error']);
            $this->form_validation->set_message('valid_email', $string['form_valid_email_error']);

            $this->form_validation->set_rules('country_id', 'Country', 'trim|required|numeric');
            $this->form_validation->set_rules('city_id', 'City', 'trim|required|numeric');
            $this->form_validation->set_rules('title', 'Event title', 'trim|required');
            $this->form_validation->set_rules('date', 'Date', 'trim|required');
            $this->form_validation->set_rules('time', 'Time', 'trim|required');

            $this->form_validation->set_rules('enddate', 'End Date', 'trim|required');
            $this->form_validation->set_rules('endtime', 'End Time', 'trim|required');
            if (count($_FILES) == 0) {
                $this->form_validation->set_rules('image', 'Img', 'required');
            }
            $this->form_validation->set_rules('status_id', 'Status', 'trim|required');
            $this->form_validation->set_rules('type_id', 'Event type', 'trim|required');
            $this->form_validation->set_rules('entry_id', 'Entry', 'trim|required');
            $this->form_validation->set_rules('stream_id', 'Stream', 'trim|required');
            $this->form_validation->set_rules('industry_id', 'Industry', 'trim|required');

            $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('website', 'Web', 'trim');
            $this->form_validation->set_rules('content', 'Note', 'trim');

            $this->form_validation->set_rules('facebook', 'Facebook', 'trim');
            $this->form_validation->set_rules('twitter', 'Twitter', 'trim');
            $this->form_validation->set_rules('linkedin', 'Linkedin', 'trim');
            $this->form_validation->set_rules('map', 'Map', 'trim');
            $this->form_validation->set_rules('video_link', 'Video link', 'trim');
            $this->form_validation->set_rules('tag', 'Tag', 'trim');
            $result = array(

                'country_id'    => '',
                'city_id'       => '',
                'enddate'       => '',
                'endtime'       => '',
                'title'         => '',
                'date'          => '',
                'time'          => '',
                'status_id'     => '',
                'type_id'       => '',
                'entry_id'      => '',
                'stream_id'     => '',
                'industry_id'   => '',
                'mail'          => '',
                'phone'         => '',
                'website'       => '',
                'content'       => '',
                'facebook'      => '',
                'twitter'       => '',
                'linkedin'      => '',
                'map'           => '',
                'video_link'    => '',
                'tag'           => ''
            );
            $arrray1 = array('image' => '');
            if (count($_FILES) == 0) {
                $result = $arrray1 + $result;
            }


            if ($this->form_validation->run() == FALSE) {

                foreach ($result as $key => $value) {
                    $result[$key]     = form_error($key, '<span class="text-red">', '</span>');
                }
            } else {

                foreach ($result as $key => $value) {
                    $result[$key] = $this->input->post($key);
                }

                $send_request = $this->input->post('send_request');

                foreach ($send_request as $s) {
                    if (!check_event_send_request($s)) {
                        die;
                    }
                }

                if (!check_event_status_request($result['status_id'])) {
                    die;
                }

                if (!check_event_entry_request($result['entry_id'])) {
                    die;
                }

                //create event id
                $result['event_id']     = create_id();
                $result['url_tag']      = set_link($result['title']);
                // $result['user_id']      = $user_id;
                //file upload

                if (!empty($_FILES['image']['name'])) {

                    $this->load->model('admin/upload_model');
                    $file       = $_FILES['image'];
                    $length     = count($file['name']);

                    if (!empty($ch_id)) {
                        $result['event_id'] = $this->database_model->read_row('events', $ch_id)['event_id'];
                    }


                    for ($n = 0; $n < $length; $n++) {

                        $_FILES['fayl']['name']       = $file['name'][$n];
                        $_FILES['fayl']['tmp_name']   = $file['tmp_name'][$n];
                        $_FILES['fayl']['size']       = $file['size'][$n];
                        $_FILES['fayl']['type']       = $file['type'][$n];
                        $_FILES['fayl']['error']      = $file['error'][$n];


                        $url = $this->upload_model->image('fayl', 800, 200);


                        $ar = array(
                            'image'       => $url,
                            'event_id'    => $result['event_id']
                        );

                        $this->front_database_model->front_insert('events_image', $ar);
                    }
                }

                $result['send_request'] = json_encode($this->input->post('send_request'));


                $this->front_database_model->front_insert('events', $result);

                $result['success'] = $string['add_event_success'];
            }
            echo json_encode($result);
        else :
            echo json_encode(array('success' => $string['please_login_account']));
        endif;
    }
    // public function add_media()
    // {
    //     $result = array();
    //     $eventdata = $this->front_database_model->front_read_row('account', array('id' => 2));
    //     $string = $this->home_model->string();
    //     $media = $this->input->post('contentmedia');
    //     $mn = "Media Müraciəti";
    //     $content = '<table>
    //     <thead>
    //        <tr>
    //            <th>Yeni Müraciət</th>
    //        </tr>
    //     </thead>

    //    <tbody>
    //        <tr>
    //            <td>' . $mn . '</td>
    //        </tr>
    //    </tbody>
    //    </table>';
    //     if (!empty($media)) {
    //         $this->mail_model->send_mail("Yeni Media Müraciəti Var", $eventdata['mail'],  $content);
    //         $result['success'] = $string['add_media_success'];
    //     } else {
    //         $result['success'] = $string['add_media_error'];
    //     }

    //     echo json_encode($result);
    // }
    public function add_jobs()
    {
        $result = array();
        $eventdata = $this->front_database_model->front_read_row('account', array('id' => 2));
        $string = $this->home_model->string();
        $job = $this->input->post('contentjob');
        $mn = "İş Müraciəti";
        $content = '<table>
        <thead>
           <tr>
               <th>Yeni Müraciət</th>
           </tr>
        </thead>

       <tbody>
           <tr>
               <td>' . $job . '</td>
           </tr>
       </tbody>
       </table>';

        if (!empty($job)) {
            $this->mail_model->send_mail("Yeni İş Müraciəti Var", $eventdata['mail'],  $content);
            $result['success'] = $string['add_job_success'];
        } else {
            $result['success'] = $string['add_job_error'];
        }
        echo json_encode($result);
    }
    public function delete()
    {
    }

    public function readComments($name, $comment)
    {

        $comments = '<div>
            <div class="author">
                <div>' . $name  . '
                    <span>' . $comment . '</span>
                </div>
            </div>
            <div class="comments">
                <i class="fas fa-comment-dots"></i>
            </div>
        </div>';
        echo $comments;
    }

    // public function addComment()
    // {
    //     $comment  = $this->input->post('comment');
    //     $user_id   = $this->input->post('user_id');
    //     $event_id      = $this->input->post('event_id');
    //     $time   = $this->input->post('time');
    //     $ar = array(
    //         'comment' => $comment,
    //         'user_id' => $user_id,
    //         'event_id' => $event_id,
    //         'time' => $time
    //     );
    //     $name = $this->home_model->get_user_info($user_id)['firstname'];
    //     if (!empty($comment) and !empty($event_id) and !empty($user_id)) {
    //         if ($this->session->userdata("user")['id'] == $user_id) {
    //             $this->front_database_model->front_insert('comments', $ar);
    //         }
    //         $this->readComments($name, $comment);
    //     }
    // }
    function bloglist()
    {
        $name = $this->input->post('media');
        if (!empty($name)) {
            $query = "SELECT * FROM `blogs` WHERE  `title` LIKE '%$name%' AND  `share`='true'";
            $serch_results = $this->front_database_model->front_query($query);
            $this->home_model->show('blogs_list', array('search_results' => $serch_results));
        } else {
            $this->home_model->show('blogs_list');
        }
    }
    public function profile()
    {
        $this->home_model->show('profile');
    }
    public function  send_request()
    {
        $post = $this->input->post();
        $event_id = $this->input->post('event_id');

        $eventdata = $this->front_database_model->front_read_row('events', array('event_id' => $event_id));


        $mn = '';
        if ($post[0] == 'attendee') {
            $mn = 'Istirakci';
        }
        if ($post[0] == 'participant_booth') {
            $mn = 'Istirakci Lovhesi';
        }
        if ($post[0] == 'speaker_pass') {
            $mn = 'Spiker Girisi ';
        }
        if ($post[0] == 'sponsorship_partner') {
            $mn = 'Sponsor Terefdasi';
        }
        if ($post[0] == 'media_partner') {
            $mn = 'Media Terefdasi';
        }
        if ($post[0] == 'entry_ticket') {
            $mn = 'Giris Bileti';
        }
        $content = '<table>
                            <thead>
                               <tr>
                                   <th>Müraciətin Forması</th>
                               </tr>
                            </thead>

                           <tbody>
                               <tr>
                                   <td>' . $mn . '</td>
                               </tr>
                           </tbody>
                </table>';
        switch ($post['0']) {
            case 'attendee':
                if (!empty($userdata) and check_event_send_request($post[0])) {
                    $this->mail_model->send_mail("Yeni Müraciət Var", $eventdata['mail'],  $content);
                    $this->front_database_model->front_insert("log", array('event_id' => $event_id));
                }
                break;
            case 'participant_booth':
                if (!empty($userdata) and check_event_send_request($post[0])) {
                    $this->mail_model->send_mail("Yeni Müraciət Var", $eventdata['mail'],  $content);
                    $this->front_database_model->front_insert("log", array('event_id' => $event_id));
                }
                break;
            case 'speaker_pass':
                if (!empty($userdata) and check_event_send_request($post[0])) {
                    $this->mail_model->send_mail("Yeni Müraciət Var", $eventdata['mail'],  $content);
                    $this->front_database_model->front_insert("log", array('event_id' => $event_id));
                }
                break;
            case 'sponsorship_partner':
                if (!empty($userdata) and check_event_send_request($post[0])) {
                    $this->mail_model->send_mail("Yeni Müraciət Var", $eventdata['mail'],  $content);
                    $this->front_database_model->front_insert("log", array('event_id' => $event_id));
                }
                break;
            case 'media_partner':
                if (!empty($userdata) and check_event_send_request($post[0])) {
                    $this->mail_model->send_mail("Yeni Müraciət Var", $eventdata['mail'],  $content);
                    $this->front_database_model->front_insert("log", array('event_id' => $event_id));
                }
                break;
            case 'entry_ticket':
                if (!empty($userdata) and check_event_send_request($post[0])) {
                    $this->mail_model->send_mail("Yeni Müraciət Var", $eventdata['mail'],  $content);
                    $this->front_database_model->front_insert("log", array('event_id' => $event_id));
                }
                break;
        }
    }
    public function organizer()
    {
        $this->home_model->show('organizer');
    }


    public function jobs()
    {
        $qrafik = $this->input->post('job_graphic');
        $cities = $this->input->post('cities');
        $name = $this->input->post('name');
        // Hamsi Doludusa DUZDU
        if (!empty($name) and !empty($qrafik) and !empty($cities)) {
            $query = "SELECT * FROM `jobs` 
            INNER JOIN `cityes` ON  `jobs`.`city_id`=`cityes`.`city_id`
            WHERE `jobs`.`share`='true'
            AND `cityes`.`city_id`='$cities'
            AND `jobs`.`work_graphic`='$qrafik'
            AND `jobs`.`vacancy_name` LIKE '%$name%' ORDER BY `num` DESC ";
            $serch_results = $this->front_database_model->front_query($query);
            $name = '';
            $qrafik = '';
            $cities = '';
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
        //Ad Seher DUZDU
        if (!empty($name) and !empty($cities)) {
            $query = "SELECT * FROM `jobs` 
            INNER JOIN `cityes` ON  `jobs`.`city_id`=`cityes`.`city_id`
            WHERE `jobs`.`share`='true'
            AND `cityes`.`city_id`='$cities'
            AND `jobs`.`vacancy_name` LIKE '%$name%' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $name = '';
            $cities = '';
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
        //Ad Qrafik DUZDU
        if (!empty($name) and !empty($qrafik)) {
            $query = "SELECT * FROM `jobs` 
            INNER JOIN `cityes` ON  `jobs`.`city_id`=`cityes`.`city_id`
            WHERE `jobs`.`share`='true'
            AND `jobs`.`work_graphic`='$qrafik'
            AND `jobs`.`vacancy_name` LIKE '%$name%' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $name = '';
            $qrafik = '';
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
        //Seher Qrafik DUZDU
        if (!empty($qrafik) and !empty($cities)) {
            $query = "SELECT * FROM `jobs` 
            INNER JOIN `cityes` ON  `jobs`.`city_id`=`cityes`.`city_id`
            WHERE `jobs`.`share`='true'
            AND `cityes`.`city_id`='$cities'
            AND `jobs`.`work_graphic`='$qrafik' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $qrafik = '';
            $cities = '';
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }

        //Ada Gore Axtarir DUZDU
        if (!empty($name)) {
            $query = "SELECT * FROM `jobs`  WHERE vacancy_name LIKE '%$name%' AND `share`='true' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
        //Qrafike Gore Axtarilir DUZDU
        if (!empty($qrafik)) {
            $query = "SELECT * FROM `jobs`  WHERE  work_graphic='$qrafik' AND `share`='true' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
        //Sehere Gore Axtarir DUZDU
        if (!empty($cities)) {
            $query = "SELECT * FROM `jobs` 
            INNER JOIN `cityes` ON  `jobs`.`city_id`=`cityes`.`city_id`
            WHERE `jobs`.`share`='true' AND `cityes`.`city_id`='$cities' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
        //Hecbiri Dolu Deyilse DUZDU
        if (empty($qrafik) and empty($cities) and empty($name)) {
            $query = "SELECT * FROM `jobs` WHERE `share`='true' ORDER BY `num` DESC";
            $serch_results = $this->front_database_model->front_query($query);
            $this->home_model->show('jobs_searched_list', array('search_results' => $serch_results));
        }
    }

    public function get_organizers_jobs($id)
    {
        $jobs = $this->front_database_model->front_read('jobs', array('id' => $id));
        $this->home_model->show('jobsearch', array('jobs' =>  $jobs));
    }
    public function get_organizers_events($id)
    {
        $events = $this->front_database_model->front_read('events', array('user_id' => $id));
        $this->home_model->show('organizers_events', array('results' => $events));
    }
}
