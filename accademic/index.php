<?php
session_start();
require_once('../php/db.php');
if(isset($_SESSION['accademic_supervisor'])){
    $user = $_SESSION['accademic_supervisor'];
    
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
    <title>MAK-Intern</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-toggleable-sm bg-success">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-nav"><span class="navbar-toggler-icon"></span></button>
        <div class="container">
            
          <a href="index.php" class="navbar-brand">MAK-Intern</a>
            <div class="collapse navbar-collapse" id="navbar-nav">
              <ul class="navbar-nav mr-auto">
  
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
           $sql = 'SELECT * FROM student WHERE supervisor_id = :supervisor_id';
           $stmt = $db->prepare($sql);
           $stmt->bindValue(':supervisor_id', $user['id']);
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
                 
             </thead>
             <?php foreach($results as $result){ ?>
                <tr>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['student_number']; ?></td>
                    <td><?php echo $result['reg_number']; ?></td>
                    
                </tr>
             <?php } ?>
        </table>
        <?php } ?>

    </div>
    

<script src="../js/jquery.js"></script>
<script src="../js/tether.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>