<?php
$pageTitle = "Login";
//get the configuration for the local server
require_once("starter/header.php");

include(ROOT_PATH . 'inc/loginHeader.php');


$countries = select_all_asc('country');

?>


<div class="sign-in-page">
	<div class="signin-popup">
		<div class="signin-pop">
			<div class="row">
				<div class="col-lg-6">
					<div class="cmp-info">
						<div class="cm-logo">
							<img src="<?php echo BASE_URL; ?>assets/images/cm-logo.png" alt="">
							<p>Workwise, is a global freelancing platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
						</div>
						<!--cm-logo end-->
						<img src="<?php echo BASE_URL; ?>assets/images/cm-main-img.png" alt="">
					</div>
					<!--cmp-info end-->
				</div>
				<div class="col-lg-6">
					<div class="login-sec">
						<ul class="sign-control">
							<li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>
							<li data-tab="tab-2"><a href="#" title="">Sign up</a></li>
						</ul>
						<div class="sign_in_sec current" id="tab-1">

							<h3>Sign in</h3>
							<span class="errorMessage">
							</span>
							<form id="userLoginDetail">
								<div class="row">
									<div class="col-lg-12 no-pdd">
										<div class="sn-field">
											<input type="email" id="username" name="username" placeholder="Username">
											<i class="la la-user"></i>
										</div>
										<!--sn-field end-->
									</div>
									<div class="col-lg-12 no-pdd">
										<div class="sn-field">
											<input type="password" id="password" name="password" placeholder="Password">
											<i class="la la-lock"></i>
										</div>
									</div>
									<div class="col-lg-12 no-pdd">
										<button id="loginUserjs">Sign in</button>
									</div>
								</div>
							</form>
						</div>
						<!--sign_in_sec end-->
						<div class="sign_in_sec" id="tab-2">
							<div class="dff-tab current" id="tab-3">
								<h3>Sign Up</h3>
								<span id="error2"></span>
								<form id="userSignUpDetail">
									<div class="row">
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<input type="text" name="firstName" id="firstName" placeholder="First Name">
												<i class="la la-user"></i>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<input type="text" name="lastName" id="lastName" placeholder="Last Name">
												<i class="la la-user"></i>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<input type="email" name="email" id="email" placeholder="Email Address">
												<i class="la la-at"></i>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<select name="country" id="country">
													<option value="">Select Country</option>
													<?php foreach ($countries as $country) { ?>
														<option value="<?php echo $country['id'] ?>"><?php echo $country['nicename'] ?></option>
													<?php } ?>
												</select>
												<i class="la la-globe"></i>
												<span><i class="fa fa-ellipsis-h"></i></span>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<input type="number" name="phoneNumber" id="phoneNumber" placeholder="Mobile Number">
												<i class="la la-phone"></i>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<input type="password" name="newpassword" id="newpassword" placeholder="Password">
												<i class="la la-lock"></i>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<div class="sn-field">
												<input type="password" name="confirmPassword" id="confirmPassword" placeholder="Repeat Password">
												<i class="la la-lock"></i>
											</div>
										</div>
										<div class="col-lg-12 no-pdd">
											<button id="signUpUserJs" value="submit">Get Started</button>
										</div>
									</div>
								</form>
							</div>
							<!--dff-tab end-->
						</div>
					</div>
					<!--login-sec end-->
				</div>
			</div>
		</div>
		<!--signin-pop end-->
	</div>
	<!--signin-popup end-->
	<div class="footy-sec">
		<div class="container">
			<p><img src="<?php echo BASE_URL; ?>assets/images/copy-icon.png" alt="">Copyright 2019</p>
		</div>
	</div>
	<!--footy-sec end-->
</div>
<!--sign-in-page end-->
<!--sign-in-page end-->
<script src="<?php echo BASE_URL; ?>services/ajax/login.js"></script>