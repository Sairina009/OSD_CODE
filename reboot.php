<?php require_once "header.php";  require_once 'mainnav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
</head>

<body>
    <form action="" method="post">
        <div
            style="border:1px solid black;padding: 2px;height: 750px;margin-top: -1px;width: 1820px;margin-left: 70px;">
            <br>
            <br>
            <input type="submit" name="reboot" value="<?php echo $lang['U3']; ?>" class="btn btn-secondary"
                style="margin-left:380px;width: 105px;height: 40px;background-color: lightcoral;"></td>
        </div>
    </form>
</body>

</html>