<?php 
include_once 'cachestart.php';

require 'portnameheader.php'; 

function aesDecrypt($data, $key, $iv) {
    return openssl_decrypt(base64_decode($data), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}


function tripleDesDecrypt($data, $key) {
    return openssl_decrypt(base64_decode($data), 'des-ede3', $key, OPENSSL_RAW_DATA);
}

function desDecrypt($data, $key) {
    return openssl_decrypt(base64_decode($data), 'des-ecb', $key, OPENSSL_RAW_DATA);
}

$aes_cipher = "aes-256-cbc"; 
$aes_encryption_key = openssl_random_pseudo_bytes(32); 
$aes_iv_size = openssl_cipher_iv_length($aes_cipher); 
$aes_iv = openssl_random_pseudo_bytes($aes_iv_size); 


//echo $des_encryption_key = openssl_random_pseudo_bytes(8); // DES key size is 8 bytes
    // Encrypt the data using DES-ECB
    
$triple_des_key = "0917#549&10%$$#$#";
$des_key = "3$@602#9";

    $sql=$kvmdata->port();   
     $i = 0;
     
while ($row = mysqli_fetch_array($sql)) {     
    ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style="text-align: center;">
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <?php echo $row['id'];
         ?></td>
        <td>
        <?php 
        // Decrypt the port name before displaying
        $aes_decrypted_portname = aesDecrypt($row['aesportname'], $aes_encryption_key, $aes_iv); 
        $triple_des_decrypted_portname = tripleDesDecrypt($row['3desportname'], $triple_des_key);
        $des_decrypted_portname = desDecrypt($row['desportname'], $des_key);
        $portname =$row['portname'];
        $row['desportname'];

        for ($u=1 ; $u<=1; $u++) {
            ?>
            <input type="text" name=user<?php echo $u; ?> value="<?php echo $portname; ?>" placeholder="Enter Port Name" Required style="height: 30px;width: -webkit-fill-available;background-color: lightblue;">
            <?php
        }
        ?>
        </td>
        <td><input type="submit" value="<?php echo $lang['B11']; ?>" name="submit" style="width:auto;padding:1px;height:40px"></td>
    </tr>
</form>

    <?php     
}
?>
</table>
<br>
<?php 
  require_once 'portnamefooter.php';
  include_once 'cacheend.php';

?>
</body>

</html>