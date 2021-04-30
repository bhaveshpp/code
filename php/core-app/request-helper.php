<?php
require('conn.php');
class Request
{

    protected $_conn;

    public function __construct()
    {
        $this->_conn = conn();
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

    public function validateGetInTouch($data)
    {
        $flag = true;
        if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['subject']) || empty($data['service']) || empty($data['message'])) {
            $flag = false;
        }
        
        return $flag;
    }

    public function submitGetInTouch($data)
    {
        if ($this->validateGetInTouch($data)) {
            return $this->insertData('get_in_touch', $data);
        }else{
            return [
                "success" => false,
                "message" => "Data missing"
            ];
        }
    }

    public function submitNewsletter($data)
    {
        return $this->insertData('newsletter', $data);
    }

    public function applyForJob($data)
    {
        $file = $this->fileUpload('resume','uploads/resume/');
        $data['resume'] = $file;       
        return $this->insertData('job_request', $data);
    }

    public function fileUpload($fileName, $target_dir)
    {
        $target_file = $target_dir . basename($_FILES[$fileName]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $file = basename($_FILES[$fileName]["name"]);
        // Check if file already exists
        if (file_exists($target_file)) {
            // Rename file
            $file = time(). basename($_FILES[$fileName]["name"]);
            $target_file = $target_dir . $file;
        }

        // Check file size
        // if ($_FILES[$fileName]["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file)) {
                return htmlspecialchars($file);
            } else {
                return [
                    "success" => false,
                    "message" => "Sorry, there was an error uploading your file."
                ];
            }
        }
    }

}
