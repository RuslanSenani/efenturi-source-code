<?php
class file extends CI_Controller
{
    public function index(){
//
    }

    private function get_imagelink($file){
        $response = new StdClass;
        $file=get_json($file)->link;
        $response->link=base_url().'uploads/images/'.$file;
        return json_encode($response);
    }
    public function upload_image(){
        $this->load->model('admin/upload_model');
        echo $this->get_imagelink($this->upload_model->image('image_file'));
    }
    public function upload_video(){
        $this->load->model('admin/upload_model');
        echo $this->get_imagelink($this->upload_model->video('video_file'));
    }
}
?>