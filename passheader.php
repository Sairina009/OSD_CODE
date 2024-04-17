<?php require 'header.php'; 
 require 'kvmnav.php';
// Function for AES encryption
function aesEncrypt($data, $key, $iv) {
    return base64_encode(openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv));
}

// Function for Triple DES encryption
function tripleDesEncrypt($data, $key) {
    return base64_encode(openssl_encrypt($data, 'des-ede3', $key, OPENSSL_RAW_DATA));
}

// Function for DES encryption
function desEncrypt($data, $key) {
    return base64_encode(openssl_encrypt($data, 'des-ecb', $key, OPENSSL_RAW_DATA));
}
$updatedata=new DB_con();
if (isset($_POST['submit'])) { 
    $id = $_POST['id'];
    
    for ($u = 1; $u <= 1; $u++) {
        if (isset($_POST['user' . $u])) {
            $value = $_POST['user' . $u];
            $value1 = $_POST['user1' . $u];
            
            // Generate AES encryption key and IV
            $aes_key = openssl_random_pseudo_bytes(32);
            $aes_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            
            // AES encryption
            $aes_encrypted = aesEncrypt($value, $aes_key, $aes_iv);
            
            // Generate Triple DES key
            $triple_des_key = "0917#549&10%$$#$#";
            
            // Triple DES encryption
            $triple_des_encrypted = tripleDesEncrypt($value, $triple_des_key);
            
            // Generate DES key
            $des_key = "3$@602#9";
            
            // DES encryption
            $des_encrypted = desEncrypt($value, $des_key);
        } else {
            $value = '';
        }
        
        // Check if the values are the same
        if ($value == $value1) {
            // Perform database update
            $sql = $updatedata->passupdate($value, $aes_encrypted, $triple_des_encrypted, $des_encrypted, $id);
        } else {
            $error = "Not Same";
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
    <div style="border:1px solid black;padding: 2px;height: 790px;margin-top: -1px;width: 1820px;margin-left: 70px;">
        <br>
        <div class="error" style="color: red;">
            <?php if (isset($error)) {
                echo $error; 
            } 
            ?>
        </div>
        <table id="table" cellpadding="2" cellspacing="0" border="3" style="line-height: 2;margin-left: 45px;width:50%;">
            <tr align="center" style="background-color: lightsteelblue;">
                <th class="lbl" style="width:50px;"><?php echo $lang['A6']; ?></th>
                <th class="lbl"><?php echo $lang['H8']; ?></th>
                <th class="lbl"><?php echo $lang['F16']; ?></th>
                <th class="lbl"><?php echo $lang['F17']; ?></th>
                <th class="lbl"><?php echo $lang['F18']; ?></th>
                <th class="lbl"><?php echo $lang['B11']; ?></th>
            </tr>
            <?php  
            require_once "DBConnection.php";
            $kvmdata=new DB_con();
            $sql=$kvmdata->userdata();