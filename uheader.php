<?php 
require_once 'header.php'; 

if (isset($_POST["save"])) { 
    $user_id=$_SESSION['id'];
    $username = $_SESSION['username'];
    $portname = $_POST['portname'];
    $decoder_name = $_POST['decoder_name'];
    $id = $_POST['id']; 
    $updatedata=new DB_con(); 
    $sql=$updatedata->connect($user_id, $portname, $decoder_name, $id, $username); 

    // Redirect to index.html after form submission
    echo "<script>window.location.href = 'index.html';</script>";
}
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=UTF-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
    
 <style>
        
        #remoteVideos {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
        }
        #videoCanvas {
            display: block;
            margin: 0 auto;
            width: 100%;
            height: 100%;
        }
        #closeButton {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
        <script type="text/javascript" src="/public/jsmpeg.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <table id=table cellpadding=2 cellspacing=0 border=3
        style=line-height:3;width:70%;margin-left:89px;margin-top:-800px>
        <tr style=height:40px;background-color:lightsteelblue>
            <th style=text-align:center;width:65px><?php echo $lang['A6']; ?></th>
            <th style=text-align:center;width:70px><?php echo $lang['G1']; ?></th>
            <th style=text-align:center><?php echo $lang['G2']; ?></th>
            <th style=text-align:center;width:128px><?php echo $lang['G3']; ?></th>
            <th style=text-align:center;width:135px><?php echo $lang['G4']; ?></th>
            <th style=text-align:center;width:130px><?php echo $lang['G5']; ?></th>
        </tr>
        <?php require_once 'DBConnection.php';
        $kvmdata=new DB_con(); 