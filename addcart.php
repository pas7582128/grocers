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


	$count = "SELECT * from users where email = '$email'";
	$abc = mysqli_query($conn,$count);
	$result = mysqli_fetch_assoc($abc);
	$cid=$result['uid'];
	$cname=$result['pname'];
	$address=$result['address'];
	$pincode=$result['pincode'];
	$mobile=$result['mobile'];
	$email1=$result['email'];
    
	$pid = $_POST['pid'];
	$price = $_POST['price'];
	$proname = $_POST['proname'];
	$quantity = $_POST['quantity'];
	$d = date("y/m/d");
	$sql = "INSERT INTO orders (cid,cname,cmobile,pid,pname,quantity,price,address,pincode,stage,tdate) values ('$cid','$cname','$mobile','$pid','$proname','$quantity','$price','$address','$pincode',0,'$d')";
	//$sql = "INSERT INTO users (pname,mobile) values ('Deepak','9898989898')";
	mysqli_query($conn,$sql);
	
?>