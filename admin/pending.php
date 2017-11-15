<?php

session_start();
require_once('../php/db.php');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM field_supervisor WHERE status = :status';
$stmt = $db->prepare($sql);
$stmt->bindValue(':status', 'pending');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <h3>Pending Field Supervisors' Registration Requests</h3>
        
        <table class="table text-capitalize text-justify table-striped table-bordered" >
            <thead>
                <th>Profile Image</th>
                <th>Name</th>
                <th>Id Number</th>
                <th>Organization</th>
                <th>Position</th>
                <th>Email</th>
                <th></th>
            </thead>
           <?php foreach($result as $value){ ?>
            <tr>
                <td clas="table-img" width="300px">
                    <img src="<?php echo $value['profileImage']; ?>" alt="profile photo" class="img-fluid ">
                </td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['idNumber'] ?></td>
                <td><?php echo $value['organizationName'] ?></td>
                <td><?php echo $value['position'] ?></td>
                <td><?php echo $value['email'] ?></td>
                <td>
                    <form action="../php/objects.php" method="post">
                       <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                       <input type="submit" value="Approve" class="btn btn-success" name="approve">
                    </form><br>

                    <form action="../php/objects.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                    <input type="submit" value="Reject" class="btn btn-danger" name="reject">
                    </form>
                </td>
            </tr>
           <?php } ?>
        </table>

    </div>
    </div>
</body>
</html>