<?php require_once "header.php"; include_once 'cachestart.php';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
require_once($language . '.php');
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
    <div id=display style=margin-top:-850px;margin-left:85px>
        <label><?php echo $lang['A1']; ?></label>
        <?php
        $updatedata=new DB_con(); 
        $sql=$updatedata->help();
        ?>
        <br><label> <?php echo $lang['A2']; ?></label>
        <br><label> <?php echo $lang['A3']; ?></label>
        <br> <label> <?php echo $lang['A4']; ?></label>
    </div>
    <table id=displaytable cellpadding=2 cellspacing=0 border=3 style=margin-left:85px;line-height:3;width:70%>
        <tr align=left style=background-color:lightsteelblue>
            <td class=lbl><?php echo $lang['A5']; ?></td>
        </tr>
        <tr align=center style="height:30%">
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
    </table><br>
    <table id=displaytable1 cellpadding=2 cellspacing=0 border=3 style=margin-left:85px;line-height:3;width:70%>
        <tr align=left style=background-color:lightsteelblue>>
            <td class=lbl><?php echo $lang['A18']; ?></td>
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
    </div>
</body>

</html>
<?php
include_once 'cacheend.php';
?>