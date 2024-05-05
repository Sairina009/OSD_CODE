<?php 
require_once "DBConnection.php";
$updatedata=new DB_con(); 
$sql=$updatedata->scroll();   
?>
<script type="text/javascript">
 window.addEventListener('scroll', function (event) {
     if (event.code === 'Numpad2') {
         window.location.href = 'scan3.php';
         event.preventDefault();
     }
 });
      window.addEventListener('keydown', function (event) {
     if (event.getModifierState("ScrollLock") && event.code === 'KeyV') {
         window.location.href = 'demo.php';
     }
 });
window.addEventListener('keydown', function (event) {
  if (event.getModifierState("ScrollLock")  && event.code === 'ArrowDown') {
    window.location.href = 'time.php';
    event.preventDefault();
  }
});
window.addEventListener('keydown', function (event) {
  if (event.getModifierState("ScrollLock")  && event.code === 'ArrowUp') {
    window.location.href = 'lang.php';
    event.preventDefault();
  }
});
</script>