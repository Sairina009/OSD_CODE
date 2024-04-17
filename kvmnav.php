<ul class="nav nav-tabs" style="margin-left: 70px; margin-top: -853px;">
   <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/username.php') ? 'active' : ''; ?>">
    <a class="nav-link" href="username.php"><?php echo $lang['H8']; ?></a>
</li>
<li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/userenable.php') ? 'active' : ''; ?>">
    <a class="nav-link" href="userenable.php"><?php echo $lang['F1']; ?></a>
</li>
<li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/useraut.php') ? 'active' : ''; ?>">
    <a class="nav-link" href="useraut.php" style="width: 210px;"><?php echo $lang['F2']; ?></a>
</li>
<li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/userpass.php') ? 'active' : ''; ?>">
    <a class="nav-link" href="userpass.php" style="width: auto"><?php echo $lang['F3']; ?></a>
</li>
<li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/od/function.php') ? 'active' : ''; ?>">
    <a class="nav-link" href="function.php"><?php echo $lang['F4']; ?></a>
</li>
</ul>

<style>
.nav-tabs .active a {
    color: black;
    background: white;
    
}
</style>