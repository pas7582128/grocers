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
	.search{
		margin-left: 350px;
	}

	.card{
		width: 310px;
		float: left;
		margin: 1%;
		margin-top: 1%;
	}
    .upload{
		margin: auto;
		margin-top: 80px;
		margin-right: 150px;
		float: right;
		width: 400px;
	}
	.upload input{
		margin-top: 10px;
		margin-bottom: 10px;
	}
    .msg{
		color: green;
	}
</style>
<script type="text/javascript">

		$(document).ready(function(){
            
            $("#logout").click(function(){
			    window.location.href="logout.php";
		    });
	});
</script>
<body>
	<nav class="navbar navbar-expand-sm  navbar-light"  style="background-color: grey;">
		<ul class="navbar-nav">
		<li class="nav-item">
		      <a class="nav-link" href="adminpage.php"><b>Add Product</b></a>
		    </li>
				<li class="nav-item">
		      <a class="nav-link" href="productlist.php">Product List</a>
		    </li>
            <li class="nav-item">
		      <a class="nav-link" href="userlist.php">User List</a>
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
			
            <image src="images/admin_add_groc.png" style="float:left;width:400px;height:400px;margin-left:100px;margin-top:40px"/>
            <div class="upload">
            
		<form method="post" action="upload_groc.php" enctype="multipart/form-data">
			<div class="input-group"> 
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image" required>
                <label class="custom-file-label" for="inputGroupFile01">Image</label>
              </div>
            </div>
			<input type="text" name="proname" class="form-control" placeholder="Name" required>
            <input type="text" name="price" class="form-control" placeholder="Price" required>
			<button name="upload" class="btn btn-success">Upload</button>
		</form>
	</div>

</body>
</html>