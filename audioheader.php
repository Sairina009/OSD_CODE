<?php require_once 'header.php'; require_once 'portnav.php'; ?>
<?php
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
require_once($language . '.php');
require_once 'DBConnection.php'; 
$updatedata=new DB_con(); 
if (isset($_POST['submit'])) { 
      $id =$_POST['id'];
    for ($u=1 ; $u<=1; $u++) {
        if (isset($_POST['user' . $u])) {
            $value =$_POST['user' . $u];
            $value1 =$_POST['user1' . $u];
        } else {
            $value= '';
        }
        $sql=$updatedata->audioedit($value, $value1, $id);  
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
</head>

<body>
    <div style="border:1px solid black;padding:2px;height:750px;margin-top:-1px;width:1820px;margin-left:70px">
        <br>
        <table id=table cellpadding=2 cellspacing=0 border=3 style=line-height:3;margin-left:45px>
            <tr align=center style=background-color:lightsteelblue>
                <th class=lbl style=width:60px><?php echo $lang['A6']; ?></th>
                <th class=lbl style=width:250px><?php echo $lang['G2']; ?></th>
                <th class=lbl style=width:348px><?php echo $lang['O1']; ?></th>
                <th class=lbl style=width:240px><?php echo $lang['O2']; ?></th>
                <th class=lbl style=width:85px><?php echo $lang['B11']; ?></th>
            </tr>
            <?php 
            $kvmdata=new DB_con();