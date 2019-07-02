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
    $email = $row['email'];
    $pincode=$row['pincode'];
    if($x==0){
        header("Location: index.php");
        exit();
    }
    $count1 = "SELECT * from deliver where pincode = '$pincode' ORDER BY RAND() LIMIT 1";
    $result1 = mysqli_query($conn,$count1);
		$x = mysqli_num_rows($result);

		// if($x==0){
		// 	//echo '<script>alert("Sorry no delivery person available in your location")</script>';
		//
		// 	echo '<script language="javascript">';
		// 	echo 'console.log("aaaa");alert("message successfully sent")';
		// 	echo '</script>';

		//}
    $row1 = mysqli_fetch_array($result1);
    $dmobile=$row1['mobile'];
    $did=$row1['uid'];
    $dname=$row1['pname'];
    $cid=$_POST['uid'];
    $slot=$_POST['slot'];

    $sql = "SELECT * from orders where cid='$cid' AND stage='0'";
    $abc = mysqli_query($conn,$sql);
    while($rowf = mysqli_fetch_array($abc)){
        $oid=$rowf['oid'];
        $datetime = new DateTime('tomorrow');
        $date= $datetime->format('y/m/d');
        $rowff="UPDATE orders SET did='$did', dmobile='$dmobile', dname='$dname', slot='$slot', stage=1, tdate='$date' WHERE oid='$oid'";
        mysqli_query($conn,$rowff);
    }

?>
