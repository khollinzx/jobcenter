<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="<?php echo BASE_URL; ?>users/?pg=home" title=""><img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt=""></a>
            </div>
            <!--logo end-->
            <!--search-bar end-->
            <nav>
                <ul>
                    <li>
                        <a href="<?php echo BASE_URL; ?>users/?pg=home" title="">
                            <span><img src="<?php echo BASE_URL; ?>assets/images/icon1.png" alt=""></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" title="">
                            <span><img src="<?php echo BASE_URL; ?>assets/images/icon2.png" alt=""></span>
                            Companies
                        </a>
                        <ul>
                            <li><a href="#" title="">Companies</a></li>
                            <li><a href="company-profile.html" title="">Company Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" title="">
                            <span><img src="<?php echo BASE_URL; ?>assets/images/icon3.png" alt=""></span>
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="#" title="">
                            <span><img src="<?php echo BASE_URL; ?>assets/images/icon4.png" alt=""></span>
                            Profiles
                        </a>
                        <ul>
                            <li><a href="#" title="">User Profile</a></li>
                            <li><a href="#" title="">my-profile-feed</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" title="">
                            <span><img src="<?php echo BASE_URL; ?>assets/images/icon5.png" alt=""></span>
                            Jobs
                        </a>
                    </li>
                </ul>
            </nav>
            <!--nav end-->
            <div class="menu-btn">
                <a href="#" title=""><i class="fa fa-bars"></i></a>
            </div>
            <!--menu-btn end-->
            <div class="user-account">
                <div class="user-info">
                    <img src="<?php echo BASE_URL . "uploads/images/" . selectField2("users_details", "image", "user_id", $_SESSION["user_details"]->id); ?>" height="30" width="30" alt="">
                    <a href=" #" title=""><?php echo selectField2("users_details", "firstName", "user_id", $_SESSION["user_details"]->id); ?></a>
                    <i class="la la-sort-down"></i>
                </div>
                <div class="user-account-settingss">
                    <!--search_form end-->
                    <h3>Setting</h3>
                    <ul class="us-links">
                        <li><a href="<?php echo BASE_URL; ?>users/?pg=settings" title="">Account Setting</a></li>
                        <li> <a href="#" class="logout">Logout</a></li>
                    </ul>

                </div>
                <!--user-account-settingss end-->
            </div>
        </div>
        <!--header-data end-->
    </div>
</header>
<!--header end-->
<script src="<?php echo BASE_URL; ?>services/ajax/logout.js"></script>