<?php require_once "penableheader.php";
 $sql=$kvmdata->portenable();
 $i =0;
while ($result=mysqli_fetch_array($sql)) {
    ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style=text-align:center>
        <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $result['id']; ?>">
           <?php echo $result['id']; ?>
        </td>
        <td align=left style=padding:7px style="line-height: 2" ;>&nbsp;<?php echo $result['portname']; ?></td>
        
        <td align=left style="line-height:2" ;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <?php 
           $id = $result['id'];
            for ($u=1 ; $u<=8; $u++) { ?>
                <input type=checkbox id=u1 name=user<?php echo $u; ?>  
                <?php if ($result['enable'. $u]  == 'on' && $result['id'] == $id) { 
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
           $id = $result['id'];
            for ($u=9 ; $u<=16; $u++) { ?>
                <input type=checkbox id=u2 name=user1<?php echo $u; ?>  
                <?php if ($result['enable'. $u]  == 'on' && $result['id'] == $id) { 
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
        </td>
        <td style="line-height:2" ;><input type=submit value=<?php echo $lang['B11']; ?> name=submit></td>
    </tr>
</form>
<?php  } ?>
</table>
<br>
<?php 
  require_once 'penablefooter.php';
?>        </body>

        </html>