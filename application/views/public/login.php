<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>


	<!------ Include the above in your HEAD tag ---------->
	<!-- Include the above in your HEAD tag -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<style>
	@charset "utf-8";
	@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css);

	:root {
		--primary-color: #0264d6;
		--secondary-color: #1c2b5a;
	}

	div.main {
		background: var(--primary-color, #0264d6);
		/* Old browsers */
		background: -moz-radial-gradient(center, ellipse cover, var(--primary-color, #0264d6) 1%, var(--secondary-color, #1c2b5a) 100%);
		/* FF3.6+ */
		background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%, var(--primary-color, #0264d6)), color-stop(100%, var(--secondary-color, #1c2b5a)));
		/* Chrome,Safari4+ */
		background: -webkit-radial-gradient(center, ellipse cover, var(--primary-color, #0264d6) 1%, var(--secondary-color, #1c2b5a) 100%);
		/* Chrome10+,Safari5.1+ */
		background: -o-radial-gradient(center, ellipse cover, var(--primary-color, #0264d6) 1%, var(--secondary-color, #1c2b5a) 100%);
		/* Opera 12+ */
		background: -ms-radial-gradient(center, ellipse cover, var(--primary-color, #0264d6) 1%, var(--secondary-color, #1c2b5a) 100%);
		/* IE10+ */
		background: radial-gradient(ellipse at center, var(--primary-color, #0264d6) 1%, var(--secondary-color, #1c2b5a) 100%);
		/* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary-color, #0264d6), endColorstr=var(--secondary-color, #1c2b5a), GradientType=1);
		/* IE6-9 fallback on horizontal gradient */
		height: calc(100vh);
		width: 100%;
	}

	[class*="fontawesome-"]:before {
		font-family: 'FontAwesome', sans-serif;
	}

	/* ---------- GENERAL ---------- */

	* {
		box-sizing: border-box;
		margin: 0px auto;

		&:before,
		&:after {
			box-sizing: border-box;
		}

	}

	body {

		color: #606468;
		font: 87.5%/1.5em 'Open Sans', sans-serif;
		margin: 0;
	}

	a {
		color: #eee;
		text-decoration: none;
	}

	a:hover {
		text-decoration: underline;
	}

	input {
		border: none;
		font-family: 'Open Sans', Arial, sans-serif;
		font-size: 14px;
		line-height: 1.5em;
		padding: 0;
		-webkit-appearance: none;
		appearance: none;
	}

	p {
		line-height: 1.5em;
	}

	zoom: 1;
	*zoom: 1;

	&:before,
	&:after {
		content: ' ';
		display: table;
	}

	&:after {
		clear: both;
	}



	.container {
		left: 50%;
		position: fixed;
		top: 50%;
		transform: translate(-50%, -50%);
	}

	/* ---------- LOGIN ---------- */

	#login form {
		width: 250px;
	}

	#login,
	.logo {
		display: inline-block;
		width: 40%;
	}

	#login {
		border-right: 1px solid #fff;
		padding: 0px 22px;
		width: 59%;
	}

	.logo {
		color: #fff;
		font-size: 50px;
		line-height: 125px;
	}

	#login form span.fa {
		background-color: #fff;
		border-radius: 3px 0px 0px 3px;
		color: #000;
		display: block;
		float: left;
		height: 50px;
		font-size: 24px;
		line-height: 50px;
		text-align: center;
		width: 50px;
	}

	#login form input {
		height: 50px;
	}

	fieldset {
		padding: 0;
		border: 0;
		margin: 0;

	}

	#login form input[type="text"],
	input[type="password"] {
		background-color: #fff;
		border-radius: 0px 3px 3px 0px;
		color: #000;
		margin-bottom: 1em;
		padding: 0 16px;
		width: 200px;
	}

	#login form input[type="submit"] {
		border-radius: 3px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		background-color: #000000;
		color: #eee;
		font-weight: bold;
		/* margin-bottom: 2em; */
		text-transform: uppercase;
		padding: 5px 10px;
		height: 30px;
	}

	#login form input[type="submit"]:hover {
		background-color: #d44179;
	}

	#login>p {
		text-align: center;
	}

	#login>p span {
		padding-left: 5px;
	}

	.middle {
		display: flex;
		width: 600px;
	}
</style>

<body>

	<div class="main">
		<div class="container">
			<center>
				<div class="middle">
					<div id="login">

						<form id="loginForm" action="javascript:void(0);" method="get">

							<fieldset class="clearfix">

								<p><span class="fa fa-user"></span><input name="username" id="username" type="text" Placeholder="Username" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
								<p><span class="fa fa-lock"></span><input name="password" id="password" type="password" Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->

								<div>
									<span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Forgot
											password?</a></span>
									<span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Sign In"></span>
								</div>

							</fieldset>
							<div class="clearfix"></div>
						</form>

						<div class="clearfix"></div>

					</div> <!-- end login -->
					<div class="logo">
						<img width="175" id="logoImage" class="img-fluid" src="" alt="">
						<h2 id="logo">LOGO</h2>
						<div class="clearfix"></div>
					</div>

				</div>
			</center>
		</div>

	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> <!-- SweetAlert JS -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$(document).ready(function() {

			$.ajax({
				url: "/home/set_home_config", // Your API endpoint here
				method: "GET",
				success: function(response) {
					const parsedResponse = JSON.parse(response);

					// Since the response is an array, access the first element
					if (parsedResponse.length > 0) {
						const config = parsedResponse[0]; // Access the first object in the array
						const color1 = config.color_1;
						const color2 = config.color_2;

						if (color1 && color2) {
							$(":root").css("--primary-color", color1);
							// $(":root").css("--secondary-color", color2);
							// console.log("Colors applied:", color1, color2);
						} else {
							console.error("Color values not found in the response.");
						}

						$('#logoImage').attr('src', '<?php echo base_url('/assets/images/logo/'); ?>' + config.logo);
						$('#logo').text(config.config_profile_name);
						$('#url_alamat').attr('href', config.url_alamat).text(config.alamat);
						$('#url_kontak').attr('href', config.url_kontak).text(config.kontak);
						$('#url_email').attr('href', config.url_email).text(config.email);
					} else {
						console.error("Empty response array.");
					}
				},
				error: function(error) {
					console.error("Error fetching color:", error);
				},
			});




			$('#loginForm').on('submit', function(e) {
				e.preventDefault(); // Prevent the default form submission

				$.ajax({
					url: '<?php echo site_url('auth/login'); ?>',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'json', // Ensure the response is parsed as JSON
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: 'Login successful!'
							}).then(function() {
								window.location.href = response.redirect_url;
							});
						} else if (response.status === 'not_approved') {
							Swal.fire({
								icon: 'warning',
								title: 'Not Approved',
								text: 'Akun anda belum ter-"Approve", Silahkan menghubungi admin untuk dilakukan approval'
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: response.message || 'Invalid username or password. Please try again.'
							});
						}
					},
					error: function() {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Login failed. Please try again.'
						});
					}
				});
			});

		});
	</script>
</body>

</html>