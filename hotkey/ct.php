<?php 
require 'DBConnection.php';
$updatedata=new DB_con(); 
$sql=$updatedata->control();   
?>
<script type="text/javascript">

window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'KeyS') { 
    window.location.href = 'scan.php';
event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad1') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad2') {
    window.location.href = 'user3.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad3') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad4') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad5') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad6') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad7') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad8') {
    window.location.href = 'user.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'Numpad9') {
    window.location.href = 'user3.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'ArrowUp') {

    window.location.href = 'function.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'ArrowDown') {
    window.location.href = 'help.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.ctrlKey && event.code === 'KeyV') {
    window.location.href = 'demo.php';
    event.preventDefault();
  }
});
 </script>