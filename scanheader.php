<?php include_once "header.php"; include_once 'portnav.php'; ?>
<?php
$updatedata=new DB_con();
if(isset($_POST['submit'])){ 
$id =$_POST['id'];
    for($u=1 ; $u<=8; $u++){
      if(isset($_POST['user' . $u])){
$value =$_POST['user' . $u];
      }
      else{
        $value= '';
      }
      $sql=$updatedata->scanupdate($value , $id , $u);
    }
    for($u=9 ; $u<=16; $u++){
      if(isset($_POST['user1' . $u])){
$value =$_POST['user1' . $u];
      }
      else{
        $value= '';
      }
      $sql=$updatedata->scanupdate($value , $id , $u); 
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
        <form action method=post>
            <table id=table cellpadding=2 cellspacing=0 border=3 style=margin-left:45px;margin-top:25px>
                <tr align=center style=background-color:lightsteelblue>
                    <th class=lbl style=width:60px><?php echo $lang['A6']; ?></th>
                    <th class=lbl style=width:400px><?php echo $lang['G2']; ?></th>
                  <th style=background-color:lightsteelblue;text-align:left>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U01&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U02&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U03&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U04&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U05&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U06&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U07&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U08
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U09&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U12&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U13&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U14&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U15&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U16
                    </th>
                    <th class=lbl style=width:75px><?php echo $lang['B11']; ?></th>
                </tr>
                <?php include_once('DBConnection.php');
                      $kvmdata=new DB_con(); 