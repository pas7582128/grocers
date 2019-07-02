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

	
?>
<html>
<head>
	<title>Grocers.Com</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<style type="text/css">body{
		background-color:powderblue;
	}
	*{
		margin:0px;
		padding: 0px;
	}
	.heading{
		background-color: #eed;
		height: 60px;
	}
	.heading span {
		color : black;
		font-size: 30px;
		font-style: italic;
		font-family: 'Pacifico';
		margin-left: 50px;
		margin-top: 25px;
	}
	.heading img{
		margin-right:10px;
		margin-bottom: 10px;
	}
	.menu {
		float: right;
		margin-right: 20px;
		margin-top: 10px;
	}
</style>
<script type="text/javascript">

		$(document).ready(function(){
            
            $("#logout").click(function(){
			    window.location.href="logout.php";
		    });

				$(".deleteuser").click(function(){
                var uid = $(this).attr('uid');
                $.ajax({
 				url: "deleteuser.php",
 				type: 'post',
 				data:{uid:uid},
 				success: function( data ) {
                   window.location.href="userlist.php";
 				}

 			});
            });

	});
</script>
<body>
	<nav class="navbar navbar-expand-sm navbar-light"  style="background-color: grey;">
		<ul class="navbar-nav">
		<li class="nav-item">
		      <a class="nav-link" href="adminpage.php">Add Product</a>
		    </li>
				<li class="nav-item">
		      <a class="nav-link" href="productlist.php">Product List</a>
		    </li>
            <li class="nav-item">
		      <a class="nav-link" href="userlist.php"><b>User List</b></a>
		    </li>
			<li class="nav-item">
		      <a class="nav-link" id="logout" style="cursor:pointer">Logout</a>
		    </li>
		</ul>	
	</nav>

	
	<?php
			$sql = "SELECT * from admin where email = '$email'";
            $result = mysqli_query($conn,$sql); 
            $row = mysqli_fetch_array($result)?>
            <span><h4 style="margin-right:50px;text-align:right">Admin : <?php echo $row['pname'];?></h4></span>
			
            <center><h4>Users List</h4></center>
    <div class="card" >

  <table class="table" style="margin-right:2em">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Pincode</th>
        <th>Star Member</th>
				<th>Action</th>
      </tr>
    </thead>
    <tbody>
  
	<?php
		$sql = "SELECT * from users";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result)){
	?>
        <tr>
            <td><?php echo $row['pname']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['mobile']?></td>
            <td><?php echo $row['pincode']?></td>
            <td><?php if($row['star']==0){echo 'No';}else{echo 'Yes';}?></td>
						<td><button class="btn btn-negative deleteuser" uid="<?php echo $row['uid']?>" style="margin:0em">Delete</button></td>
        </tr>
	<?php
			}
		}
	?>
        </tbody>
    </table>
</div>

</body>
</html>