   <?php
    include('config.php');
    
        $statement = $conn->prepare("
          INSERT INTO batch (name,year,type) 
          VALUES (:i_name,:i_year,:i_type)
        ");
        $result = $statement->execute(
          array(
            ':i_name'  =>  $_POST["name"],
            ':i_year'  =>  $_POST["year"],
            ':i_type'  =>  $_POST["type"]
          )
        );
        if(!empty($result))
        {
          echo 'User Added Successfully';
    }
    