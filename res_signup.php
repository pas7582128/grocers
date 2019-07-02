<html>
<head><script src="js/jquery.js"></script></head>
</html>
<?php
	session_start();
	$name=$_POST['pname'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$pin=$_POST['pincode'];
	$mobile=$_POST['mobile'];
	$pass=$_POST['password'];

	
	$flag=1;
	include_once ('lib/smtp_validateEmail.class.php');
	$SMTP_Validator = new SMTP_validateEmail();
	$SMTP_Validator->debug = true;

	if(!preg_match('/^[0-9]{10}+$/', $mobile)){
		echo '<script type="text/javascript">alert("Mobile number is not valid");window.location.href="signup.php";</script>';
		$flag=0;
		exit();
	}
	if ($email != "") {
	//echo $email;
	
	if(preg_match('/^[a-z0-9\.\-_\+]+@[a-z0-9\-_]+\.([a-z0-9\-_]+\.)*?[a-z]+$/is', $email)) echo "Valid2";
	else{
	 echo "invalid2";
	 echo '<script type="text/javascript">alert("Email address is not valid");window.location.href="signup.php";</script>';
	 $flag=0;
	 exit();
	}

	if(!preg_match('([0-9]{6}|[0-9]{3}\s[0-9]{3})', $pin)){
		echo '<script type="text/javascript">alert("Pin code is not valid");window.location.href="signup.php";</script>';
		$flag=0;
		exit();
	}
	if(strlen($pass) < 8){
		echo '<script type="text/javascript">alert("Enter at least 8 char in password");window.location.href="signup.php";</script>';
		$flag=0;
		exit();
	}
	// if ($results[$email]) {
	// 	echo "valid";
	// } else {
	// 	echo "invalid";
	// 	//echo '<script type="text/javascript">alert("Email address is not valid");window.location.href="signup.php";</script>';
	// 	$flag=0;
	// }
	}


	$servername="localhost";
	$username="root";
	$password="";

	//create connection
	$conn=new mysqli($servername,$username,$password);

	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}


	$db=mysqli_select_db($conn,'grocers');
	if($db){
		$s="select * from users where mobile='$mobile'";
		$res=$conn->query($s);
		if($res->num_rows > 0){
			echo '<script type="text/javascript">alert("Already used mobile number");window.location.href="signup.php";</script>';$flag=0;exit();
		}
		$s="select * from users where email='$email'";
		$res=$conn->query($s);
		if($res->num_rows > 0){
			echo '<script type="text/javascript">alert("Already used email");window.location.href="signup.php";</script>';$flag=0;exit();
		}

		
		if($flag==1){
			//$_SESSION['email']=$email;
			//header("location: login_blogger.php");
			
			$zero=0;
		$sql="INSERT into users(pname,email,address,pincode,mobile,password) values ('$name','$email','$address','$pin','$mobile','$pass')";
		
	       	if($conn->query($sql)===true){
				echo 'Registered succesfully';
				echo '<script type="text/javascript">alert("Registered succesfully");window.location.href="index.php";</script>';
			}
			else{
				echo mysqli_error($conn);
			}
		}
		else{
			session_unset(); 
			session_destroy();
		}
	}
	else
	{
		echo 'db not connected';
	}
	$conn->close();
?>