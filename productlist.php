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
	<title>Grofers</title>
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

				$(".deleteproduct").click(function(){
                var pid = $(this).attr('pid');
                $.ajax({
 				url: "deleteproduct.php",
 				type: 'post',
 				data:{pid:pid},
 				success: function( data ) {
                   window.location.href="productlist.php";
 				}

 			});
            });

			$(".editprice").click(function(){
                var pid = $(this).attr('pid');
								var price = $(this).parent('.par').siblings('.sib').children('.pricefield').val();

								$.ajax({
 				url: "editprice.php",
 				type: 'post',
 				data:{pid:pid,price:price},
 				success: function( data ) {
                   window.location.href="productlist.php";
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
		      <a class="nav-link" href="productlist.php"><b>Product List</b></a>
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
			
            <center><h4>Products List</h4></center>
    <div class="card" >

  <table class="table" style="margin-right:2em">
    <thead>
      <tr>
        <th>P ID</th>
        <th>Name</th>
        <th>Price</th>
				<th>Edit Price</th>
				<th>Action</th>
      </tr>
    </thead>
    <tbody>
  
	<?php
		$sql = "SELECT * from products";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result)){
	?>
        <tr>
            <td><?php echo $row['uid']?></td>
            <td><?php echo $row['proname']?></td>
            <td class="sib"><input type="text" class="pricefield" size="5" value="<?php echo $row['price']?>"/></td>
						<td class="par"><button class="btn btn-negative editprice" pid="<?php echo $row['uid']?>" style="margin:0em">Edit</button></td>
			<td><button class="btn btn-negative deleteproduct" pid="<?php echo $row['uid']?>" style="margin:0em">Delete</button></td>
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