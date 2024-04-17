<?php
require_once 'header.php';
require_once 'mainnav.php'; 
require_once 'DBConnection.php'; 

$updatedata = new DB_con(); 

$path = ''; // Define $path variable with initial empty value

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) { 
        //$id = $_POST['id']; // Get the ID of the item being upgraded

        // Check if the "Upgrade" button was pressed
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'submit') !== false) {
                $id = str_replace('submit', '', $key);
                if ($id) {
                    // Upgrade button for this ID was pressed
                    $username = $_SESSION['username']; 
                    $type = "Dongle FW Upgrade";

                    // Check if file was uploaded successfully
                    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                        // Handle file upload if needed, but for this case, it's not required
                        $target_dir = "C:/xampp1/htdocs/"; // Make sure this path is correct
                        $path = $target_dir . basename($_FILES["file"]["name"]);

                        // Update the database with the new path
                        $sql = $updatedata->dongupgrade($path, $id);
                    }
                    
                    // Update other values if needed
                    
                        if (isset($_POST['user' . $id])) {
                            $value = $_POST['user' . $id];
                            
                        } else {
                            $value = '';
                        }
                        $sql = $updatedata->dongleupgrade($type, $username, $value, $path);
                    
                }
            }
        }
    }
}
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
    <div style="border:1px solid black;padding:2px;height:750px;margin-top:-1px;width:1820px;margin-left:70px">
        <br>
        <form action="" method="post" enctype="multipart/form-data" name="form">
            <label style="margin-left:35px;"> Path:<label style="background-color:lightblue;width:650px;"></label>
            <input type="file" name="file" id="file" style="width:108px;height:45px;">
            <br>
            <table id="table" cellpadding="2" cellspacing="0" border="3" style="line-height:2;margin-left:45px;">
                <tr align="center" style="background-color:lightsteelblue">
                    <th class="lbl" style="width:65px"><?php echo $lang['A6']; ?></th>
                    <th class="lbl" style="width:350px"><?php echo $lang['G2']; ?></th>
                    <th class="lbl" style="width:160px"><?php echo $lang['G6']; ?></th>
                    <th class="lbl" style="width:118px"><?php echo $lang['U7']; ?></th>
                </tr>
                <?php
                $kvmdata = new DB_con(); 