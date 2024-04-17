<div class="pagination" style="margin-left: 42px;">            
    <?php  
        $sql=$kvmdata->portcount(); 
        $row = mysqli_fetch_row($sql);  
        $total_records = $row[0];      
        $per_page_record = 8;
            if (isset($_GET["page"])) {    
                $page  = $_GET["page"];    
            } else {    
                $page=1;    
            }  
            echo "</br>";       
              $total_pages = ceil($total_records / $per_page_record);     
              $pagLink = "";       
            if ($page>=2) {   
                echo "<a href='scan.php?page=".($page-1)."'>  Prev Page &nbsp;";echo $page;   " &nbsp; </a>";   
            }       
            if ($page<$total_pages) {   
                echo "<a href='scan.php?page=".($page+1)."'> &nbsp;  Next </a>";   
            }   
    ?>    
 
<span style="font-size: large;margin-left: 630px;"> <b>Scan Time:</b></span><label> <input type="text"
            name="time" value="" style="width: 50px;"> &nbsp;<?php echo $lang['P8']; ?></label>
            <input type="submit" name="save" value="<?php echo $lang['B11']; ?>" style="margin-left:10px;width: auto;padding: 1px;height: 35px;">
</div>   