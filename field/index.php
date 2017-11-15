<?php
session_start();
require_once('../php/db.php');
if(isset($_SESSION['field_supervisor'])){
    $user = $_SESSION['field_supervisor'];
}else{
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>MAK-Intern Field-Supervisor</title>
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
                      <a href="#" class="nav-link" data-toggle="modal" data-target="#student-modal">Add Student</a>
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
        <h1 class="text-center display-4">Students You Are Supervising</h1>
        <?php 
           $sql = 'SELECT * FROM student WHERE field_supervisor_id = :field_supervisor_id';
           $stmt = $db->prepare($sql);
           $stmt->bindValue(':field_supervisor_id', $user['id']);
           $stmt->execute();
           $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $rows = $stmt->rowCount();
           
        ?>
        <?php if($rows < 1){ ?>
            <div class="alert alert-danger">You are currently not Supervising any Student</div>
        <?php }else{ ?>
        <table class="table text-capitalize text-justify table-striped table-bordered table-hover">
             <thead>
                 <th>STUDENT NAME</th>
                 <th>STUDENT NUMBER</th>
                 <th>REGISTRATION NUMBER</th>
                 <th></th>
             </thead>
             <?php foreach($results as $result){ ?>
                <tr>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['student_number']; ?></td>
                    <td><?php echo $result['reg_number']; ?></td>
                    <td>
                        <?php if($result['assessment'] == 0){ ?>
                            <a href="assess.php?id=<?php echo $result['id'] ?>" class="btn btn-success">Asses Student</a>
                        <?php }else{ ?>
                            <a href="viewassessment.php?id=<?php echo $result['id'] ?>" class="btn btn-primary">View Assessment</a>
                        <?php } ?>
                    </td>
                </tr>
             <?php } ?>
        </table>
        <?php } ?>


         <!-- student modal -->
         <div class="modal" id="student-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mymodallable">Enter required information for the student you are going to supervise</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <form action="../php/objects.php" method="post">
             
              <div class="form-group">
              <label>Student Number</label>
               <input type="text" class="form-control" name="Student_number">
             </div>
             <input type="hidden" name="supervisor_id" value="<?php echo $user['id']; ?>">
             
             <button class="btn btn-success" type="submit" name="submit_student_to_supervise">Submit</button>
             </form>
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