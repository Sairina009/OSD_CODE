<?php
include_once 'dongleheader.php';

                $sql = $kvmdata->dongle();
                while ($row = mysqli_fetch_array($sql)) { ?>
                    <tr style="text-align: center;">
                        <td style="line-height:2" ;><?php echo $row['id']; ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"></td>
                        <td align="left" style="padding:7px">&nbsp;<?php echo $row['portname']; ?></td>
                        <td align="center"> 
                            <label>
                                <h1> 
                                    <span style="background-color: lightpink;font-size: 25px;">
                                        
                                         <input type="text" name="user<?php echo $row['id']; ?>" style="background-color: lightpink;" value="<?php echo $row['version']; ?>" >
                                    </span>
                            
                                </h1>
                            </label>
                        </td>
                        <td><input type="submit" value="<?php echo $lang['U7']; ?>" name="submit<?php echo $row['id']; ?>" style="width:auto;padding:1px;height:35px"></td>
                    </tr>
                <?php } ?>
            </table>
            <br>
        </form>
        <?php require_once 'donglefooter.php'; ?>
    </div>
</body>
</html>
