<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $language = $_POST['language'];
  session_start();
  $_SESSION['language'] = $language;
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>