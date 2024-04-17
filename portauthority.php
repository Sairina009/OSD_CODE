<?php require_once "pautheader.php"; 
            $sql=$kvmdata->scan();
            while ($result=mysqli_fetch_array($sql)) {  ?>
            <form action method=post name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
                <tr style=text-align:center style=line-height:2>
                    <td style="line-height:2" ;><input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                                    <?php echo $result['id']; ?>
                    <td align=left style=padding:7px>&nbsp;<?php echo $result['portname']; ?></td>
                    <td align=left style="line-height: 2;">
                                    <?php 
                                    $id = $_SESSION['id'];
                                    for ($u=1 ; $u<=8; $u++) { 
                                                echo "&nbsp;&nbsp;";
                                                ?>
                                    <select name=user<?php echo $u; ?>><option value=user<?php echo $u; ?> style=word-wrap: normal;width: 40px;background-color: lightskyblue;height: 30px; disabled selected 
                                                >S</option>
                                        <option value='Share' <?php if ($result['a' . $u]  == 'Share') {
                                                                echo 'selected="selected"';
                                                            } ?>>S</option>
                                        <option value='View' <?php if ($result['a' . $u]  == 'View') {
                                                                echo 'selected="selected"';
                                                            } ?>>V</option>
                                        <option value='Private'  <?php if ($result['a' . $u]  == 'Private') {
                                                                echo 'selected="selected"';
                                                            } ?>>P</option>
                                    </select>
                                    <?php
                                    }
                                    ?>
                                    <br>                                
                                    <?php 
                                    $id = $_SESSION['id'];
                                    for ($u=9 ; $u<=16; $u++) { 
                                                echo "&nbsp;&nbsp;";
                                                ?>
                                    <select name=user1<?php echo $u; ?>> <option value=user1<?php echo $u; ?> style=word-wrap: normal;width: 40px;background-color: lightskyblue;height: 30px; disabled selected 
                                                >S</option>
                                        <option value='Share' <?php if ($result['a' . $u]  == 'Share') {
                                                                echo 'selected="selected"';
                                                            } ?>>S</option>
                                        <option value='View' <?php if ($result['a' . $u]  == 'View') {
                                                                echo 'selected="selected"';
                                                            } ?>>V</option>
                                        <option value='Private'  <?php if ($result['a' . $u]  == 'Private') {
                                                                echo 'selected="selected"';
                                                            } ?>>P</option>
                                    </select>
                                    <?php
                                    }
                                    ?>
                    <td><input type="submit" name="submit" value="<?php echo $lang['B11']; ?>"
                            style="width:auto;height: 45px;padding: unset;"></td>
                </tr>
            </form>
            <?php } ?>
        </table>
        <br>
        <?php 
  require_once 'pautfooter.php';
?> 
</body>

</html>