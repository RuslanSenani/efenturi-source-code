<?php
class cpanel_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->helper('cpanel');   
        $this->config->load('cpanel');     
    }

    private function get_auth(){
        
        $username       =$this->config->item('cpanel_username');
        $password       =$this->config->item('cpanel_password');
        $domain         =$this->config->item('cpanel_domain');
        $ip             =$this->config->item('cpanel_ip');
        $port           =$this->config->item('cpanel_port');
        $xmlapi         =connect_cpanel($username,$password,$domain,$ip,$port);
        return          $xmlapi;
    }


    public function list_mails(){
        $xmlapi=$this->get_auth();
        $data=json_decode($xmlapi->api2_query($this->config->item('cpanel_username'), "Email", "listpopswithdisk"));
        $ar=$data->cpanelresult->data;
        $res=array();
        foreach($ar as $a){
            if($a->domain==$this->config->item('cpanel_domain')){
                array_push($res,$a);
            }
        }
        return $res;
    }

    public function add_mails($mail,$password,$quota){
        $m=explode('@',$mail);
        
        if($m[1]==$this->config->item('cpanel_domain')){
            $xmlapi=$this->get_auth();
            $ar=array(
                'domain'        => $this->config->item('cpanel_domain'), 
                'email'         => $mail, 
                'password'      => $password, 
                'quota'         => $quota
            );
            $results = json_decode($xmlapi->api2_query("serverusername", "Email", "addpop", $ar), true);
            
            if($results['cpanelresult']['data'][0]['result']){
                return true;
            } 
            else {
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function delete_mails($mail){
        $m=explode('@',$mail);
        if($m[1]==$this->config->item('cpanel_domain')){
            $xmlapi=$this->get_auth();
            $ar = array(
                'domain'=>$this->config->item('cpanel_domain'), 
                'email'=>$mail
            );
            $xmlapi->api2_query($this->config->item('cpanel_username'), "Email", "delpop", $ar);
            return true;
        }
    }

}

?>