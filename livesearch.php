<?php
$servername="localhost";
  $username="root";
  $password="";

  //create connection
  $conn=new mysqli($servername,$username,$password);

  if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
  }


  $db=mysqli_select_db($conn,'grocers');


$q=$_GET["q"];
$count = "SELECT * from products";
    $result = mysqli_query($conn,$count);

if (strlen($q)>0) {
  $hint="";
  while($row = mysqli_fetch_array($result)){


      if (stristr($row['proname'],$q)) {
        if ($hint=="") {
          $hint="<a href='userpage.php?query=" .
          $row['proname'] .
          "' target='_parent' style='text-decoration:none;color:black; '>" .
          $row['proname'] . "</a>";
        } else {
          $hint=$hint . "<br /><a href='userpage.php?query=" .
          $row['proname'] .
          "' target='_parent' style='text-decoration:none;color:black; '>" .
          $row['proname'] . "</a>";
        }
      }

  }
}


if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

echo $response;
?>
