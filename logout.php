<?php	
	session_start();
	$email = $_SESSION['email'];

	$servername="localhost";
	$username="root";
	$password="";

	//create connection
	$conn=new mysqli($servername,$username,$password);

	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}


	$db=mysqli_select_db($conn,'grocers');
	session_unset();
    session_destroy();
    header("Location: index.php");
?>