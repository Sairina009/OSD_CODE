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
          echo "<a href='virtualmedia.php?page=".($page-1)."'>  Prev Page &nbsp;";echo $page;   " &nbsp; </a>";   
      }       
      if ($page<$total_pages) {   
          echo "<a href='virtualmedia.php?page=".($page+1)."'> &nbsp; Next </a>";   
      }   
        ?>    
</div>  