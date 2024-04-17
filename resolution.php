<?php 
include_once 'cachestart.php';

require_once 'resolutionheader.php';
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
            <select name=user<?php echo $u; ?> id=res
                style='background-color: skyblue;height: 35px;width: 140px;margin-left: 15px;'>
                <option value='3840 * 2160'
                    <?php if ($result['resolution']  == '3840 * 2160') {
                        echo 'selected="selected"';
                    } ?>> 3840 * 2160
                </option>
                <option value='1920 * 1080'
                    <?php if ($result['resolution']  == '1920 * 1080') {
                        echo 'selected="selected"';
                    } ?>> 1920 * 1080
                </option>
                <option value='1280 * 720'
                    <?php if ($result['resolution']  == '1280 * 720') {
                        echo 'selected="selected"';
                    } ?>> 1280 * 720
                </option>
                <option value='800 * 600'
                    <?php if ($result['resolution']  == '800 * 600') {
                        echo 'selected="selected"';
                    } ?>> 800 * 600
                </option>
                <option value='640 * 480'
                    <?php if ($result['resolution']  == '640 * 480') {
                        echo 'selected="selected"';
                    } ?>> 640 * 480 </option>
                <option value='320 * 240'
                    <?php if ($result['resolution']  == '320 * 240') {
                        echo 'selected="selected"';
                    } ?>> 320 * 240 </option>
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
  require_once 'resolutionfooter.php';
  include_once 'cacheend.php';

?>
</body>

</html>