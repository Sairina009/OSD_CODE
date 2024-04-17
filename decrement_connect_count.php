<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $portname = $_POST['portname'];
    $id = $_POST['id'];   
    $host = "localhost";
    $user = "kvm";
    $password = "kvm2023";
    $dbname = "kvm";
    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
         echo "Error connecting to the database: " . mysqli_connect_error();
        exit;
    }
    $query = "UPDATE portname SET connect = connect - 1 WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "success";
    } else {
        echo "Error updating the connect count: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request";
}
?>