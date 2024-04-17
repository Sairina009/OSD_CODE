<?php require_once 'enableheader.php';
while ($row=mysqli_fetch_array($sql)) {
    ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style="text-align: center;">
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <?php echo $row['id']; ?>
        <td align="left" style="padding:5px">&nbsp;<?php echo $row['username']; ?></td>
        </td>
        <td>
          <?php 
            for ($u=1 ; $u<=1; $u++) {
                ?>
            <input type=radio id=a1 value=1 name=user<?php echo $u; ?>
                <?php if ($row['active']  == '1') {
                    echo 'checked="checked"';
                } ?>><?php echo $lang['F12']; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type=radio id=a2 value=0 name=user<?php echo $u; ?>
                <?php if ($row['active']  == '0') {
                    echo 'checked="checked"';
                } 
            }?>><?php echo $lang['E1']; ?>
        </td>
        <td><input type=submit value=<?php echo $lang['B11']; ?> id=submit name=submit style=width:auto;padding:1px;height:40px></td>
    </tr>
</form>
<?php } ?>
</table>
</body>

</html>