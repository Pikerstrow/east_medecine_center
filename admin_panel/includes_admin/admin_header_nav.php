<?php
use Clinic\Classes\Visitors\Admin;
$admin = Admin::getByParam("admin_login", $session->get("admin_login"));

?>

<header class="header">
    <nav>
        <div id="hamburger_menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="admin_panel_title">
            <span>Admin </span><span>Panel</span>
        </div>
        <div class="admin_profile">
            <ul class="nav navbar-nav admin-nav" role="menu">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown"><span class="user_avatar"><img alt="avatar" src="<?php echo $admin->admin_image ?>"></span> <span class="user_name"><?php echo isset($admin->admin_login) ? $admin->admin_login : "Unknown Admin" ?></span> <span class="caret" /></a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_profile.php" class="user-a"><i class="fas fa-user"></i>&nbsp; Профіль</a></li>
                        <li><a href="index.php?logout=true" class="user-a"><i class="fas fa-key"></i>&nbsp; Вийти</a></li>
                    </ul>
                </li>
                <li class="to-site"><a href="../index.php"><i class="fas fa-home fa-2x"></i> </a></li>
            </ul>
        </div>
    </nav>
</header>