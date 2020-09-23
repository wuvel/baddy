<?php
class User {
	public $user = '';
	public $pass = '';
}

function set_cookie($login) {
  $expire = time() + 7200;
  $cookie_auth = base64_encode(serialize($login));
  $cookie_check = base64_encode(md5($cookie_auth));
  unset($_COOKIE['auth']);
  unset($_COOKIE['check']);
  setcookie('auth', $cookie_auth, $expire, '/');
  setcookie('check', $cookie_check, $expire, '/');
}

function get_credentials() {
  $login=null;
  if (isset($_COOKIE['auth']) && isset($_COOKIE['check'])) {
    if(md5($_COOKIE['auth']) === base64_decode($_COOKIE['check'])) {
      $login = unserialize(base64_decode($_COOKIE['auth']));
    }
    else {
      
    }
  }
  elseif (isset($_POST['user'])) {
    $login=new User();
    $login->user=$_POST['user'];
    $login->pass=$_POST['pass'];
  }
  return $login;
}

if(isset($_GET['logout'])) {
	setcookie('auth', '', time()-7000000, '/');
  setcookie('check', '', time()-7000000, '/');
}
else {
	$login = new User();
	$login = get_credentials();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	
<?php
if (isset($login) && $login->user === "guest" && $login->pass == "guest") {
  set_cookie($login);
?>
<!-- User = guest -->
<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
<h3 style="text-align:center;">Guest account</br>Nothing here Guest, try admin account later.</h3>
</br>
<div class="container-login100-form-btn">
<p style="text-align:center;font-size:30px"><a href="index.php?logout">Logout</a></p>
</div>
</div>

<?php
}
elseif (isset($login) && $login->user === "admin" && $login->pass == "1mnk7f189h198241nfa") {
  set_cookie($login);
?>
<!-- User = admin -->
<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
<h3 style="text-align:center;">Admin account</br>hology13{b4d_s3r14l1z3_huhu_UwU}</h3>
</br>
<div class="container-login100-form-btn">
<p style="text-align:center;font-size:30px"><a href="index.php?logout">Logout</a></p>
</div>
</div>

<?php
}
else {
?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="index.php" method="POST">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						SECRET PANEL
					</span>
					<div style="text-align:center;"> guest:guest if u forgot</div></br>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" placeholder="user" name="user" id="user" required data-validation-required-message="Please enter your user name.">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" placeholder="password" name="pass" id="pass" required data-validation-required-message="Please enter your password.">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	}
?>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>