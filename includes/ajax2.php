   <?php
    include('config.php');
    
        $statement = $conn->prepare("
          INSERT INTO assignments (subject_id,student_id,name,mark,remark) 
          VALUES (:i_subject_id,:i_student_id,:i_name,:i_mark,:remark)
        ");
        $result = $statement->execute(
          array(
            ':i_subject_id'  =>  $_POST["subject_id"],
            ':i_student_id'  =>  $_POST["student_id"],
            ':i_name'  =>  $_POST["name"],
            ':i_mark'  =>  $_POST["mark"],
            ':i_remark'  =>  $_POST["remark"]
          )
        );
        if(!empty($result))
        {
          echo 'User Added Successfully';
    }
    