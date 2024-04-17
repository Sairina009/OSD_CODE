<?php require_once 'audioheader.php';
$sql=$kvmdata->audio();
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
            <input type=radio id=1 value=OFF checked name=user<?php echo $u; ?>
                <?php if ($result['audio']  == 'OFF') {
                    echo 'checked="checked"';
                } ?>> <?php echo $lang['T2']; ?> &nbsp;&nbsp;&nbsp;
            <input type=radio id=2 value=Analog name=user<?php echo $u; ?>
                <?php if ($result['audio']  == 'Analog') {
                    echo 'checked="checked"';
                } ?>> <?php echo $lang['O3']; ?>&nbsp;&nbsp;&nbsp;
            <input type=radio id=3 value=Digital name=user<?php echo $u; ?>
                <?php if ($result['audio']  == 'Digital') {
                    echo 'checked="checked"';
                } ?>> <?php echo $lang['O4']; ?>
                <?php
            }
            ?>
        </td>
        <td align="left">
            <?php 
            for ($u=1 ; $u<=1; $u++) {
                ?>
            <select name=user1<?php echo $u; ?> id=audio
                style='background-color: skyblue;height: 35px;width: 148px;margin-left: 20px;'>
                <option value='Mono, 44.1KHz'
                    <?php if ($result['format']  == 'Mono, 44.1KHz') {
                        echo 'selected="selected"';
                    } ?>> Mono, 44.1KHz
                </option>
                <option value='Stereo, 48KHz'
                    <?php if ($result['format']  == 'Stereo, 48KHz') {
                        echo 'selected="selected"';
                    } ?>>Stereo, 48KHz
                </option>
                <option value='Mono, 48KHz'
                    <?php if ($result['format']  == 'Mono, 48KHz') {
                        echo 'selected="selected"';
                    } ?>>Mono, 48KHz</option>
                <option value='Stereo, 96KHz'
                    <?php if ($result['format']  == 'Stereo, 96KHz') {
                        echo 'selected="selected"';
                    } ?>>Stereo, 96KHz
                </option>
                <option value='Stereo, 48KHz'
                    <?php if ($result['format']  == 'Stereo, 48KHz') {
                        echo 'selected="selected"';
                    } ?>>Stereo, 48KHz
                </option>
                <?php
            }
            ?>
        </td>
        <td><input type="submit" value="<?php echo $lang['B11']; ?>" name="submit">
        </td>
    </tr>
</form>
<?php } ?>
</table><br>
<?php require_once 'audiofooter.php';?>