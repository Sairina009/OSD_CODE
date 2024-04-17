<?php
require_once 'DBConnection.php';

$fetchdata = new DB_con();
$sql = $fetchdata->kvmdata();
$row = mysqli_fetch_array($sql);

if ($row['hotkey'] == '< Caps Lock>') {
    include 'caps.html';
} elseif ($row['hotkey'] == '< Ctrl>') {
    include 'ctrl.html';
} else {
    echo 'scroll';
}
?>