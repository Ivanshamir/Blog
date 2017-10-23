<?php
 include '../lib/Session.php';
 Session::checkLogin();
 include '../config/config.php';
 include '../lib/Database.php';
 include '../helpers/Format.php';
 $db = new Database();
 $fm = new Format();

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = $fm->validation($_POST['email']);
			$email = mysqli_real_escape_string($db->link, $email);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "<span style='color:red;font-size=18px;'>Invalid Email.</span>";
			}else{
				$emailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
				$emailresult = $db->selectDb($emailquery);
				if ($emailresult != false) {
					while ($value = $emailresult->fetch_assoc()) {
						$userid = $value['id'];
						$username = $value['username'];
					}
					$text = substr($email, 0, 3);
					$rand = rand(10000, 99999);
					$newpass = "$text$rand";
					$password = md5($newpass);
					$upemailquery = "UPDATE tbl_user SET 
                                password = '$password'
                                WHERE id = '$userid'";
                     $updateRow = $db->dbUpdate($upemailquery);
                     $to = "$email";
                     $from = "shamirblog@gmail.com";
                     $headers = "From: $from\n"; 
					 $headers .= 'MIME-Version: 1.0' . "\r\n"; 
					 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
					 $subject = "Your password";
					 $message = "Your username is :" .$username. "And Your password is: ".$newpass."Please visit website to login";
					 $sendmail = mail($to, $subject, $message, $headers);
					 if ($sendmail) {
					 	echo "<span style='color:green;font-size=18px;'>Please check your email for new password.</span>";
					 }else{
					 	echo "<span style='color:red;font-size=18px;'>Email can not be sent.</span>";
					 }
				}else{
					echo "<span style='color:red;font-size=18px;'>Email did not found.</span>";
				}

		}
	}
	?>

		<form action="" method="post">
			<h1>Recovery pasword</h1>
			<div>
				<input type="text" placeholder="Please Enter your email" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send" />
			</div>
		</form>
		<!-- form -->
		<div class="button">
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>