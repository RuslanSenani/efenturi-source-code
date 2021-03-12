<?php
class Mail_model extends CI_Model{
    public function send_mail($title,$to,$content){
        $subject = $title;

        $message = "
        <html>
        <head>
        <title>$title</title>
        </head>
        <body>
        $content
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@askpand.com>' . "\r\n";

        return mail($to,$subject,$message,$headers);
    }
}