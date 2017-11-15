<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAK-Intern</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css"> 
</head>

<body>
    <header class="v-header containar">
        <div class="full-screen-video-wrap">
            <video src="makwire.mp4" autoplay="true" loop="true"></video>
        </div>
        <div class="header-overlay"></div>
        <div class="header-content">
            <img src="img/mak.jpg" alt="mak badge">
            <h1 class="display-4">Makerere university internship system</h1><br>
           
            <button class="btn btn-lg" data-toggle="modal" data-target="#login-modal">Login</button><br><br>
            <hr><br>
            <span class="alert-danger">Have no account</span>
            <a href="registe_field_supervisor.php" class="btn">Register</a>

        </div> 
       
            
    </header>
    <div class="modal" id="login-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                              Supevisor Login
                            </h5>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Login as</label><br>
                                  <input type="radio"  name="supervisor" id="field" placeholder=""> Field supervisor
                                   <input type="radio"  name="supervisor" id="college">Accademic supervisor
                                   <input type="radio"  name="supervisor" id="admin">Admin
                                </div>
                            </form>
                            <form action="php/objects.php" id="" class="d-none admin-form" method="post">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                                </div>
                                <input type="submit" value="Login" class="btn btn-success" name="admin_login">
                            </form>
                            <form action="php/objects.php" id="" class="d-none field-supervisor-form" method="post">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                                </div>
                                <input type="submit" value="Login" class="btn btn-success" name="field_supervisor_login">
                            </form>
                            <form action="php/objects.php" id="college-supervisor-form" class="d-none" method="post">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                                </div>
                                <input type="submit" value="Login" class="btn btn-success" name="college_supervisor_login">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            
    


    <script src="js/jquery.js"></script>
    <script src="js/tether.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
       
        
        
        $(function(){
         $('#field').click(function(){
             $('.field-supervisor-form').removeClass('d-none');
             $('#college-supervisor-form').addClass('d-none');
             $('.admin-form').addClass('d-none');
         });
         $('#college').click(function(){
            $('#college-supervisor-form').removeClass('d-none');
             $('.field-supervisor-form').addClass('d-none');
             $('.admin-form').addClass('d-none');
         });
         $('#admin').click(function(){
             $('.admin-form').removeClass('d-none');
             $('.field-supervisor-form').addClass('d-none');
             $('#college-supervisor-form').addClass('d-none');
         });
        });
    </script>
</body>

</html>