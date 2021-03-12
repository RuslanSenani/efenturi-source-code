<?php
include_once 'xmlapi.php';

function connect_cpanel($account,$account_pass,$domain,$ip,$port){

$xmlapi = new xmlapi($ip);
$xmlapi->password_auth($account, $account_pass);
$xmlapi->set_output('json');
$xmlapi->set_port($port); // Need to Change.
$xmlapi->set_debug(1);
return $xmlapi;

}
 


?>