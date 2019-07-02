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


	$destinationFile='';
	if(isset($_POST['upload'])){
		if(isset($_FILES['image'])){
			$price = $_POST['price'];
			$proname = $_POST['proname'];
			$image =  $_FILES['image'];
			print_r($image);
			$imagename = $_FILES['image']['name'];
			$fileExtension = explode('.', $imagename);
			$fileCheck = strtolower(end($fileExtension));
			$fileExtensionStored = array('png','jpg','jpeg');
			if(in_array($fileCheck, $fileExtensionStored)){
				$destinationFile = 'images/'.$imagename;
				move_uploaded_file($_FILES['image']['tmp_name'], $destinationFile);
				$sql = "INSERT into products (proname,image,price) values ('$proname','$destinationFile','$price')";

				mysqli_query($conn,$sql);
				echo '<script type="text/javascript">alert("Succesfully uploaded");location.href="adminpage.php";</script>';
				//header("location:../adminpage.php");
			}
		}

	}
?>
