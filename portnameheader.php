<?php require_once "header.php";
require_once 'portnav.php';
 $updatedata=new DB_con(); 
if (isset($_POST['submit'])) { 
    $id =$_POST['id'];
    for ($u=1 ; $u<=1; $u++) {
        if (isset($_POST['user' . $u])) {
            $value =$_POST['user' . $u];
        } else {
            $value= '';
        }
       
    }
     // AES Encryption
  // AES Encryption
$aes_cipher = "aes-256-cbc"; 
$aes_encryption_key = openssl_random_pseudo_bytes(32); 
$aes_iv_size = openssl_cipher_iv_length($aes_cipher); 
$aes_iv = openssl_random_pseudo_bytes($aes_iv_size); 
$aes_encrypted_data = openssl_encrypt($value, $aes_cipher, $aes_encryption_key, 0, $aes_iv);
$aes_encrypted_data . "\n"; // Echo the encrypted data

// Triple DES Encryption
function tripleDesEncrypt($data) {
    // Generate a random key for Triple DES encryption
    $triple_des_encryption_key = openssl_random_pseudo_bytes(24); // 3DES key size is 24 bytes
    // Encrypt the data using DES-EDE3
    $encrypted = openssl_encrypt($data, 'DES-EDE3', $triple_des_encryption_key, OPENSSL_RAW_DATA);
    // Return base64 encoded encrypted data and the key
    return array(base64_encode($encrypted), base64_encode($triple_des_encryption_key));
}

$triple_des_encrypted = tripleDesEncrypt($value);
$triple_des_encrypt =$triple_des_encrypted[0] . "\n"; // Echo the encrypted data
$triple_des_encrypted[1] . "\n"; // Echo the encryption key

// DES Encryption
function desEncrypt($data) {
    // Generate a random key for DES encryption
    $des_encryption_key = openssl_random_pseudo_bytes(8); // DES key size is 8 bytes
    // Encrypt the data using DES-ECB
    $encrypted = openssl_encrypt($data, 'DES-ECB', $des_encryption_key, OPENSSL_RAW_DATA);
    // Return base64 encoded encrypted data and the key
    return array(base64_encode($encrypted), base64_encode($des_encryption_key));
}
$des_encrypt = desEncrypt($value);
$des_encrypted = $des_encrypt[0];
// Perform database update
$sql = $updatedata->portname($value, $id, $aes_encrypted_data, $triple_des_encrypt, $des_encrypted);

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
<div style="border:1px solid black;padding:2px;height:750px;margin-top:-1px;width:1820px;margin-left:70px">
    <br>
    <table id=table cellpadding=2 cellspacing=0 border=3 style=line-height:3;margin-left:45px;width:35%>
        <tr align=center style=background-color:lightsteelblue;padding:7px>
            <th class=lbl style=width:50px><?php echo $lang['A6']; ?></th>
            <th class=lbl><?php echo $lang['G2']; ?></th>
            <th class=lbl style=width:75px><?php echo $lang['B11']; ?></th>
        </tr>
        <?php  
        require_once "DBConnection.php";
        $kvmdata=new DB_con();