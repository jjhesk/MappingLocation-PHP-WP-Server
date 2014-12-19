<div class="nav-collapse collapse" id="main-menu">
    <div class="menu-left-menu-container">
        <ul id="menu-left-menu" class="nav">
            <li id="approve_cp" class="nav_left_settings menu-item menu-item-type-custom menu-item-object-custom menu-item-97 menu-item-settings last-menu-item">
                <a href="#"><span class="text">New CP</span><span class="badge badge-important"></span></a>
            </li>
             <li id="approve_com" class="nav_left_settings menu-item menu-item-type-custom menu-item-object-custom menu-item-97 menu-item-settings last-menu-item">
                <a href="#"><span class="text">New Company</span><span class="badge badge-important"></span></a>
            </li>
            <li id="view_pending" class="nav_left_home menu-item menu-item-type-post_type menu-item-object-page menu-item-93 menu-item-home first-menu-item">
                <a href="#"><span class="text">View New Orders</span> <span class="badge badge-important"></span> </a>
            </li>
            <li id="view_project" class="nav_left_project menu-item menu-item-type-post_type menu-item-object-page menu-item-92 menu-item-project ">
                <a href="#"><span class="text">Job Broadcast</span> <span class="badge badge-important"></span></a>
            </li>
            <li id="view_job" class="nav_left_settings menu-item menu-item-type-custom menu-item-object-custom menu-item-97 menu-item-settings last-menu-item">
                <a href="#"><span class="text">Job Records</span> <span class="badge badge-important"></span></a>
            </li>
            <li id="view_library" class="dropdown nav_left_settings menu-item menu-item-type-custom menu-item-object-custom menu-item-97 menu-item-settings last-menu-item">
                <a data-toggle="dropdown" ><img style="width: 50px;" src="<?php echo HKM_IMG_PATH."buttons/wheel.png";?>"/></a>
                <ul class="dropdown-menu settings">
                    <?php echo ocmodel::get_tpl('menu', 'settingpart'); ?>
                </ul>
            </li>
        </ul>
    </div>
</div>