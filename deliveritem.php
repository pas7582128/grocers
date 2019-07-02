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

	$count = "SELECT * from deliver where email = '$email'";
    $result = mysqli_query($conn,$count);
    $x = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $email = $row['email'];

    if($x==0){
        header("Location: index.php");
        exit();
    }
    $oid=$_POST['oid'];
    $pafeRef=$_POST['pageRef'];
    $sql = "UPDATE orders SET stage=2 where oid = '$oid'";
    mysqli_query($conn,$sql);
   
?>