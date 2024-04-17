<?php 
include_once 'cachestart.php';

require_once 'virtualheader.php'; 
$sql=$kvmdata->virtual();
while ($result=mysqli_fetch_array($sql)) { ?>
<form action method=post enctype=multipart/form-data name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style=text-align:center>
        <td height=40px style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <?php echo $result['id']; ?></td>
        <td align=left style=padding:7px style="line-height: 2" ;>&nbsp;<?php echo $result['portname']; ?></td>
        <td><label style=width:490px;background-color:lightblue><?php echo $result['media']; ?></label>
            <input type=file name=files id=files multiple directory webkitdirectory moxdirectory value=...
                style=width:29px;background-color:black;-webkit-text-security:disc />
        </td>
        <td style="line-height:2" ;> <input type=Submit value=<?php echo $lang['B11']; ?> name=upload /></td>
    </tr>
</form>
<?php } ?>
</table>
<br>
<?php require_once 'virtualfooter.php';
include_once 'cacheend.php';

 ?>