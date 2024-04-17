<?php 
include_once 'cachestart.php';

require_once 'linkheader.php';
$sql=$kvmdata->link();
while ($result=mysqli_fetch_array($sql)) { ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr align=center>
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <?php echo $result['id']; ?>
        <td align=left style=padding:7px> &nbsp;<?php echo $result['portname']; ?></td>
        <td align=left>
            <?php 
            for ($u=1 ; $u<=1; $u++) {
                ?>
            <input type=radio id=a1 checked value=StandardPort name=user<?php echo $u; ?>
                <?php if ($result['linktype']  == 'StandardPort') {
                    echo 'checked="checked"';
                } ?>><?php echo $lang['I2']; ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type=radio id=a2 value=KvmSwitch name=user<?php echo $u; ?>
                <?php if ($result['linktype']  == 'KvmSwitch') {
                    echo 'checked="checked"';
                } 
            } ?>><?php echo $lang['I9']; ?>
        <td><input type=submit value=<?php echo $lang['B11']; ?> name=submit style=width:auto;padding:1px;height:40px></td>
    </tr>
</form>
<?php } ?>
</table>
<br>
<?php 
  require_once 'linkfooter.php';
  include_once 'cacheend.php';

?>
</body>

</html>