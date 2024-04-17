<?php require_once 'passheader.php'; include_once 'cachestart.php';
while ($row=mysqli_fetch_array($sql)) {
    ?>
<form name="form<?php echo $i; ?>" id="form<?php echo $i; ?>" method="post" action=""
    onsubmit="return validatePassword()">
    <td style="line-height:2;text-align: center;"><input type="hidden" name="id"  value="<?php echo $row['id']; ?>">
      <?php echo $row['id']; ?></td>
    <td align="left" style="padding:5px">&nbsp;<?php echo $row['username']; ?></td>
    <td><input type="hidden" class="form-control" placeholder="Current Password" name="user$u"
            value="<?php echo $row['password']; ?>"><?php echo $row['password']; ?><span id="currentPassword"
            class="required"></span></td>
    <td> <?php
    for ($u=1 ; $u<=1; $u++) {
        echo "<input type=password name=user$u value='' class=txtField id=pass1 style=height: 30px;width: -webkit-fill-available;
    background-color: lightblue;  required>";
    } ?></td>
    <td> <?php
    for ($u=1 ; $u<=1; $u++) {
        echo "<input type=password name=user1$u value='' class=txtField id=pass2 style=height: 30px;width: -webkit-fill-available;
    background-color: lightblue;  required>";
    } ?></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="<?php echo $lang['B11']; ?>" class="btnSubmit"></td>
    </tr>
</form>
<?php } ?>
</table>
</body>

</html>
<?php
include_once 'cacheend.php';
?>