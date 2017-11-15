<?php
session_start();
if(isset($_SESSION['admin'])){
   $admin = $_SESSION['admin'];
   $supervisors = $_SESSION['accademic_supervisor'];
   $students = $_SESSION['students'];
}else{
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>MAK-Intern Admin</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-toggleable-sm bg-success">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-nav"><span class="navbar-toggler-icon"></span></button>
        <div class="container">
            
          <a href="index.php" class="navbar-brand">MAK-Intern</a>
            <div class="collapse navbar-collapse" id="navbar-nav">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a href="index.php" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link" data-toggle="modal" data-target="#supervisor-modal">Add Supervisor</a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link" data-toggle="modal" data-target="#student-modal">Add Student</a>
                  </li>
                  <li class="nav-item">  
                      <a href="pending.php" class="nav-link">Field Supervisor Requests</a>
                  </li>
              </ul>
              <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                 <a href="../logout.php" class="nav-link">Logout</a>
                </li>
              </ul>
            </div>
          </div>
    </nav>

    <div class="container">
        <div class="text-center allocation-report">
            <h3 class="display-4">Intern Supervisor Allocations</h3>
            <table class="table text-capitalize text-justify table-striped table-bordered table-hover">
              <thead>
                <th>Student Name</th>
                <th>Student Number</th>
                <th>Registration Number</th>
                <th>Allocated Supervisor</th>
              </thead>
              <?php foreach($students as $student){ ?>
              <tr>
                <td><?php echo $student['name'] ?></td>
                <td><?php echo $student['student_number'] ?></td>
                <td><?php echo $student['reg_number'] ?></td>
                <?php foreach($supervisors as $supervisor){
                  if($supervisor['id'] == $student['supervisor_id']){
                    echo '<td>'.$supervisor['firstName'].' '.$supervisor['lastName'].'</td>';
                  }
                }
                  ?>
                
              </tr>
              <?php } ?>
            </table>
        </div>
        
        <!-- student modal -->
        <div class="modal" id="student-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mymodallable">Enter Student Details</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <form action="../php/objects.php" method="post">
             <div class="form-group">
              <label>Student Name</label>
               <input type="text" class="form-control" name="name">
             </div>
              <div class="form-group">
              <label>Student Number</label>
               <input type="text" class="form-control" name="Student_number">
             </div>
             <div class="form-group">
              <label>Registration Number</label>
               <input type="text" class="form-control" name="registration_number">
             </div>
             <div class="form-group">
              <label>Supervisor</label>
               <select name="supervisor" id="" class="form-control">
                   <?php foreach($supervisors as $supervisor){ ?>
                      <option value="<?php echo $supervisor['id']; ?>"><?php echo $supervisor['firstName']." ".$supervisor['lastName'] ?></option>
                   <?php } ?>
               </select>
             </div>
             <button class="btn btn-success" type="submit" name="submit_student">Submit</button>
             </form>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- modal end -->

    <!-- supervisor modal -->
    <div class="modal" id="supervisor-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mymdallable">Enter Supervisor Details</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <form action="../php/objects.php" method="post">
             <div class="form-group">
              <label>Supervisor First Name</label>
               <input type="text" class="form-control" name="fname">
             </div>
             <div class="form-group">
              <label>Supervisor Last Name</label>
               <input type="text" class="form-control" name="lname">
             </div>
             <div class="form-group">
              <label>Supervisor ID Number</label>
               <input type="text" class="form-control" name="id_number">
             </div>
              <div class="form-group">
              <label>Supervisor email</label>
               <input type="text" class="form-control" name="supervisor_email">
             </div>
             <div class="form-group">
              <label>Supervisor username</label>
               <input type="text" class="form-control" name="supervisor_username">
             </div>
             
             <button class="btn btn-success" type="submit" name="submit_supervisor">Submit</button>
             </form>
</div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- modal end -->
    
        
    </div>

<script src="../js/jquery.js"></script>
<script src="../js/tether.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>