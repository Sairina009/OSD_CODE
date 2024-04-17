<ul class="nav nav-tabs" style="margin-left: 70px; margin-top: -840px;">
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/kvmname.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="kvmname.php"><?php echo $lang['B1']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/time.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="time.php"><?php echo $lang['B2']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/lang.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="lang.php"><?php echo $lang['B3']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/hotkey.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="hotkey.php"><?php echo $lang['B4']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/thumbnailview.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="thumbnailview.php"><?php echo $lang['B5']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/banner.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="banner.php"><?php echo $lang['B6']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/encryption.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="encryption.php"><?php echo $lang['B7']; ?></a>
    </li>
</ul>

<style>
.nav-tabs .active a {
    color: black;
    background: white;
    
}
</style>