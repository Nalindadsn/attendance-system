   <?php
    include('config.php');
    
        $statement = $conn->prepare("
          INSERT INTO payments (invoice_no,student_id,reson,amount) 
          VALUES (:i_full_name,:i_student_id,:i_reson,:i_amount)
        ");
        $result = $statement->execute(
          array(
            ':i_full_name'  =>  $_POST["name"],
            ':i_student_id'  =>  $_POST["student_id"],
            ':i_reson'  =>  $_POST["reson"],
            ':i_amount'  =>  $_POST["amount"]
          )
        );
        if(!empty($result))
        {
          echo 'User Added Successfully';
    }
    