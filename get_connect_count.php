<?php
function getConnectCount() {
    $host = "localhost";
    $user = "kvm";
    $password = "kvm2023";
    $dbname = "kvm";
    $conn = mysqli_connect($host, $user, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT COUNT(*) AS connect FROM portname";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $connectCount = $row['connect'];
        mysqli_close($conn);
        return $connectCount;
    } else {
        mysqli_close($conn);
        return 0;
    }
}

$connectCount = getConnectCount();
echo $connectCount;
?>