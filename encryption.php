<?php require_once 'header.php'; require_once 'usernav.php'; include_once 'cachestart.php';?>
<?php  
 $updatedata=new DB_con();
if (isset($_POST["enc"])) {          
    $value =$_POST['enc'];
    $sql=$updatedata->encryption($value);
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
    <form action method=post>
        <div style="border:1px solid black;padding:2px;height:775px;margin-top:-1px;width:1820px;margin-left:70px">
            <br>
            <label><span style=font-size:larger;margin-left:35px checked><b><?php echo $lang['B7']; ?>:</b></span></label>&nbsp;
            <input type="radio" class="targetSettingRegisteredUsers inputabs" name="enc" id="e" value="Disable" checked
                checked onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['E1']; ?>
            &nbsp;<input type="radio" class="inputabs" name="enc" id="e1" value="AES"
                onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['E2']; ?> &nbsp;
            <input type="radio" class="inputabs" name="enc" id="e2" value="DES"
                onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['E3']; ?> &nbsp;
            <input type="radio" class="inputabs" name="enc" id="e3" value="3DES"
                onclick="storeSelectionb1(this)" />&nbsp;&nbsp;<?php echo $lang['E4']; ?> <br />
            <input type="submit" value="<?php echo $lang['B11']; ?>" id="result"
                style=margin-left:350px;width:auto;padding:1px;height:35px>
        </div>
    </form>
</body>

</html>
<script type="text/javascript">
var keya = "user_selectiona"
var lastSelection;

function storeSelectionb1(el) {
    window.localStorage.setItem(keya, el.id);
}

function init() {
    var last = window.localStorage.getItem(keya);
    if (last) {
        document.getElementById(last).checked = true;
    }
}
init();
</script>
<?php
include_once 'cacheend.php';
?>