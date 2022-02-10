   <?php
    include('config.php');
    
        $statement = $conn->prepare("
          INSERT INTO sas_students (name, gender, dob, mobile, email, current_address, permanent_address,  academic_year, class, roll_no) 
          VALUES (:i_name, :i_gender, :i_dob, :i_mobile, :i_email, :i_current_address, :i_permanent_address, :i_academic_year, :i_class, :i_roll_no)
        ");
        $result = $statement->execute(
          array(

             ':i_name' => $_POST['name'],
             ':i_gender' => $_POST['gender'],
             ':i_dob' => $_POST['dob'],
             ':i_mobile' => $_POST['mobile'],
             ':i_email' => $_POST['email'],
             ':i_current_address' => $_POST['currentAddress'],
             ':i_permanent_address' => $_POST['permanentAddress'],
             ':i_academic_year' => $_POST['academicYear'],
             ':i_class' => $_POST['classid'],
             ':i_roll_no'=>$_POST['rollNo']


          )
        );
        if(!empty($result))
        {
          echo 'User Added Successfully';
    }
    