   <?php
    include('config.php');
    
        $statement = $conn->prepare("
          INSERT INTO sas_classes (name,teacher_id) 
          VALUES (:i_name,:i_teacher_id)
        ");
        $result = $statement->execute(
          array(
            ':i_name'  =>  $_POST["name"],
            ':i_teacher_id'  =>  $_POST["teacher_id"],
          )
        );
        if(!empty($result))
        {
          echo 'User Added Successfully';
    }
    