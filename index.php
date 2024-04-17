<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
require_once 'en.php';
require_once 'DBConnection.php';
$updatedata=new DB_con(); 
session_start();
$error="";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = $updatedata->logindata($username, $password);

    if (!$sql) {
        $error = "Invalid username or password";
    }
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
    .f1 {
        margin-top: 250px;
        margin-left: 700px;
        width: 400px;
        border: 2px solid #ccc;
        padding: 40px;
        background-color: lightblue;
        border-radius: 17px
    }

    h2 {
        text-align: center;
        margin-bottom: 40px;
        font-family: initial;
        color: aliceblue;
        align-content: left;
        height: 32px
    }
    </style>
</head>

<body>
      <div style="text-align: center; font-size:16px; color:#cc0000; margin-top:10px">
        <?php echo $error; ?>
    </div>
    <form class="f1" action method="POST">
       <h2 style=color:black;>Login with Username and Password</h2>
   
        <div class=form-group style="margin-left: 30px;height: 32px;"> 

        <label for=username class=text-info><?php echo $lang['H8']; ?>:</label><input type=text name=username class=form-control required style="width: 187px;height: 20px;"> </div>
<br>
        <div class=form-group style="margin-left: 30px;height: 32px;">
         <label for=password class=text-info>Password:</label><input type=password name=password class=form-control required style="width: 187px;height: 20px;"> </div> <br>
        <div class=form-group> <input type=submit name=submit class="btn btn-info btn-md" value=Login style="margin-left: 240px;"> </div>
    </form>
</body>

</html>