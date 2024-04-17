<?php require_once 'thumbheader.php'; include_once 'cachestart.php';?>
<div style="border:1px solid black;padding:2px;height:775px;margin-top:-1px;width:1820px;margin-left:70px">
    <br>
    <form action method=post>
        <label><span style=margin-left:35px><span style=font-size:large><b><?php echo $lang['B5']; ?>:</b></span></label>
        <input type="radio" class="inputabs" name="view" checked id="a1" value="ON"
            onclick="storeSelectionb(this)" />&nbsp;&nbsp;<?php echo $lang['T1']; ?>
        &nbsp;
        <input type="radio" class="inputabs" name="view" id="a2" value="OFF"
            onclick="storeSelectionb(this)" />&nbsp;&nbsp;<?php echo $lang['T2']; ?> <br />
        <input type="submit" value="<?php echo $lang['B11']; ?>" id="result" style=margin-left:350px;width:auto;padding:1px;height:35px>
</div>
</form>
</div>
<?php require_once 'thumbfooter.php'; include_once 'cacheend.php'; ?>