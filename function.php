<?php require_once 'funtionheader.php';include_once 'cachestart.php'; ?>
<form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
    <tr style=text-align:center>
        <td style="line-height:2" ;>1</td>
        <td align=left style=padding:7px style="line-height: 2" ;>&nbsp;<?php echo $lang['F7']; ?> </td>
        <td align="left" style="line-height:2" ;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            for ($u=1 ; $u<=8; $u++) {
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=u1 class=save-cb-state name=user<?php echo $u; ?>
                <?php if ($row['hid']  == 'on') { 
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            for ($u=9 ; $u<=16; $u++) {
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=u2 class=save-cb-state name=user1<?php echo $u; ?>
                <?php if ($row['hid']  == 'on') { 
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
        <td style="line-height:2" ;><input type="submit" value="<?php echo $lang['B11']; ?>" name="hid"></td>
    </tr>
    <tr style=text-align:center>
        <td style="line-height:2" ;>2</td>
        <td align=left style=padding:7px style="line-height: 2" ;>&nbsp;<?php echo $lang['F8']; ?> </td>
        <td align="left" style="line-height:2" ;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            require_once "DBConnection.php";
            $kvmdata=new DB_con();
            $sql=$kvmdata->userdata();
            for ($m=1 ; $m<=8; $m++) {
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=m1 name=mass<?php echo $m; ?>
                <?php if ($row['mass']  == 'on') {
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            for ($m=9 ; $m<=16; $m++) {  
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=m2 name=mass1<?php echo $m; ?>
                <?php if ($row['mass']  == 'on') {
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
        <td style="line-height:2" ;><input type="submit" value="<?php echo $lang['B11']; ?>" name="mass"></td>
    </tr>
 </td>
    </tr>
    <tr style=text-align:center>
        <td style="line-height:2" ;>3</td>
        <td align=left style=padding:7px style="line-height: 2" ;>&nbsp;<?php echo $lang['F9']; ?> </td>
        <td align="left" style="line-height:2" ;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            require_once "DBConnection.php";
            $kvmdata=new DB_con();
            $sql=$kvmdata->userdata();
            for ($c=1 ; $c<=8; $c++) {
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=c1 name=card<?php echo $c; ?>
                <?php if ($row['card']  == 'on') {
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            for ($c=9 ; $c<=16; $c++) {  
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=c2 name=card1<?php echo $c; ?>
                <?php if ($row['card']  == 'on') {
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
        <td style="line-height:2" ;><input type="submit" value="<?php echo $lang['B11']; ?>" name="card"></td>
    </tr>
    <tr style=text-align:center>
        <td style="line-height:2" ;>3</td>
        <td align=left style=padding:7px style="line-height: 2" ;>&nbsp;<?php echo $lang['F10']; ?> </td>
        <td align="left" style="line-height:2" ;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            require_once "DBConnection.php";
            $kvmdata=new DB_con();
            $sql=$kvmdata->userdata();  
            for ($v=1 ; $v<=8; $v++) {
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=v1 name=virtual<?php echo $v; ?>
                <?php if ($row['virtual']  == 'on') {
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            for ($v=9 ; $v<=16; $v++) {  
                $row=mysqli_fetch_array($sql);
                ?>
            <input type=checkbox id=v2 name=virtual1<?php echo $v; ?>
                <?php if ($row['virtual']  == 'on') {
                    echo 'checked="checked"';
                } else { 
                    echo ''; 
                } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
        <td style="line-height:2" ;><input type="submit" value="<?php echo $lang['B11']; ?>" name="virtual"></td>
    </tr>
  
</form>
</table>
</body>

</html>
<?php
include_once 'cacheend.php';
?>