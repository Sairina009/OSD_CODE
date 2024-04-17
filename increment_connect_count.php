<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $portname = $_POST['portname'];
    $decoder_name = $_POST['decoder_name'];
    $host = "localhost";
    $user = "kvm";
    $password = "kvm2023";
    $dbname = "kvm";
    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
        echo "Error connecting to the database: " . mysqli_connect_error();
        exit;
    }

    $query = "UPDATE portname SET connect = connect + 1, status='busy', decoder_name=$decoder_name WHERE portname = '$portname'";
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