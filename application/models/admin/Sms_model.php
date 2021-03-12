<?php
class Sms_model extends CI_Model{

    public function send($number,$title,$content){
        $url="https://gw.soft-line.az/sendsms?user=setapi&password=uweZVmIM&gsm=".$number."&from=".$title."&text=".urlencode($content);
        echo $url;
        echo '<br>';
        return file_get_contents($url);
    }

}

?>