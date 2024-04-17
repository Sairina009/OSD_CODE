<?php 
require_once 'header.php';
require_once 'usernav.php'; 
require_once 'DBConnection.php'; 
$updatedata=new DB_con(); 
 
if (isset($_POST['update'])) { 
    $name = $_POST['name']; 
    $sql=$updatedata->kvmupdate($name); 
} 
include_once 'cachestart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
</head>

<body>
    <div
        style="border: 1px solid midnightblue;padding: 2px;height: 775px;margin-top: -1px;width: 1820px;margin-left: 70px;">
        <form name="form1" method="post" action="">
            <br>
            <label8 style="margin-left: 35px;font-size: x-large;font-family: inherit;"><b><?php echo $lang['B1']; ?></b> </label8>
            <?php require_once 'DBConnection.php'; $kvmdata=new DB_con(); $sql=$kvmdata->kvmdata(); $row=mysqli_fetch_array($sql); ?>
            <input type="text" name="name" value="<?php echo htmlentities($row['kvmname']); ?>">
            <input type="submit" name="update" value="<?php echo $lang['B11']; ?>"
                style="margin-left:10px;width: auto;padding: 1px;height: 35px;">
        </form>
</body>

</html>
<?php

include_once 'cacheend.php';
?>