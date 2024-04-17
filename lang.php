<?php require_once 'header.php'; require_once 'usernav.php'; include_once 'cachestart.php'; 
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
require_once($language . '.php');
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
    <form action="language.php" method="POST">
        <div
            style="border: 1px solid midnightblue;padding: 2px;height: 775px;margin-top: -1px;width: 1820px;margin-left: 70px;">
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="language" value="en" <?php   $kvmdata=new DB_con();
  $sql=$kvmdata->kvmdata();
$row=mysqli_fetch_array($sql); 
if ($row['language']  == 'English') {
                    echo 'checked="checked"';
                } 
            ?>> <?php echo $lang['AA1']; ?>
  <input type="radio" name="language" value="fr" <?php if ($row['language']  == 'French') {
                    echo 'checked="checked"';
                } 
            ?>> <?php echo $lang['AA2']; ?>
  <input type="radio" name="language" value="gr" <?php if ($row['language']  == 'German') {
                    echo 'checked="checked"';
                } 
            ?>> <?php echo $lang['AA3']; ?>
  <br>
  <br>
  <br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="<?php echo $lang['B11']; ?>">
        </div>
    </form>
</body>

</html>
<?php
include_once 'cacheend.php';
?>