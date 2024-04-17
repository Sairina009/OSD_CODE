<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$servername = "localhost";
$username = "kvm";
$password = "kvm2023";
$dbname = "kvm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$thumbnailId = $_GET['id'];

$sql = "SELECT image_name, lastupdatedby FROM portname WHERE id = $thumbnailId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageFormat = "jpg"; 

    if ($imageFormat === "jpg" || $imageFormat === "jpeg") {
        header("Content-type: image/jpeg");
    } elseif ($imageFormat === "png") {
        header("Content-type: image/png");
    } elseif ($imageFormat === "gif") {
        header("Content-type: image/gif");
    } elseif ($imageFormat === "webp") {
        header("Content-type: image/webp");
    } else {

        header("Content-type: application/octet-stream"); 
    }

    $etag = md5($row['last_modified'] . $row['image_name']); 
    header("ETag: \"$etag\"");

    if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === "\"$etag\"") {
        http_response_code(304);
        exit;
    }
    header("Cache-Control: public, max-age=604800"); 
    header("Last-Modified: " . gmdate("D, d M Y H:i:s", strtotime($row['lastupdatedby'])) . " GMT");
    readfile($row['image_name']);
} else {
    echo "Thumbnail not found";
}
$conn->close();
?>