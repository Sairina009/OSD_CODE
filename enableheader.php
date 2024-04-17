<?php  require_once "header.php"; require_once 'kvmnav.php'; ?>
<?php
require_once 'DBConnection.php'; 
$updatedata=new DB_con(); 
if (isset($_POST['submit'])) { 
    $id =$_POST['id'];
    for ($u=1 ; $u<=1; $u++) {
        if (isset($_POST['user' .$u])) {
            $value =$_POST['user' .$u];
        } else {
            $value= '';
        }
        $sql=$updatedata->enable($value, $id);   
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
    <div style="border:1px solid black;padding:2px;height:790px;margin-top:-1px;width:1820px;margin-left:70px">
        <br>
        <table id=table cellpadding=2 cellspacing=0 border=3 style=margin-left:45px;line-height:2;width:44%>
            <tr align=center style=background-color:lightsteelblue>
                <th class=lbl style=width:70px><?php echo $lang['A6']; ?></th>
                <th class=lbl style=width:450px><?php echo $lang['H8']; ?></th>
                <th class=lbl style=width:290px><?php echo $lang['F12']; ?></th>
                <th class=lbl style=width:100px><?php echo $lang['B11']; ?></th>
            </tr>
            <?php
            $kvmdata=new DB_con();
            $sql=$kvmdata->userdata();