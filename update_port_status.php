<?php
$portname = $_POST['portname'];
$host = "localhost";
$user = "kvm";
$password = "kvm2023";
$dbname = "kvm";
$conn = mysqli_connect($host, $user, $password, $dbname);

$updateQuery = "UPDATE portname SET status = 'busy' WHERE portname = '$portname'";
mysqli_query($conn, $updateQuery);
mysqli_close($conn);

echo 'success';
?>