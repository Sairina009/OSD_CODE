<?php
$updatedata=new DB_con(); 
$sql=$updatedata->auditlog();
?>
<div class="pagination" style="margin-left: 722px;margin-top: -230px;">    
      <?php  
        $sql=$kvmdata->logcount(); 
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
            echo "<a href='auditlog.php?page=".($page-1)."'>  Prev Page &nbsp;";echo $page;   " &nbsp; </a>";    
        }       
        if ($page<$total_pages) {   
            echo "<a href='auditlog.php?page=".($page+1)."'> &nbsp; Next </a>";   
        }   
        ?> 

         &nbsp;&nbsp;&nbsp;&nbsp;<a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" style="width: auto;height: 35px; padding: 2px;">Clear</a>&nbsp;&nbsp;&nbsp;&nbsp;
      
</div>  