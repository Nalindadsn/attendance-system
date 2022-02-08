   <?php
    include('config.php');
    
        $statement = $conn->prepare("
          INSERT INTO sas_user (first_name,last_name,email,password,gender,mobile,role,status) 
          VALUES (:i_first_name,:i_last_name,:i_email,:i_password,:i_gender,:i_mobile,:i_role,:i_status)
        ");
        $result = $statement->execute(
          array(
            ':i_first_name'  =>  $_POST["firstName"],
            ':i_last_name'  =>  $_POST["lastName"],
            ':i_email'  =>  $_POST["email"],
            ':i_password'  =>  md5($_POST["newPassword"]),
            ':i_gender'  =>  $_POST["gender"],
            ':i_mobile'  =>  $_POST["mobile"],
            ':i_role'  =>  $_POST["role"],
            ':i_status'  =>  $_POST["status"]
          )
        );
        if(!empty($result))
        {
          echo 'User Added Successfully';
    }
    