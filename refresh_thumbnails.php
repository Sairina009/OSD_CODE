<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'DBConnection.php';
$kvmdata = new DB_con();
$sql = $kvmdata->user();

if ($sql->num_rows > 0) {
    while ($data = mysqli_fetch_array($sql)) {
        echo '<div class="image-container">';
        echo '<img src="view_thumbnail.php?id=' . $data['id'] . '&timestamp=' . time() . '" alt="' . $data['image_name'] . '" style="width: 95%; height: auto; margin-bottom: 20px;" class="button connect-button" data-id="' . $data['id'] . '" onclick="startStream(' . $data['id'] . '); closeCanvas()">';
        echo '<div class="image-info">';
        echo '<p>Encoder Name:' . $data['portname'] . '</p>';
        echo '<p>Connection Type: ' . $data['type'] . '</p>';
        echo '<p>Status: ' . $data['pc_online'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
}
?>
