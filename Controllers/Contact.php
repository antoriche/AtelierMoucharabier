<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    class Contact extends Controller{

        private function config(){
            return json_decode(file_get_contents("config.json"));
        }

        private function importPHPMailer(){
            $path = "./PHPMailer/";
            require $path.'src/Exception.php';
            require $path.'src/PHPMailer.php';
            require $path.'src/SMTP.php';
        }

        private function uploadFiles(){
            if(count($_FILES["attachments"]["name"]) <= 0)return null;
            $target_dir = "Attachments/".time().'/';
            if(!is_dir($target_dir))mkdir($target_dir);
            $ret = array();
            foreach( $_FILES["attachments"]["name"] as $i => $name ){
                $target_file = $target_dir . basename($name);
                if (!move_uploaded_file($_FILES["attachments"]["tmp_name"][$i], $target_file)) {
                    rmdir($target_dir);
                    throw "Erreur lors de l'importation des fichiers";
                }
                $ret[$name]='http://'. $_SERVER ['HTTP_HOST']. '/' .$target_file;
            }
            return $ret;
        }

        private function sendMail(){
            $this->importPHPMailer();

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                $config = $this->config();
                $emailToRedirect = $config->email;
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = $config->smtp;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $config->email;                 // SMTP username
                $mail->Password = $config->password;                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($_POST["email"]);
                $mail->addAddress($emailToRedirect);     // Add a recipient
                $mail->addReplyTo($_POST["email"]);

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                $files = $this->uploadFiles();

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $_POST["subject"];
                $mail->Body =   "<div>".str_replace("\r","<br>",$_POST["message"]) . "</div><br>\r\n\r\n";
                                
                $mail->AltBody= $_POST["message"] ."\r\n\r\n".
                               "Pièces jointes : \r\n";
                if($files){
                    $mail->Body .="<div><b>Pièces jointes : </b><ul>";
                    foreach($files as $name => $link){
                        $mail->Body .= "<li><a href='$link'>$name</a></li>";
                        $mail->AltBody .= "\t$link\r\n";
                    }
                    $mail->Body .= "</ul></div>";
                }
                


                $mail->send();
            } catch (Exception $e) {
                echo 'Désolé, Une erreur s\'est produite lors de l\'envoi du message : '.$e;
            }
        }
        
        public function run(){
            $shouldSend = isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"]);
            if($shouldSend){
                $this->sendMail();
            }
        }
    }
?>