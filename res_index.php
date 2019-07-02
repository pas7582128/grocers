<?php
session_start();
	$email=$_POST['email'];
	$pass=$_POST['password'];
	//echo $email;

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
		$s="select * from users where email='$email' and password='$pass'";
		$res=$conn->query($s);

		if($res->num_rows > 0){
			$_SESSION['email']=$email;
			$_SESSION['admin']=0;
			header("location: userpage.php");
		}
		else{
			{
				$_SESSION['email']="";
				$_SESSION['admin']=0;
				session_destroy();
				echo '<script type="text/javascript">alert("Wrong email or password");location.href="index.php";</script>';
			}
		}
	}
	else
	{
		echo 'db not connected';
	}
	$conn->close();
?>