<?php require_once "header.php"; require_once 'kvmnav.php'; ?>
<?php
$updatedata = new DB_con();

if (isset($_POST['submit'])) { 
    $userid = $_POST['id'];
    
    for ($u = 1; $u <= 1; $u++) {
        if (isset($_POST['user' . $u])) {
            $value = $_POST['user' . $u];
        } else {
            $value = '';
        }
    }

    // AES Encryption
    $aes_cipher = "aes-256-cbc"; 
    $aes_encryption_key = openssl_random_pseudo_bytes(32); 
    $aes_iv_size = openssl_cipher_iv_length($aes_cipher); 
    $aes_iv = openssl_random_pseudo_bytes($aes_iv_size); 
    $aes_encrypted_data = openssl_encrypt($value, $aes_cipher, $aes_encryption_key, 0, $aes_iv);

    // Triple DES Encryption
    function tripleDesEncrypt($data, $key) {
        $encrypted = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }

    $triple_des_key = "0917#549&10%$$#$#";
    $triple_des_encrypted = tripleDesEncrypt($value, $triple_des_key);

    // DES Encryption
    function desEncrypt($data, $key) {
        $encrypted = openssl_encrypt($data, 'DES-ECB', $key, OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }

    $des_key = "3$@602#9";
    $des_encrypted = desEncrypt($value, $des_key);

    // Perform database update
    $sql = $updatedata->username($value, $userid, $aes_encrypted_data, $triple_des_encrypted, $des_encrypted); 
}

?>
<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=UTF-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div style="border:1px solid black;padding:2px;height:790px;margin-top:-1px;width:1820px;margin-left:70px">
        <br>
        <table id=table cellpadding=2 cellspacing=0 border=3
            style=line-height:2;margin-left:45px;width:30%;line-height:1>
            <tr align=center style=background-color:lightsteelblue>
                <th class=lbl style=width:70px><?php echo $lang['A6']; ?></th>
                <th class=lbl style=width:450px><?php echo $lang['H8']; ?></th>
                <th class=lbl style=width:100px><?php echo $lang['B11']; ?></th>
            </tr>
            <?php
            require_once "DBConnection.php";
            $kvmdata=new DB_con();
            $sql=$kvmdata->userdata();