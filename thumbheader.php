<?php require_once "header.php"; require_once 'usernav.php'; ?>
<?php  
$updatedata=new DB_con();
if (isset($_POST["view"])) {          
    $value =$_POST['view'];
    $sql=$updatedata->view($value); 
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