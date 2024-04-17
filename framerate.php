<?php 
include_once 'cachestart.php';

require_once 'framerateheader.php';
$sql=$kvmdata->resolution();
while ($result=mysqli_fetch_array($sql)) {  ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr align=center>
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <?php echo $result['id']; ?>
        <td align=left style=padding:7px> &nbsp;<?php echo $result['portname']; ?></td>
        <td align=left>
            <?php 
            for ($u=1 ; $u<=1; $u++) {
                ?>
              <select name="user<?php echo $u; ?>" id="framerate" style='background-color: skyblue;height: 35px;width: 90px;margin-left: 15px;'>
                        <option value='15 fps' <?php if ($result['framerate'] == '15 fps') echo 'selected="selected"'; ?>> 15 fps</option>
                        <option value='30 fps' <?php if ($result['framerate'] == '30 fps') echo 'selected="selected"'; ?>> 30 fps</option>
                        <option value='60 fps' <?php if ($result['framerate'] == '60 fps') echo 'selected="selected"'; ?>>60 fps</option>
                    </select>
                <?php
            }
            ?>
        <td><input type="submit" name="submit" value="<?php echo $lang['B11']; ?>" style="width:auto;height: 45px;padding: unset;"></td>
    </tr>
</form>
<?php } ?>
</table>
<br>
<?php 
  require_once 'frameratefooter.php';
  include_once 'cacheend.php';

?>
</body>

</html>