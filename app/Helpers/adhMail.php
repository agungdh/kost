<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Mailgun\Mailgun;

class adhMail {
    public function mail($toEmail, $subject, $body, $html = TRUE) {
        if (!file_exists(base_path('private/config/emailprovider.json'))) {
            echo 'Config not found!';
            die;
        }

        $config = json_decode(file_get_contents(base_path('private/config/emailprovider.json')));   

        if ($config->type == 'local') {
            $this->sendMail($toEmail, $subject, $body, $html);
        } elseif ($config->type == 'smtp') {
            $this->sendSMTPMail($toEmail, $subject, $body, $html);
        } elseif ($config->type == 'mailgun') {
            $this->mailgun($toEmail, $subject, $body);
        } else {
            echo 'Fatal Error !!!';
            die;
        }
    }

    public static function sendSMTPMail($toEmail, $subject, $body, $html = TRUE)
    {
        if (!file_exists(base_path('private/config/smtpemail.json'))) {
            echo 'Config not found!';
            die;
        }

        $config = json_decode(file_get_contents(base_path('private/config/smtpemail.json')));

        $data = new \stdClass();

        $mail = new PHPMailer(true);                              
        try {
            $mail->isSMTP();                                      
            $mail->Host = $config->host;  
            $mail->SMTPOptions = [ 'ssl' => [
                                     'verify_peer' => false,
                                     'verify_peer_name' => false,
                                     'allow_self_signed' => true
                                    ]
                                ];
            $mail->SMTPAuth = true;                               
            $mail->Username = $config->username;                 
            $mail->Password = $config->password;                           
            $mail->SMTPSecure = $config->encryption;                            
            $mail->Port = $config->port;                                    

            $mail->setFrom($config->username);
            $mail->addAddress($toEmail);               
            
            $mail->isHTML($html);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            
            $data->success = true;
        } catch (Exception $e) {
            $data->message = $mail->ErrorInfo;

            $data->success = false;
        }

        return $data;
    }

    public static function sendMail($toEmail, $subject, $body, $html = TRUE)
    {
        if (!file_exists(base_path('private/config/email.json'))) {
            echo 'Config not found!';
            die;
        }

        $config = json_decode(file_get_contents(base_path('private/config/email.json')));

        $data = new \stdClass();

        $mail = new PHPMailer(true);                              
        try {
            $mail->setFrom($config->from);
            $mail->addAddress($toEmail);               
            
            $mail->isHTML($html);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            
            $data->success = true;
        } catch (Exception $e) {
            $data->message = $mail->ErrorInfo;

            $data->success = false;
        }

        return $data;
    }

    public function mailgun($toEmail, $subject, $body)
    {
        $mgClient = new Mailgun(env('MAILGUN_API_KEY'));
        $domain = "mailgun.server1agungdh.site";

        $result = $mgClient->sendMessage($domain, [
            'from'    => 'NO REPLY <noreply@mailgun.server1agungdh.site>',
            'to'      => $toEmail,
            'subject' => $subject,
            'html'    => $body
        ]);

    }
}