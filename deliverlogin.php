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
		font-size: 30px;
		font-style: italic;
		margin-left: 50px;
		margin-top: 25px;
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
	.loginPanel{
		float: right;
		margin-right: 150px;
		width: 300px;
		position: relative;
		margin-top: 200px;
	}
	input{
		margin-top: 5px;
		margin-bottom: 5px; 
	}
	.msg{
		color: red;
	}

</style>
<script>
    $(document).ready(function() {
		
		$("#home").click(function(){
			window.location.href="index.php";
		});
		$("#deliverysignup").click(function(){
			window.location.href="deliverysignup.php";
		});
    });
    
</script>
<body>
	<div class="heading">
		<span><img src="images/index_page_small_logo.png" style="width: 30px;">Deliver Login</span>
		<div class="menu">
        <button class="btn btn-primary" id="home">Home</button>
		</div>
	</div>
		<div class="body">
			<image src="images/delivery.jpg" style="float:left;width:400px;height:400px;margin-left:100px;margin-top:100px"/>
			<div class="loginPanel">
				<form method="POST" action="res_deliverlogin.php">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
					<input type="password" name="password" placeholder="Password" class="form-control" required>
					<button class="btn btn-primary form-control" name="login">Login</button>
                </form>
                <button class="btn btn-primary form-control" style="margin-top:1em" id="deliverysignup">Delivery SignUp</button>
		</div>
	</div>
</body>
</html>