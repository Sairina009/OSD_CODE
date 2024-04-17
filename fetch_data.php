<?php
require_once 'DBConnection.php';
if (isset($_GET['language'])) {
  $language = $_GET['language'];
  $query = "SELECT data FROM language_data WHERE language = '$language'";
  $result=mysqli_fetch_array($conn,$query);
  echo $retrievedData;
}
?>