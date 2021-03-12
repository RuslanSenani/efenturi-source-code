<?php
class Sitemap extends CI_Controller{
    public function index(){
        $this->load->model('front/front_database_model');
        $this->load->model('front/home_model');
        header ("Content-Type:text/xml");
        $date=date('Y-m-d').'T'.date("H:i:s").'+00:00';
        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
              xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                    ';
                    

        $pages=$this->front_database_model->front_read('pages',array('share'=>true,'seo_index'=>true));
        foreach($pages as $p){

            $url=base_url().$p['url_tag'];
            if(!empty($p['parent_id'])){
                $parent=$this->front_database_model->front_read_row('pages',array('page_id'=>$p['parent_id'],'l_id'=>$p['l_id']));
                $url=base_url().$parent['url_tag'].'/'.$p['url_tag'];
            }

            echo '<url>
            <loc>'.$url.'</loc>
            <lastmod>'.$date.'</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.00</priority>
          </url>';
        }


        $blog=$this->front_database_model->front_read('blogs',array('share'=>true));
        foreach($blog as $b){
            echo '<url>
            <loc>'.base_url().$b['url_tag'].'</loc>
            <lastmod>'.$date.'</lastmod>
            <priority>1.00</priority>
          </url>';
        }


        $language=$this->front_database_model->front_read('language',array('share'=>true));
        foreach($language as $l){
            echo '<url>
            <loc>'.base_url().$l['url_tag'].'</loc>
            <lastmod>'.$date.'</lastmod>
            <priority>1.00</priority>
          </url>';
        }

        $categories=$this->front_database_model->front_read('categories',array('share'=>true));
        foreach($categories as $c){
            echo '<url>
            <loc>'.base_url().$c['url_tag'].'</loc>
            <lastmod>'.$date.'</lastmod>
            <priority>1.00</priority>
          </url>';
        }

        $products=$this->front_database_model->front_read('products',array('share'=>true));
        foreach($products as $p){
            $category_url=$this->home_model->category($p['category_id'])['url_tag'].'/';
            echo '<url>
            <loc>'.base_url().$category_url.$c['url_tag'].'</loc>
            <lastmod>'.$date.'</lastmod>
            <priority>1.00</priority>
          </url>';
        }

        echo '</urlset>';
        die;
    }
}

?>