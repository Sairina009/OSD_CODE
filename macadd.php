<?php 
include_once 'cachestart.php';

require_once 'macheader.php'; 
$sql=$kvmdata->macadd();
while ($result=mysqli_fetch_array($sql)) { ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style="text-align: center;">
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <?php echo $result['id']; ?></td>
        <td align=left style=padding:7px>&nbsp;<?php echo $result['portname']; ?></td>
        <td align="center"> <label>
                <h1> <span style="background-color: lightpink;font-size: 25px;">
                        <?php 
                        for ($u=1 ; $u<=1; $u++) { 
                            ?>
                        <input type=text name=user<?php echo $u; ?> style="background-color: lightpink;" value=<?php echo $result['macaddr']; ?> ></span></h1>
            </label></td>
                            <?php  
                        } 
                        ?>
        <td><input type=submit value=<?php echo $lang['B11']; ?> name=submit style=width:auto;padding:1px;height:35px></td>
    </tr>
</form>
    <?php 
} 
?>
</table>
<br>
<?php 
  require_once 'macfooter.php';
  include_once 'cacheend.php';

?>
</body>

</html>