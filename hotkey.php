<?php require_once "header.php";  require_once 'usernav.php'; include_once 'cachestart.php'; ?>
<?php 
$updatedata=new DB_con(); 
if (isset($_POST["submit"])) {          
    $value =$_POST["hotkey"];
  

 if ($value == '< Scroll Lock>') {
        $sql=$updatedata->scroll();
        
    }
    elseif ($value == '< Ctrl>') {
         $sql=$updatedata->control(); 
         
     } 
     elseif ($value == '< Caps Lock>') {
        $sql=$updatedata->caps();
        
     }

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
    <div style="border:1px solid midnightblue;padding:2px;height:775px;margin-top:-1px;width:1820px;margin-left:70px">
        
        <form action="" method="post" id="myForm">
        &nbsp;&nbsp;<input type="radio" <?php   $kvmdata=new DB_con();
  $sql=$kvmdata->kvmdata();
$row=mysqli_fetch_array($sql); if ($row['hotkey']  == '< Scroll Lock>') {
                    echo 'checked="checked"';
                } 
            ?> class="inputabs" name="hotkey" id="a1" value="< Scroll Lock>" checked />&nbsp;&nbsp;< Scroll Lock > < Scroll Lock > < Function Hotkey >< Enter><br>
            &nbsp;&nbsp;<input type="radio" class="inputabs" name="hotkey" id="a2" value="< Caps Lock>"
            <?php   $kvmdata=new DB_con();
  $sql=$kvmdata->kvmdata();
$row=mysqli_fetch_array($sql); if ($row['hotkey']  == '< Caps Lock>') {
                    echo 'checked="checked"';
                } 
            ?> />&nbsp;&nbsp;< Caps Lock > < Caps Lock > < Function Hotkey >< Enter>  &nbsp;<br>
            &nbsp;&nbsp;<input type="radio" class="inputabs" name="hotkey" id="a3" value="< Ctrl>"
            <?php   $kvmdata=new DB_con();
  $sql=$kvmdata->kvmdata();
$row=mysqli_fetch_array($sql); if ($row['hotkey']  == '< Ctrl>') {
                    echo 'checked="checked"';
                } 
            ?> />&nbsp;&nbsp;< Ctrl> < Ctrl> < Function Hotkey> < Enter> <br />
        <input type="submit" value="<?php echo $lang['B11']; ?>" id="result" name="submit"
                style=margin-left:180px;width:auto;padding:1px;height:35px>
        <table id=displaytable cellpadding=2 cellspacing=0 border=3
            style=width:70%;height:30%;margin-left:35px;line-height:3;margin-top:15px>
            <th class=lbl style=height:30%;background-color:lightsteelblue;line-height:2;font-size:16px;font-style:bold>
            <?php echo $lang['A5']; ?>></th>
            <tr align=left>
            <tr align=center>
            <td class=lbl><?php echo $lang['A6']; ?></td>
            <td class=lbl><?php echo $lang['A7']; ?></td>
            <td class=lbl><?php echo $lang['A8']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A9']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A10']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A11']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A12']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A13']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A14']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A15']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A16']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A17']; ?></td>
            </tr>
        </table>
        <table id=displaytable cellpadding=2 cellspacing=0 border=3
            style=width:70%;height:30%;margin-left:35px;line-height:3;margin-top:15px>
            <tr align=left>
                <th class=lblh style=background-color:lightsteelblue><?php echo $lang['A18']; ?></th>
            </tr>
            <tr align=center>
            <td class=lbl><?php echo $lang['A19']; ?></td>
            <td class=lbl><?php echo $lang['A20']; ?></td>
            <td class=lbl><?php echo $lang['A21']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A22']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A23']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A24']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A25']; ?></td>
            <td align=left> &nbsp;<?php echo $lang['A26']; ?> </td>
            <td align=left> &nbsp;<?php echo $lang['A27']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A28']; ?></td>
            <td align=left> &nbsp;<?php echo $lang['A29']; ?></td>
            <td align=left>&nbsp;<?php echo $lang['A30']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A31']; ?></td>
            <td align=left> &nbsp;<?php echo $lang['A32']; ?></td>
            <td align=left> &nbsp;<?php echo $lang['A33']; ?></td>
        </tr>
        <tr>
            <td align=center><?php echo $lang['A34']; ?></td>
            <td align=left> &nbsp;<?php echo $lang['A35']; ?> </td>
            <td align=left>&nbsp;<?php echo $lang['A36']; ?></td>
        </tr>
        </table>
        </form>
    </div>
    
</body>

</html>
<?php
include_once 'cacheend.php';
?>