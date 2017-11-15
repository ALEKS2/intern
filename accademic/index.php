<?php
session_start();

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
    <title>MAK-Intern</title>
</head>
<body>
    
</body>
</html>