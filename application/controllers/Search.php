<?php
class search extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('front/home_model');
        $this->load->model('front/front_database_model');
    }

    public function index($type_id = 0)
    {
        $this->home_model->show('search_results', array('type_id' => $type_id));
    }

    public function read()
    {
        /*  $search=$this->input->post('search',true); */
        $type_id        = $this->input->get('type_id');
        $country_id     = $this->input->get('country_id');
        $status_id      = $this->input->get('status_id');
        $time           = $this->input->get('time');
        $industry_id    = $this->input->get('industry_id');
        $stream_id      = $this->input->get('stream_id');
        $entry_id       = $this->input->get('entry_id');
        $date           = $this->input->get('date');
        $enddate        = $this->input->get('enddate');

        $results = $this->home_model->search($type_id, $country_id, $status_id, $enddate, $date, $time, $industry_id, $stream_id, $entry_id);
        $endresult = array();
        for ($i = 0; $i < count($results); $i++) {
            if ($results[$i]['share'] == 'true' and $results[$i]['user_id'] != 0) {
                $endresult[$i] = $results[$i];
            }
        }
        echo $this->home_model->show_data('items/search_items', array('results' => $endresult));
    }
    public function query()
    {

        $results = $this->input->post('title', true);
        if (!empty($results)) {
            $results = $this->home_model->search_type($results);
            echo $this->home_model->show('items/search_items1', array('results' => $results));
        } else {
            redirect(base_url('search/'));
        }
    }

    public function search_organizer()
    {

        $ad = $this->input->post('organizer');
        $users = $this->front_database_model->front_query("SELECT * FROM `users` WHERE company LIKE '%$ad%'");
        $this->home_model->show('items/search_organizer_items', array('userdata' => $users));
    }
}
