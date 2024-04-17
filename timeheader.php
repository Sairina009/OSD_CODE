<?php  
require 'header.php'; 
require 'usernav.php'; 
require_once 'DBConnection.php';
 $updatedata=new DB_con(); 
if (isset($_POST['save'])) {
    $time = $_POST['time']; 
    $sql=$updatedata->time($time); 
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
</head>

<body>
    <form action="" method="POST">
        <?php require_once 'DBConnection.php'; 
          $kvmdata=new DB_con(); 
          $sql=$kvmdata->kvmdata(); 