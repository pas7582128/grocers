<?php

?>


<!DOCTYPE html>
<html>
<head>
	<title>Grocers.Com</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<style type="text/css">body{
		background-color:powderblue;
	}
	*{
		margin:0px;
		padding: 0px;
	}
	.heading{
		background-color: grey;
		height: 60px;
	}
	.heading span {
		color : black;
		font-size: 30px;
		font-style: italic;
		margin-left: 50px;
		margin-top: 50px;
	}
	.heading img{
		margin-right:10px;
		margin-bottom: 10px;
	}
	.menu {
		float: right;
		margin-right: 20px;
		margin-top: 10px;
	}

	.signupPanel{
		margin:auto;
		width: 400px;
		margin-top: 40px;
	}
	input{
		margin-top: 5px;
		margin-bottom: 10px;
	}
	h2{
		margin-left: 615px;
		margin-top:100px;
	}
	.msg{
		color: red;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {

		$("#home").click(function(){
			window.location.href="deliverlogin.php";
		});
    });
</script>
<body>
	<div class="heading">
		<span><img src="images/index_page_small_logo.png" style="width: 30px;">Grocers.Com</span>
		<div class="menu">
			<button class="btn btn-primary" id="home">Deliver Login</button>
		</div>
	</div>
	<h2 style="margin-left: 560px;">Deliver Sign Up</h2>
	<div class="signupPanel">
		<form method="POST" action="res_deliverysignup.php">
		<input type="email" name="email" placeholder="Email" class="form-control" required>
			<input type="text" name="pname" placeholder="Name" class="form-control" required>
			<input type="text" name="address" placeholder="Address" class="form-control" required>
			<input type="text" name="pincode" placeholder="Pincode" class="form-control" required>
			<input type="mobile" name="mobile" placeholder="Mobile" class="form-control" required>
			<input type="password" name="password" placeholder="Password" class="form-control" required>
			<button class="btn btn-primary form-control" name="signup">Create Account</button>
		</form>
	</div>
</body>
</html>
