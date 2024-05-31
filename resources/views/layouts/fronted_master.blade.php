<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$profile->company_name}}@yield("title")</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($profile->navicon != null ? $profile->navicon : 'noImage.jpg')}}" />
    @include("layouts.frontend.style")

</head>

<body>
    <!-- Container -->
	<div id="container">
        
    <!-- Header  Start -->
    @include("layouts.frontend.navbar")
    <!-- Header  End -->
    <main>
        @yield("content")
    </main>


    <!-- footer -->
		<footer>
			<div class="container">
				<div class="up-footer">
					<div class="row">
						<div class="col-lg-5 col-md-5">
							<div class="row">
								<div class="col-lg-5 col-md-6">
									<div class="footer-widget about-widget">
										<h1>About ETHICS</h1>
										<ul class="list">
											<li>
												<h2><a href="{{ route('about.organizational.overview') }}">Organizational Overview</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('about.ethics.work') }}">How Ethics&#174; Works</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('about.guiding.principle') }}">Six GUIDING Priciple of Ethics&#174;</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('testimonial.write') }}">Write a testimonial for ETHICS&#174;</a></h2>
											</li>
										</ul>
										
									</div>
								</div>
								<div class="col-lg-7 col-md-6">
									<div class="footer-widget membership-widget">
										<h1>Membership</h1>
										<ul class="list">
											<li>
												<h2><a href="{{ route('membership.become.member') }}">Become a Member</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.join.ethics') }}">Why Join Ethics&#174;</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.membership.application') }}">Membership application form</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.ethics.countries') }}">List of countries for ETHICS&#174; free</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.membership.directory') }}">Members directory</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.membership.cancellation') }}">Membership cancellation</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.membership.fee') }}">Membership Fee Structure</a></h2>
											</li>
											<li>
												<h2><a href="{{ route('membership.member.responsibilities') }}">Duties and Responsibilities of ETHICS&#174; Members</a></h2>
											</li>
											<li>
												<h2><a href="http://localhost/flarum/public/" target="_blank">Membership Forum</a></h2>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-7 col-md-7">
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<div class="footer-widget code-widget">
										<h1>ETHICS&#174; Code</h1>
										<ul class="list">
											<li>
												<h2><a href="{{ route('membership.publisher') }}">Ethics Code for Publishers</a></h2>
											</li>
										</ul>
									</div>
									<div class="footer-widget privacy-widget">
										<h1>Policies</h1>
										<ul class="list">
											<li>
												<h2><a href="{{ route('membership.publisher') }}">Privacy</a></h2>
											</li>
											<li>
												<h2><a href="">Statement of Disclaimer</a></h2>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-4 col-md-4">
									<div class="footer-widget miscellaneous-widget">
										<h1>Miscellaneous</h1>
										<ul class="list">
											<li>
												<h2><a href="">Collaborate with ETHICS&#174;</a></h2>
											</li>
											<li>
												<h2><a href="">Join as a Reviewer</a></h2>
											</li>
											<li>
												<h2><a href="">Work with ETHICS&#174;</a></h2>
											</li>
											<li>
												<h2><a href="">Write for ETHICS&#174;</a></h2>
											</li>
											<li>
												<h2><a href="">Recommend ETHICS&#174; to a Publisher/Journal</a></h2>
											</li>
											<li>
												<h2><a href="">Subcribe to the Monthly ETHICS</a></h2>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-4 col-md-4">
									<div class="footer-widget complaint-widget">
										<h1>Complaint</h1>
										<ul class="list">
											<li>
												<h2><a href="">Submit a Complaint</a></h2>
											</li>
											<li>
												<h2><a href="">Complaint Handling Policy</a></h2>
											</li>
											
										</ul>
									</div>

									<div class="footer-widget complaint-widget">
										<h1>Contact Us</h1>
										<ul class="list">
											<li>
												<h2><a href="">Write to Us</a></h2>
											</li>
											<li>
												<h2><a href="">Find ETHICS&#174; on Social Media</a></h2>
											</li>
											<li>
												<h2><a href="">FAQs</a></h2>
											</li>
											
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="down-footer">
					<ul class="social-icons">
						<li><a class="facebook" href="#" style="background-color: #4b69b1;"><i class="fa fa-facebook"></i></a></li>
						<li><a class="instagram" href="#" style="background-color: #c7345e;"><i class="fa fa-instagram"></i></a></li>
						<li><a class="twitter" href="#" style="background-color: #e2403c;"><i class="fa fa-youtube"></i></a></li>
						<li><a class="twitter" href="#" style="background-color: #37b1e2;"><i class="fa fa-twitter"></i></a></li>
						<li><a class="google" href="#" style="background-color: #e73e39;"><i class="fa fa-google-plus"></i></a></li>
						<li><a class="linkedin" href="#" style="background-color: #0678b5;"><i class="fa fa-linkedin"></i></a></li>
					</ul>
					
					<p> Copyright &copy; 2024 ETHICS&#174;. All Right Reserved.</p>
				</div>

			</div>
		</footer>
	<!-- End footer -->

    <!-- Modals -->
    <!-- quick view modal -->

   <!-- Login Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	        <div class="title-section">
	        	<h1>Login</h1>
	        </div>
			<form id="login-form">
				<p>Welcome! Login to your account.</p>
				<label for="username">Username or Email Address*</label>
				<input id="username" name="username" type="text">
				<label for="password">Password*</label>
				<input id="password" name="password" type="password">
				<button type="submit" id="submit-register">
					<i class="fa fa-paper-plane"></i> Login
				</button>
			</form>
	      	<p>Don't have account? <a href="">Register Here</a></p>

	      </div>
	    </div>
	  </div>
	</div>
	<!-- End Login Modal -->

    @include("layouts.frontend.script")
</body>

</html>