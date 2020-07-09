<?php

$variables = fetchFields("users_details", "facebook_link, twitter_link, phoneNumber, image", "user_id", $_SESSION["user_details"]->id);

foreach ($variables as $variable) {
    $facebook_link = $variable["facebook_link"];
    $twitter_link = $variable["twitter_link"];
    $phoneNumber = $variable["phoneNumber"];
    $image = $variable["image"];
}

?>

<section class="cover-sec">
    <img src="<?php echo BASE_URL; ?>assets/images/resources/cover-img.jpg" alt="">
</section>


<main>
    <div class="main-section">
        <div class="container">
            <div class="main-section-data">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="main-left-sidebar">
                            <div class="user_profile">
                                <div class="user-pro-img">
                                    <img src="<?php echo BASE_URL . "uploads/images/" . $image ?>" width="200" height="200" alt="">
                                    <div class="add-dp" id="OpenImgUpload">
                                        <input type="file" id="img_file" name="img_file">
                                        <label for="img_file"><i class="fas fa-camera"></i></label>

                                    </div>
                                    <div id="msg" class="pf-gallery">

                                    </div>
                                </div>
                                <!--user-pro-img end-->
                                <ul class="social_links">

                                    <?php if ($phoneNumber != "") { ?>
                                        <li><a href="#" title=""><i class="fa fa-phone"></i> <?php echo $phoneNumber; ?></a></li>
                                    <?php } ?>
                                    <?php if ($facebook_link != "") { ?>
                                        <li><a href="https://www.facebook.com/<?php echo $facebook_link; ?>" title=""><i class="fa fa-facebook-square"></i> <?php echo $facebook_link; ?></a></li>
                                    <?php } ?>
                                    <?php if ($twitter_link != "") { ?>
                                        <li><a href="https://www.twitter.com/<?php echo $twitter_link; ?>" title=""><i class="fa fa-twitter"></i> <?php echo $twitter_link; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!--user_profile end-->
                        </div>
                        <!--main-left-sidebar end-->
                    </div>
                    <div class="col-lg-6">
                        <div class="main-ws-sec">
                            <div class="user-tab-sec rewivew">
                                <h3><?php echo selectField2("users_details", "firstName", "user_id", $_SESSION["user_details"]->id) . " " . selectField2("users_details", "lastName", "user_id", $_SESSION["user_details"]->id); ?></h3>
                            </div>
                            <!--user-tab-sec end-->
                            <div class="product-feed-tab current" id="feed-dd">
                                <div class="posts-section">
                                    <div class="post-bar">
                                        <div class="post_topbar">
                                            <div class="usy-dt">
                                                <img src="images/resources/us-pic.png" alt="">
                                                <div class="usy-name">
                                                    <h3><?php echo selectField2("users_details", "firstName", "user_id", $_SESSION["user_details"]->id) . " " . selectField2("users_details", "lastName", "user_id", $_SESSION["user_details"]->id); ?></h3>
                                                    <span><img src="images/clock.png" alt="">3 min ago</span>
                                                </div>
                                                <div class="job_descp">
                                                    <h3>Senior Wordpress Developer</h3>
                                                    <ul class="job-dt">
                                                        <li><a href="#" title="">Full Time</a></li>
                                                        <li><span>$30 / hr</span></li>
                                                    </ul>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
                                                    <ul class="skill-tags">
                                                        <li><a href="#" title="">HTML</a></li>
                                                        <li><a href="#" title="">PHP</a></li>
                                                        <li><a href="#" title="">CSS</a></li>
                                                        <li><a href="#" title="">Javascript</a></li>
                                                        <li><a href="#" title="">Wordpress</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--post-bar end-->
                                </div>
                                <!--posts-section end-->
                            </div>
                            <!--product-feed-tab end-->
                        </div>
                        <!--main-ws-sec end-->
                    </div>

                    <div class="col-lg-3">
                        <div class="right-sidebar">
                            <div class="message-btn">
                                <a href="<?php echo BASE_URL; ?>users/?pg=settings" title=""><i class="fas fa-cog"></i> Setting</a>
                            </div>
                            <div class="widget widget-portfolio">
                                <div class="wd-heady">
                                    <h3>Portfolio</h3>
                                    <img src="images/photo-icon.png" alt="">
                                </div>
                                <div class="pf-gallery">
                                    <ul>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery1.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery2.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery3.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery4.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery5.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery6.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery7.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery8.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery9.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery10.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery11.png" alt=""></a></li>
                                        <li><a href="#" title=""><img src="<?php echo BASE_URL; ?>assets/images/resources/pf-gallery12.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <!--pf-gallery end-->
                            </div>
                            <!--widget-portfolio end-->
                        </div>
                        <!--right-sidebar end-->
                    </div>
                </div>
            </div><!-- main-section-data end-->
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>services/ajax/home.js"></script>