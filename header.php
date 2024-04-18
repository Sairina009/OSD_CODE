
<?php  
session_start(); 

// Include language file
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
require_once($language . '.php');

$tabs = array();
$is_admin = ($_SESSION['authority'] == 'Admin');
$view = $_SESSION['view'] ?? '';

// Define tabs based on user role
if ($is_admin) {
    // Tabs for admin
    $tabs = array(
     array(
    'url' => ($view == 'ON') ? 'demo.php' : 'user.php',
    'text' => $lang['H2'],
    'active' => (($view == 'ON' && $_SERVER['PHP_SELF'] == '/od/demo.php') || ($view != 'ON' && $_SERVER['PHP_SELF'] == '/od/user.php'))
),
        array('url' => 'portname.php', 'text' => $lang['H3'], 'active' => ($_SERVER['PHP_SELF'] == '/od/portname.php' || $_SERVER['PHP_SELF'] == '/od/macadd.php' || $_SERVER['PHP_SELF'] == '/od/audio.php' || $_SERVER['PHP_SELF'] == '/od/resolution.php' || $_SERVER['PHP_SELF'] == '/od/framerate.php' || $_SERVER['PHP_SELF'] == '/od/linktype.php' || $_SERVER['PHP_SELF'] == '/od/virtualmedia.php' || $_SERVER['PHP_SELF'] == '/od/portenable.php' || $_SERVER['PHP_SELF'] == '/od/scan.php' || $_SERVER['PHP_SELF'] == '/od/portauthority.php')),
        array('url' => 'username.php', 'text' => $lang['H4'], 'active' => ($_SERVER['PHP_SELF'] == '/od/username.php' || $_SERVER['PHP_SELF'] == '/od/userenable.php' || $_SERVER['PHP_SELF'] == '/od/use.raut.php' || $_SERVER['PHP_SELF'] == '/od/userpass.php' || $_SERVER['PHP_SELF'] == '/od/function.php' )),
        array('url' => 'kvmname.php', 'text' => $lang['H5'], 'active' => ($_SERVER['PHP_SELF'] == '/od/kvmname.php' || $_SERVER['PHP_SELF'] == '/od/time.php' || $_SERVER['PHP_SELF'] == '/od/lang.php' || $_SERVER['PHP_SELF'] == '/od/hotkey.php' || $_SERVER['PHP_SELF'] == '/od/thumbnailview.php' || $_SERVER['PHP_SELF'] == '/od/banner.php' || $_SERVER['PHP_SELF'] == '/od/encryption.php' )),
        array('url' => 'kvmupgrade.php', 'text' => $lang['H6'], 'active' => ($_SERVER['PHP_SELF'] == '/od/kvmupgrade.php' || $_SERVER['PHP_SELF'] == '/od/dongleupgrade.php' || $_SERVER['PHP_SELF'] == '/od/reboot.php' || $_SERVER['PHP_SELF'] == '/od/upgradehistory.php' || $_SERVER['PHP_SELF'] == '/od/auditlog.php' )),
        array('url' => 'help.php', 'text' => $lang['H7'], 'active' => ($_SERVER['PHP_SELF'] == '/od/help.php'))
    );
} else {
    // Tabs for regular user
    $tabs = array(
          array(
    'url' => ($view == 'ON') ? 'demo.php' : 'user.php',
    'text' => $lang['H2'],
    'active' => (($view == 'ON' && $_SERVER['PHP_SELF'] == '/od/demo.php') || ($view != 'ON' && $_SERVER['PHP_SELF'] == '/od/user.php'))
),

        array('url' => 'help.php', 'text' => $lang['H7'], 'active' => ($_SERVER['PHP_SELF'] == '/od/help.php'))
    );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
    <link rel="stylesheet" href="css/usercss/bootstrap-grid.css">
    <link rel="stylesheet" href="css/usercss/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/usercss/bootstrap.css">
    <link rel="stylesheet" href="css/usercss/bootstrap.min.css">
    <link rel="stylesheet" href="css/usercss/bootstrap-grid.css.map">
    <link rel="stylesheet" href="css/usercss/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="css/usercss/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="css/usercss/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="css/usercss/bootstrap.css.map">
    <link rel="stylesheet" href="css/usercss/bootstrap.min.css.map">

    <style>
        /* Your existing CSS styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .header {
            background-color: floralwhite;
            font-size: medium;
            padding: 10px; /* Added padding for spacing */
        }

        .nav-tabs .nav-link {
            border: 2px solid darkgreen;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            height: 45px;
            text-align: center;
            margin-left: 2px;
            width: 170px;
            font-size: medium;
        }

        .nav-link {
            display: block;
            padding: 0.5rem 1rem;
            background-color: gainsboro;
        }

        /* Adjustments for responsiveness */
        @media only screen and (max-width: 768px) {
            /* Adjustments for smaller screens */
            .nav-tabs .nav-link {
                width: 120px;
            }
        }

        /* New styles for responsiveness */
        @media only screen and (max-width: 1200px) {
            /* Adjustments for medium-sized screens */
            .container-fluid {
                width: 90%; /* Adjust the container width for medium-sized screens */
                margin: auto; /* Center the container horizontally */
            }
        }
        .nav-tabs .active a {
    color: black;
    background: white;
    
}
    </style>
</head>
<body>
    <header class="header" style="background-color: floralwhite;font-size: medium;">
        <?php require_once 'DBConnection.php'; $fetchdata=new DB_con(); $sql=$fetchdata->kvmdata(); $row=mysqli_fetch_array($sql); 
        if ($row['hotkey'] == '< Caps Lock>') {
            include 'caps.html';
        } elseif($row['hotkey'] == '< Ctrl>'){
            include 'key.html';
        }
        else{
            echo '';
        }
        ?>
    <div class="container-fluid"
        style="margin-top: 10px;margin-left: 5px;border:2px solid black;padding: 2px;height: 1060px;width: 1900px;">
        <span style="background-color:whitesmoke;">&nbsp;<?php echo $lang['H1']; ?></span>
        <div class="container-fluid"
            style="word-spacing: 3px;width: -2px;padding-left: 43px;color: revert;font-size: 27px;font-family: monospace;margin-top: -19px;">
            <h2><span style="background-color: lightgreen;font-size: 30px;font-family: times new roman;">
                    <?php echo $row['time']; ?></span>
                <label style="margin-left: 300px;">
                    <h1> <span style="background-color: lightpink;font-size: 55px; width: 200px;"> <?php echo $row['kvmname']; ?></span>
                    </h1>
                </label>
                <label
                    style="margin-left: 150px;font-size: 25px;word-spacing: -14px;width: auto;"><?php echo $lang['H8']; ?>:</label><input
                    type="text" value="<?php echo $_SESSION['username']; ?> "
                    style="background-color: lightgreen;width: 220px;text-align: center;">
                <a href="Actions_audit.php?a=logout" class="btn btn-primary" value="<?php echo $lang['B11']; ?>" name="save"
                    style="width: auto;margin-left: 160px;background-color:skyblue;height:4%;"> <?php echo $lang['H10']; ?></a>
                <h4><label style="margin-left: 1220px;word-spacing: -8px;"><?php echo $lang['H9']; ?> :<?php echo $row['hotkey']; ?>
                    </label></h4>
            </h2>
        </div>
 <ul class="nav nav-tabs" style="width: 1700px; height: 902px; overflow: hidden; margin-left: 25px;">
            <?php foreach ($tabs as $tab): ?>
                <li class="nav-item <?php echo ($tab['active'] ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo $tab['url']; ?>"><?php echo $tab['text']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div
            style="border:1px solid black;padding: 2px;height: 853px;margin-top: -847px;width: 1870px;margin-left: 22px;">
        </div>
    </div>
</header>
</head>
</html>
