<?php 
class image_change extends CI_Controller{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/upload_model');
    }

    public function page(){
        $pages=$this->database_model->front_read('pages');
        foreach($pages as $p){
            $file= get_json($p['image'])->link;
            $this->upload_model->resize_image($file,'compress',500);
        }
    }
    public function products(){
        $products_image=$this->database_model->front_read('products_image');

        foreach($products_image as $p){
            $file= get_json($p['image'])->link;
            $this->upload_model->resize_image($file,'compress',800);
            $this->upload_model->resize_image($file,'thumb',344);
        }
        echo 'done';
    }
    public function blog(){
        $blog=$this->database_model->front_read('blog');
        foreach($blog as $p){
            $file= get_json($p['image'])->link;
            $this->upload_model->resize_image($file,'compress',500);
        }
    }
    public function sliders(){

    }
}

?>