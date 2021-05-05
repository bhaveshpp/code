<?php
require('conn.php');
require_once("code/PEAR/Mail.php");
require_once("code/PEAR/Mail/mime.php");

class Request
{

    const NEWSLETTER_TEMPLATE = 'code/Tecksky/Helper/email/newsletter.html';

    const CONTACT_TEMPLATE = 'code/Tecksky/Helper/email/contact.html';

    const CAREEAR_TEMPLATE = 'code/Tecksky/Helper/email/careear.html';
     
    protected $_conn;

    public function __construct()
    {
        $this->_conn = conn();
    }

    public function getEmailTemplate($temp, $var)
    {
        try {
            include($temp);
        } catch (\Exception $exception) {
            ob_end_clean();
            throw $exception;
        }
        return ob_get_clean();
    }

    public function sendMail($from = CONFIG['SMTP_SENDER'], $to = CONFIG['SMTP_RECIVER'], $subject = "", $body = "", $target_file = "", $fileType = "")
    {
        
        
        $smtp = Mail::factory('smtp', array(
            'host' => CONFIG['SMTP_HOST'],
            'port' => CONFIG['SMTP_PORT'],
            'auth' => true,
            'username' => CONFIG['SMTP_USER'],
            'password' => CONFIG['SMTP_PASS']
        ));

        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $mime = new Mail_mime();
        $mime->setHTMLBody($body);
        if (!empty($target_file)) {
            $mime->addAttachment($target_file, $fileType);
        }
        $body = $mime->get();
        $headers = $mime->headers($headers);
        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            return [
                'success'=> false,
                'message'=> $mail->getMessage()
            ];
        } else {
            return [
                'success'=> true,
                'message'=> "Message successfully sent!"
            ];
        }
    }

    public function buildInsertQuery($table,$data)
    {
        $sql = "INSERT INTO " . $table . " (";
        foreach (array_keys($data) as $key) {
            $sql .= $key.", ";    
        }

        $sql = substr($sql, 0, -2);
        $sql .= ") VALUES (";
        
        foreach ($data as $value) {
            $sql .= "'".$value."', ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ");";
        return $sql;
    }

    public function insertData($table, $data)
    {
        $sql = $this->buildInsertQuery($table, $data);
        
        if ($this->_conn->query($sql) === true) {
            return [
                "success" => true,
                "message" => "Data saved in table successfully"
            ];
        } else {
            return [
                "success" => false,
                "message" => "Error during savedata ".$this->_conn->connect_error
            ];
        }
    }

    public function validateContact($data)
    {
        if (empty($data['contact_name']) || 
            empty($data['contact_email']) || 
            empty($data['contact_subject']) || 
            empty($data['contact_service']) || 
            empty($data['contact_message'])) {
            return false;
        }
        
        return true;
    }

    public function submitContact($data)
    {
        if ($this->validateContact($data)) {
            $save = $this->insertData('contact', $data);
            if ($save['success']) {
                $from = CONFIG['SMTP_SENDER'];
                $to = CONFIG['SMTP_RECIVER'];
                $body = $this->getEmailTemplate($this::CONTACT_TEMPLATE,$data);                
                $mail = $this->sendMail($from, $to, $data['contact_subject'], $body);
                return [
                    "success" => true,
                    "message" => "Thank you for contact us"
                ];
            }
        }else{
            return [
                "success" => false,
                "message" => "Data missing"
            ];
        }
    }

    public function updateNewsletterSubscription($data, $statu = 1)
    {
        $sql = "UPDATE `newsletter` SET `status` = '".$statu."' WHERE `newsletter`.`email` = '".$data['email']."';";
        
        if ($this->_conn->query($sql) === true) {
            $from = CONFIG['SMTP_SENDER'];
            $subject = "Newsletter Subscription";
            $body = $this->getEmailTemplate($this::NEWSLETTER_TEMPLATE,$data);
            $mail = $this->sendMail($from, $data['email'], $subject, $body);
            return [
                "success" => true,
                "message" => "Thank you for enable subscription"
            ];
        } else {
            return [
                "success" => false,
                "message" => "Error during savedata ".$this->_conn->connect_error
            ];
        }
    }

    public function validateNewsletterEmail($email)
    {
        $sql = "SELECT * FROM `newsletter` WHERE `newsletter`.`email` = '".$email."';";
        $result = $this->_conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['status'] == '0') {
                return['exist'=> true, 'enabled'=> false];
            }else{
                return['exist'=> true, 'enabled'=> true];
            }
        } else {
            return['exist'=> false, 'enabled'=> false];
        }
    }

    public function submitNewsletter($data)
    {
        $validity = $this->validateNewsletterEmail($data['email']);
        if (($validity['exist']) && ($validity['enabled'])) {
            return [
                "success"=> false,
                "message"=> "Email has been already subscribed"
            ];
        }elseif (($validity['exist']) && (!$validity['enabled'])) {
            return $this->updateNewsletterSubscription($data);
        }else{
            $save = $this->insertData('newsletter', $data);
            if ($save['success']) {
                $from = CONFIG['SMTP_SENDER'];
                $subject = "Newsletter Subscription";
                $body = $this->getEmailTemplate($this::NEWSLETTER_TEMPLATE,$data);
                $mail = $this->sendMail($from, $data['email'], $subject, $body);
                return [
                    "success"=> true,
                    "message"=> "Thank you for your subscription"
                ];
            } else {
                return [
                    "success" => false,
                    "message" => $save['message']
                ];
            }
        }
    }

    public function validateCareear($data)
    {
        if (empty($data['career_service']) || 
            empty($data['career_name']) || 
            empty($data['career_email']) || 
            empty($data['career_phone']) || 
            empty($data['career_location']) || 
            empty($data['career_experience']) || 
            empty($_FILES['career_resume']) || 
            empty($data['career_message'])) {
            return false;
        }
        
        return true;
    }

    public function applyForJob($data)
    {
        if ($this->validateCareear($data)) {   
            $target_dir = 'uploads/resume/';
            $file = $this->fileUpload('career_resume', $target_dir);
            if ($file['success']) {
                $data['career_resume'] = $file['file'];    
                $save = $this->insertData('career', $data);
                if ($save['success']) {
                    $from = CONFIG['SMTP_SENDER'];
                    $to = CONFIG['SMTP_RECIVER'];
                    $subject = "Careear Request";
                    $body = $this->getEmailTemplate($this::CAREEAR_TEMPLATE,$data);
                    $target_file = $target_dir . $file['file'];
                    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    $mail = $this->sendMail($from, $to, $subject, $body, $target_file, $fileType);
                    if ($mail['success']) {
                        return [
                            "success"=> true,
                            "message"=> "Your request recived successfully"
                        ];
                    }else{
                        return [
                            "success" => false,
                            "message" => $mail['message']
                        ];
                    }
                }else{
                    return [
                        "success" => false,
                        "message" => $save['message']
                    ];
                }
            }else {
                return [
                    "success" => false,
                    "message" => $file['message']
                ];
            }
        }
        
    }

    public function fileUpload($fileName, $target_dir)
    {
        $target_file = $target_dir . basename($_FILES[$fileName]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $file = basename($_FILES[$fileName]["name"]);
        $message = "File uploaded successfully...";
        // Check if file already exists
        if (file_exists($target_file)) {
            // Rename file
            $file = time(). basename($_FILES[$fileName]["name"]);
            $target_file = $target_dir . $file;
        }

        // Check file size
        // if ($_FILES[$fileName]["size"] > 500000) {
        //     $message = "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
            $message = "Sorry, only pdf, doc & docx files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return [
                "success" => false,
                "message" => $message
            ];
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file)) {
                return [
                    "success" => true,
                    "message" => $message,
                    "file" => htmlspecialchars($file)
                ];
            } else {
                return [
                    "success" => false,
                    "message" => $message
                ];
            }
        }
    }

}
