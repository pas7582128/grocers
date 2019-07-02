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

    $pid=$_POST['pid'];
    $price=$_POST['price'];
    $sql = "UPDATE products SET price='$price' where uid = '$pid'";
    mysqli_query($conn,$sql);
    
?>