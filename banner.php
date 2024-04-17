<?php  require_once "header.php"; require_once 'usernav.php'; include_once 'cachestart.php';?>
<?php  
 $updatedata=new DB_con();
if (isset($_POST["banner"])) {          
    $value =$_POST['banner'];
    $time = $_POST['time'];
     $sql=$updatedata->banner($value, $time); 
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
    <div style="border:1px solid black;padding:2px;height:775px;margin-top:-1px;width:1820px;margin-left:70px">
        <br>
        <form action="" method="post" id="myForm">
            <label><span style=font-size:larger;margin-left:35px><span
                        style=font-size:large><b><?php echo $lang['B6']; ?>:</b></span></label>&nbsp;
            <input type="radio" class="targetSettingRegisteredUsers inputabs" name="banner" id="a1" value="OFF" checked
                checked onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['T2']; ?>
            &nbsp;<input type="radio" class="inputabs" name="banner" id="a2" value="ON"
                onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['T1']; ?> &nbsp;
            <input type="radio" class="inputabs" name="banner" id="a3" value="ALWAYS ON"
                onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['C1']; ?><br />
                <?php require_once 'DBConnection.php'; $kvmdata=new DB_con(); $sql=$kvmdata->kvmdata(); $row=mysqli_fetch_array($sql); ?>
                <label><span style=font-size:larger;margin-left:35px><span
                        style=font-size:large><b>Time:</b></span></label>&nbsp;
                        <input type="text" name="time" value="<?php echo $row['bannertime']; ?>">  <?php echo $lang['C2']; ?><br>
                <label><span style=font-size:larger;margin-left:93px>(1~99 <?php echo $lang['C2']; ?>)</span></label>
            <input type="submit" value="<?php echo $lang['B11']; ?>" id="result"
                style=margin-left:180px;width:auto;padding:1px;height:35px>
            
    </div>
    </form>
</body>

</html>
<script type="text/javascript">
var keyb1 = "user_selectionb1"
var lastSelection;
function storeSelectionb1(el) {
    window.localStorage.setItem(keyb1, el.id);
}
function init() {
    var last = window.localStorage.getItem(keyb1);
    if (last) {
        document.getElementById(last).checked = true;
    }
}
init();
</script>
<?php
include_once 'cacheend.php';
?>