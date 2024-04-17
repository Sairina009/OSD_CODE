<ul class="nav nav-tabs" style="margin-left: 70px; margin-top: -840px;">
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/kvmupgrade.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="kvmupgrade.php"><?php echo $lang['U1']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/dongleupgrade.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="dongleupgrade.php" style="width:auto;"><?php echo $lang['U2']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/reboot.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="reboot.php"><?php echo $lang['U3']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/upgradehistory.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="upgradehistory.php" style="width:auto;"><?php echo $lang['U4']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/auditlog.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="auditlog.php"><?php echo $lang['U5']; ?></a>
    </li>
</ul>

<style>
.nav-tabs .active a {
    color: black;
    background: white;
    
}
</style>