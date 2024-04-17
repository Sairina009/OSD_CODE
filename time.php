<?php
require 'header.php';
require 'usernav.php';
require_once 'DBConnection.php';

$updatedata = new DB_con();

if (isset($_POST['save'])) {
    $time = $_POST['time'];
    $sql = $updatedata->time($time);
}

include_once 'cachestart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
    <script>
        function updateTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var time = hours + ':' + minutes + ':' + seconds;
            document.getElementById('time').value = time;
        }
          updateTime();
        setInterval(updateTime, 1000);
    </script>
</head>

<body>
    <form action="" method="POST">
        <?php
        require_once 'DBConnection.php';
        $kvmdata = new DB_con();
        $sql = $kvmdata->kvmdata();
        $row = mysqli_fetch_array($sql);
        ?>
        <div style="border:1px solid black;padding: 2px;height: 775px;margin-top: -1px;width: 1820px;margin-left: 70px;">
            <br>
            <span style="font-size: x-large;margin-left: 35px;"> <b><?php echo $lang['B2']; ?>:</b></span><label id="lb">
                <input type="text" id="time" name="time" value="<?php echo htmlentities($row['time']); ?>">
            </label>
            <input type="submit" name="save" value="<?php echo $lang['B11']; ?>" style="margin-left:10px;width: auto;padding: 1px;height: 35px;">
        </div>
    </form>
</body>

</html>

<?php
include_once 'cacheend.php';
?>