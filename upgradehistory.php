<?php require_once 'upgradeheader.php';
  $sql=$kvmdata->upgradehistory(); 
            $cnt=1;
while ($row=mysqli_fetch_array($sql)) { ?>
<tr align="center">
    <td height="30px" style="width:auto;"><?php echo $row['type']; ?></td>
    <td align="left" style="padding:8px"><?php echo $row['user']; ?></td>
    <td align="left"><?php echo $row['starttime']; ?></td>
    <td><?php echo $row['endtime']; ?></td>
    <td><?php echo $row['perversion']; ?></td>
    <td><?php echo $row['upgradeversion']; ?></td>
    <td style="width:auto"><?php echo $lang['Y5']; ?> </td>
</tr>
<?php  } ?>
</table>
</form>
<br>
<?php 
  require_once 'upgradefooter.php';
?>
</body>

</html>