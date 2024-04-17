<ul class="nav nav-tabs" style="margin-left: 70px; margin-top: -840px;">
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/portname.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="portname.php"><?php echo $lang['G2']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/macadd.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="macadd.php"><?php echo $lang['I1']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/audio.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="audio.php"><?php echo $lang['I3']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/resolution.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="resolution.php"><?php echo $lang['I8']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/framerate.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="framerate.php"><?php echo $lang['I10']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/linktype.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="linktype.php"><?php echo $lang['I4']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/virtualmedia.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="virtualmedia.php"><?php echo $lang['I5']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/portenable.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="portenable.php"><?php echo $lang['I6']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/scan.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="scan.php"><?php echo $lang['G1']; ?></a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/portauthority.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="portauthority.php"><?php echo $lang['I7']; ?></a>
    </li>
</ul>

<style>
.nav-tabs .nav-item.active a {
    color: black;
    background: white;
}
</style>
