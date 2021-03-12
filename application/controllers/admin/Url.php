<?php
class url extends CI_Controller{
    public function index(){
        $title=$this->input->post('title');
        if(!empty($title)){
        echo set_link($title);
        }
    }
}
?>