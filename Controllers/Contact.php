<?php
    class Contact extends Controller{
        
        public function run(){
            $emailToRedirect = "antoriche.ar@gmail.com";
            $shouldSend = isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"]);
            if($shouldSend){
                $headers =  'From: ' . $_POST["email"] . "\r\n" .
                        'Reply-To: ' . $_POST["email"] . "\r\n";
                        //'Content-type: text/html' . "\r\n";
                $message = "<div>".str_replace("\r","<br>",$_POST["message"]) . "</div>\r\n\r\n".
                            "<div><b>Pièces jointes : </b><ul></ul></div>";
                echo mail($emailToRedirect, $_POST["subject"], $message, $headers);
                // echo "mail sent";
            }
        }
    }
?>