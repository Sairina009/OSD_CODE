<?php require_once 'dbconn.php';
$id=$_GET['id'];
if ($id) {
    $sql = "TRUNCATE TABLE logs";
    $res=mysqli_query($conn, $sql);
    header("location:auditlog.php");
} else {
    echo $error;
}
        mysqli_close($conn);
?>