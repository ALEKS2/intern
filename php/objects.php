<?php
try{
    session_start();
    require_once('db.php');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    require_once('classes.php');
    
    

    if(isset($_POST['college_supervisor_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = new AccademicLogin($username, $password);
        $user_login = $login->userLogin($db);
        if($user_login != "failed"){
           $_SESSION['accademic_supervisor'] = $user_login;
           
           header('Location: ../accademic/index.php');
        }else{
            header('Location: ../index.php?error=invalid username or password');
        }
    }

    if(isset($_POST['field_supervisor_login'])){
        $password = $_POST['password'];
        $login = new FieldLogin($password);
        $user_login = $login->userLogin($db);
        if($user_login != "failed"){
            $_SESSION['field_supervisor'] = $user_login;
            header('Location: ../field/index.php');
        }else{
            header('Location: ../index.php?error=invalid password');
        }
    }

    if(isset($_POST['admin_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login = new AdminLogin($username, $password);
        $user_login = $login->userLogin($db);
        if($user_login != "failed"){
            $_SESSION['students'] = getStudents($db);
            $_SESSION['accademic_supervisor'] = getAccademicSupervisor($db);
            $_SESSION['admin'] = $user_login;
            header('Location: ../admin/index.php');
        }else{
            header('Location: ../index.php?error=invalid password');
        }
    }

    if(isset($_POST['field_supervisor_reg'])){
        $organization = $_POST['organization'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id_number = $_POST['id_number'];
        $position = $_POST['position'];
        $org_website = $_POST['org_website'];
        $status = 'pending';
        $profile_place_holder = '../img/uploads/placeholder.png';
        $password = uniqid('');

       if(isset($_FILES['profile_image'])){
        $image = $_FILES['profile_image'];
        $image_name = $image['name'];
        $image_tmpname = $image['tmp_name'];
        $image_type = $image['type'];
        $image_error = $image['error'];
        $image_size = $image['size'];
        

        $extension = explode('.', $image_name);
        $ext = strTolower(end($extension));
        $allowed = array('jpg', 'jpeg', 'png');
        if(in_array($ext, $allowed)){
           if($image_error === 0){
               if($image_size <= 10000000){
                    $new_image_name = uniqid('', true).'.'.$ext;
                    $image_destination = '../img/uploads/'.$new_image_name;
               }else{
                header('Location: ../registe_field_supervisor.php?error=profile photo too large');
               }
                
           }else{
            header('Location: ../registe_field_supervisor.php?error=Error occured while uploading profile photo');
           }
        }else{
            header('Location: ../registe_field_supervisor.php?error=invalid profile photo');
        }
       }else{
           $image_destination = "none";
       }
        $field_supervisor = new FieldSupervisor($name, $email, $id_number, $position, $organization, $org_website, $password, $status, $image_tmpname, $image_destination);
        $insert = $field_supervisor->insertFieldSupervisor($db, $profile_place_holder);
        if($insert == 'success'){
            header('Location: ../index.php?message=request successful');
        }else{
            header('Location: ../registe_field_supervisor.php?error=registeration failed');
        }
    }

    if(isset($_POST['submit_supervisor'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $id_number = $_POST['id_number'];
        $email = $_POST['supervisor_email'];
        $username = $_POST['supervisor_username'];
        $password = uniqid('');
        $accademic_supervisor = new AccademicSupervisor($fname, $lname, $email, $id_number, $username, $password);
        $insert = $accademic_supervisor->insertAccademicSupervisor($db);
        if($insert == 1){
            $_SESSION['students'] = getStudents($db);
            $_SESSION['accademic_supervisor'] = getAccademicSupervisor($db);
            header('Location: ../admin/index.php?message=supervisor added successifully');
        }else{
            header('Location: ../admin/index.php?error=add supervisor failed');
        }
    }

    if(isset($_POST['submit_student'])){
        $name = $_POST['name'];
        $student_number = $_POST['Student_number'];
        $reg_number = $_POST['registration_number'];
        $supervisor_id = $_POST['supervisor'];
        
        $student = new Student($name, $reg_number, $student_number, $supervisor_id);
        $insert = $student->insertStudent($db);
        if($insert == 1){
            $_SESSION['students'] = getStudents($db);
            $_SESSION['accademic_supervisor'] = getAccademicSupervisor($db);
            header('Location: ../admin/index.php?message=Student added successifully');
        }else{
            header('Location: ../admin/index.php?error=add student failed');
        }
    }

    if(isset($_POST['approve'])){
        $id = $_POST['id'];
        $approve = approve($id, $db);
        if($approve == 1){
            header('Location: ../admin/pending.php?message=approval sucessful');
        }else{
            header('Location: ../admin/pending.php?error=approval failed');
        }
    }
    if(isset($_POST['reject'])){
        $id = $_POST['id'];
        $reject = reject($id, $db);
        if($reject == 1){
            header('Location: ../admin/pending.php?message=rejection sucessful');
        }else{
            header('Location: ../admin/pending.php?error=rejection failed');
        }
    }

    if(isset($_POST['submit_student_to_supervise'])){
        $student_number = $_POST['Student_number'];
        echo $student_number;
    }

}catch(Exception $e){
    $error = $e->getMessage();
}


?>