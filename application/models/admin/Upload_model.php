<?php
class upload_model extends CI_Model
{
    public function resize_image($file_name,$save_folder,$height=100,$persent=100,$add_logo=false){
        
        $file   ='uploads/images/'.$file_name;
        $type   =explode('.',$file_name)[1];

        if($type!='svg'){

            list($mevcutGenislik, $mevcutYukseklik) = getimagesize($file);
            $nisbet =$mevcutGenislik/$mevcutYukseklik;
            //echo $nisbet;
            $width=$nisbet*$height;
            

            $hedef  = imagecreatetruecolor($width, $height);

            switch($type){
                case 'jpg':
                    header('Content-type: image/jpg');
                    $kaynak = imagecreatefromjpeg($file);
                    break;
                case 'jpeg':
                    header('Content-type: image/jpeg');
                    $kaynak = imagecreatefromjpeg($file);
                    break;
                case 'png':
                    header('Content-type: image/png');
                    $kaynak = imagecreatefrompng($file);
                    break;
                case 'gif':
                    header('Content-type: image/gif');
                    $kaynak = imagecreatefromgif($file);
                    break;
            }


            if($add_logo==true){
            
                $logo = 'assets/img/logo_small.png';
            
                $eklenen_resim = imagecreatefrompng($logo);
                list($genislik, $yukseklik) = getimagesize($logo);

                $sag = 10;
                $sol = imagesy($kaynak) - $yukseklik;

                imagecopy($kaynak, $eklenen_resim, $sag, $sol, 0, 0, $genislik, $yukseklik);
            // imagejpeg($hedef);
                //imagecopymerge($mevcut_resim, $eklenen_resim, $sag, $sol, 0, 0, $genislik, $yukseklik, 50);
            }


            imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $width, $height, $mevcutGenislik, $mevcutYukseklik);
            $file_name=str_replace($type, 'jpg', $file_name);
            $webp =imagejpeg($hedef,'./uploads/'.$save_folder.'/'.$file_name);
            imagedestroy($hedef);
            return $file_name;
        }
        else{
            return $file_name;
        }
    }
    

    public function image($file,$height=0,$thumb_height=0,$persent=100,$add_logo=false){

        if(true){
            
            $config['upload_path']          = './uploads/images/';
            $config['allowed_types']        = 'svg|gif|jpg|png|jpeg';
            $config['max_size']             = 200048;
            $config['max_width']            = 15000;
            $config['max_height']           = 15000;
            $config['encrypt_name']         = TRUE;

            $_FILES[$file]['name']=strtolower($_FILES[$file]['name']);

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file))
            {
                $error = array('error' => $this->upload->display_errors());
               /*  echo $error['error'];
                die; */
                return '';
            }
            else
            {
               
                $data = array('upload_data' => $this->upload->data());
                $response = new StdClass;
                $response->thumb    = false;
                $response->webp     = false;
                $response->webp_url ='';
                $response->link     = $data['upload_data']['file_name'];

                if($height!=0){
                    $response->webp_url =$this->resize_image($data['upload_data']['file_name'],'webp',$height,$persent,$add_logo);
                    $response->webp = true;
                }
                if($thumb_height !=0){
                    $response->webp_url =$this->resize_image($data['upload_data']['file_name'],'thumb',$thumb_height,$persent,$add_logo);
                    $response->thumb = true;
                }
                return stripslashes(json_encode($response));
            }
        }
        
    }


    public function video($file){
        if($this->admin_model->get_admin()){
        $config['upload_path']          = './uploads/videos/';
        $config['allowed_types']        = '3gp|mp4|ogg';
        $config['max_size']             = 50000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($file))
        {
            $error = array('error' => $this->upload->display_errors());
            return "Upload Error";
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $response = new StdClass;
            $response->link = base_url().'uploads/videos/'. $data['upload_data']['file_name'];
            return stripslashes(json_encode($response));
        }
        }
    }
    
}
?>