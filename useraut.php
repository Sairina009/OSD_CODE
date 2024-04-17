<?php require_once 'autheader.php'; include_once 'cachestart.php';
while ($row=mysqli_fetch_array($sql)) {
    ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style="text-align: center;">
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <?php echo $row['id']; ?>
        <td align="left" style="padding:5px">&nbsp;<?php echo $row['username']; ?></td>
        <td>
          <?php 
            for ($u=1 ; $u<=1; $u++) {
                ?>
            <input type=radio id=a1 value=Admin name=user<?php echo $u; ?>
                <?php if ($row['authority']  == 'Admin') {
                    echo 'checked="checked"';
                } ?>><?php echo $lang['F15']; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type=radio id=a2 value=User name=user<?php echo $u; ?>
                <?php if ($row['authority']  == 'User') {
                    echo 'checked="checked"';
                } 
            }?>><?php echo $lang['P2']; ?>
        </td>
        <td><input type=submit value=<?php echo $lang['B11']; ?> name=submit style=width:auto;padding:1px;height:40px></td>
    </tr>
</form>
<?php } ?>
</table>
</body>

</html>
<?php
include_once 'cacheend.php';
?>