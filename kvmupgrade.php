<?php require_once "header.php";  require_once 'mainnav.php'; 
require_once 'DBConnection.php';
$updatedata=new DB_con();
if (isset($_POST["save"])) {  
   $target_dir = "C:/xampp1/htdocs/";
    $path = $target_dir . basename($_FILES["fileToUpload"]["name"]);
   $username = $_SESSION['username'];
   $type= "KVM FW Upgrade";
    $sql=$updatedata->kvmupgrade($type, $username, $path);
}
include_once 'cachestart.php';
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
    <br>
    <form action method=post enctype=multipart/form-data>
        <?php
        require_once "DBConnection.php";
        $kvmdata=new DB_con();
        $sql=$kvmdata->kvmdata();
        $result=mysqli_fetch_array($sql);  ?>
        <label style=margin-left:85px;>Path : </label><label
            style=margin-left:11px;background-color:lightblue;width:750px;><?php echo $result['path']; ?></label>
        <input type=file name=fileToUpload id=fileToUpload required style=margin-left:10px>
        <br><br>
        <input type=submit value=<?php echo $lang['U7']; ?> name=save style=margin-left:900px>
    </form>
</body>

</html>
<?php
include_once 'cacheend.php';
?>