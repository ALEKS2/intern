<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/field.css">
    <title>MAK-Intern</title>
</head>
<body>
    <div class="container bg-success text-white">
        <fieldset>
            <legend class="text-center display-5">Field Supervisor Registration</legend>
        <form action="php/objects.php" method="post" enctype="multipart/form-data"">
            <div class="form-group">
                <label for="">Organization Name <span class="text-danger h4">*</span></label>
                <input type="text" class="form-control" placeholder="eg kalumbasoft limited" name="organization" required>
            </div>
            <div class="form-group">
                <label for="">Your Name<span class="text-danger h4">*</span></label>
                <input type="text" class="form-control" placeholder="eg John Doe" name="name" required>
            </div>
            <div class="form-group">
                <label for="">Your Email<span class="text-danger h4">*</span></label>
                <input type="text" class="form-control" placeholder="eg JohnDoe@gmail.com" name="email" required>
            </div>
            <div class="form-group">
                <label for="">Your Id Number<span class="text-danger h4">*</span></label>
                <input type="text" class="form-control" placeholder="eg J256" name="id_number" required>
            </div>
            <div class="form-group">
                <label for="">Position In Organization<span class="text-danger h4">*</span></label>
                <input type="text" class="form-control" placeholder="eg Managing director" name="position" required>
            </div>
            <div class="form-group">
                <label for="">Organization Website<span class="text-danger h4">*</span></label>
                <input type="text" class="form-control" placeholder="eg www.organization.com" name="org_website" required>
            </div>
            <div class="form-group">
                <label for="">Your profile photo<span class="text-danger h4">*</span></label>
                <input type="file" class="form-control" name="profile_image" required>
            </div>
           <div class="text-center">
           <input type="submit" value="Register" name="field_supervisor_reg" class="btn btn-primary">
            <input type="reset" value="clear" name="" class="btn btn-danger">
           </div>
        </form>
        </fieldset>
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/tether.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>