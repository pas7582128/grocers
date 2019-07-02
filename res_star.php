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
    $result = mysqli_query($conn,$count);
    $x = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $star = $row['star'];
    $pname = $row['pname'];
    $email = $row['email'];

    if($x==0){
        header("Location: index.php");
        exit();
    }
    if($star==0){
        $sql = "UPDATE users SET star='1' WHERE email='$email'";
        mysqli_query($conn,$sql);
        header("Location: userpage.php?star=true");
        exit();
    }else{
        header("Location: userpage.php");
        exit();  
    }
?>