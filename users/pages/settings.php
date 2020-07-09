<?php
$countries = select_all_asc('country');
$residentState = selectField2("users_details", "country", "user_id", $_SESSION["user_details"]->id);

?>
<section class="profile-account-setting">
    <div class="container">
        <div class="account-tabs-setting">
            <div class="row">
                <div class="col-lg-3">
                    <div class="acc-leftbar">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-cogs"></i>Profile Details</a>
                            <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Change Password</a>
                            <a class="nav-item nav-link deactiveAccount" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>Deactivate Account</a>
                        </div>
                    </div>
                    <!--acc-leftbar end-->
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
                            <div class="acc-setting">
                                <h3>Profile Details</h3>
                                <form id="profileDetails">
                                    <div class="cp-field">
                                        <span id="error2"></span>
                                    </div>
                                    <div class="cp-field">
                                        <h5>First Name</h5>
                                        <div class="cpp-fiel">
                                            <input type="text" name="firstName" id="firstName" value="<?php echo selectField2("users_details", "firstName", "user_id", $_SESSION["user_details"]->id); ?>">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>Last Name</h5>
                                        <div class="cpp-fiel">
                                            <input type="text" name="lastName" id="lastName" value="<?php echo selectField2("users_details", "lastName", "user_id", $_SESSION["user_details"]->id); ?>">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>Mobile Number</h5>
                                        <div class="cpp-fiel">
                                            <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo selectField2("users_details", "phoneNumber", "user_id", $_SESSION["user_details"]->id); ?>">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>Country</h5>
                                        <div class="cpp-fiel">
                                            <select name="country" id="country">
                                                <option value="">Select Country</option>
                                                <?php foreach ($countries as $country) { ?>
                                                    <option value="<?php echo $country['id'] ?>" <?php if ($country['id'] ==  $residentState) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $country['nicename'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <i class="la la-globe"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>Facebook Handle</h5>
                                        <div class="cpp-fiel">
                                            <input type="text" name="facebook_link" id="facebook_link" value="<?php echo selectField2("users_details", "facebook_link", "user_id", $_SESSION["user_details"]->id); ?>">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>Twitter Handle</h5>
                                        <div class="cpp-fiel">
                                            <input type="text" name="twitter_link" id="twitter_link" value="<?php echo selectField2("users_details", "twitter_link", "user_id", $_SESSION["user_details"]->id); ?>">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                    </div>
                                    <div class="save-stngs pd2">
                                    </div>
                                    <!--save-stngs end-->
                                </form>
                                <div class="pro-work-status pb-2">
                                    <button id="updateSettings" class="btn btn-light btnup">Save Update</button>
                                </div>
                                <!--pro-work-status end-->
                            </div>
                            <!--acc-setting end-->
                        </div>
                        <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                            <div class="acc-setting">
                                <h3>Change Password</h3>
                                <form id="passwordDetails">


                                    <div class="cp-field">
                                        <span id="error"></span>
                                    </div>

                                    <div class="cp-field">
                                        <h5>Old Password</h5>
                                        <div class="cpp-fiel">
                                            <input type="password" name="oldPassword" id="oldPassword" value="Old Password">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>New Password</h5>
                                        <div class="cpp-fiel">
                                            <input type="password" name="newPassword" id="newPassword" value="New Password">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                    <div class="cp-field">
                                        <h5>Repeat Password</h5>
                                        <div class="cpp-fiel">
                                            <input type="password" name="repeatPassword" name="repeatPassword" value="Repeat Password">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>

                                    <div class="save-stngs pd2">
                                    </div>
                                    <!--save-stngs end-->
                                </form>

                                <div class="pro-work-status pb-2">
                                    <button id="changePassword" class="btn btn-light btnup">Change Password</button>
                                </div>
                            </div>
                            <!--acc-setting end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--account-tabs-setting end-->
    </div>
</section>


<script src="<?php echo BASE_URL; ?>services/ajax/updateProfiles.js"></script>