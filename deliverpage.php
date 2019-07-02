<?php
	session_start();
	$email = $_SESSION['email'];
    
 
    //echo $email;

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

    $row = mysqli_fetch_array($result);
    $dname = $row['pname'];
    $did = $row['uid'];
    $finalprice = 0;
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

	
</style>
<script type="text/javascript">

		$(document).ready(function(){
            
            $("#logout").click(function(){
			    window.location.href="logout.php";
		    });


            $(".deliveritem").click(function(){
                var oid = $(this).attr('oid');
                $.ajax({
 				url: "deliveritem.php",
 				type: 'post',
 				data:{oid:oid},
 				success: function( data ) {
                   window.location.href="deliverpage.php";
 				}

 			});
            });

	});
</script>
<body>
	<nav class="navbar navbar-expand-sm navbar-light"  style="background-color: grey;">
		<ul class="navbar-nav">
		<li class="nav-item">
		      <a class="nav-link" href="deliverpage.php"><b>Home</b></a>
		    </li>
			<li class="nav-item">
		      <a class="nav-link" id="logout" style="cursor:pointer">Logout</a>
		    </li>
		</ul>
	</nav>
    <h5 style="text-align:right;margin-right:2em"><?php echo $dname ?></h5>	
    
    <center><h4>Pending Delivery</h4></center><hr>
    <?php
			$sql = "SELECT * from orders WHERE did='$did' AND stage='1'";
			$result1 = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result1)>0){
                ?>
                    <div class="card" >
                    <table class="table" style="margin-right:2em">
    <thead>
      <tr>  
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Mobile</th>
        <th>Price</th>
        <th>Address</th>
        <th>DeliveryDate</th>
        <th>Slot</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
                <?php
				while($row = mysqli_fetch_array($result1)){
                    $finalprice=$finalprice+$row['price'];
?>
        <tr>
            <td><?php echo $row['oid']?></td>
            <td><?php echo $row['cname']?></td>
            <td><?php echo $row['cmobile']?></td>
            <td><?php echo $row['price']?></td>
            <td><?php echo $row['address']?></td>
            <td><?php echo $row['tdate']?></td>
            <td><?php echo $row['slot']?></td>
            <td><button class="btn btn-negative deliveritem" oid="<?php echo $row['oid']?>"  price="<?php echo $row['price']?>" style="margin:0em">Delivered</button></td>
        
        </tr>
                            
<?php 					
				
            }
            ?>
            </tbody>
            </table>
            </div>
            <?php
		}else{
            ?>
                <center><h4>No pending orders </h4></center>
            <?php
        }
	?>

    
    <center><h4 style="margin-top:2em">Delivery History</h4></center><hr>
    
    <?php
			$sql = "SELECT * from orders WHERE did='$did' AND stage='2'";
			$result1 = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result1)>0){
                ?>
                    <div class="card" >
                    <table class="table" style="margin-right:2em">
    <thead>
      <tr>  
      <th>Order ID</th>
        <th>Customer Name</th>
        <th>Mobile</th>
        <th>Price</th>
        <th>Address</th>
        <th>DeliveryDate</th>
        <th>Slot</th>
      </tr>
    </thead>
    <tbody>
                <?php
				while($row = mysqli_fetch_array($result1)){
                    $finalprice=$finalprice+$row['price'];
?>
        <tr>
            <td><?php echo $row['oid']?></td>
            <td><?php echo $row['cname']?></td>
            <td><?php echo $row['cmobile']?></td>
            <td><?php echo $row['price']?></td>
            <td><?php echo $row['address']?></td>
            <td><?php echo $row['tdate']?></td>
            <td><?php echo $row['slot']?></td>
        </tr>
                            
<?php 					
				
            }
            ?>
            </tbody>
            </table>
            <?php
		}else{
            ?>
                <center><h4>No order history.</h4></center>
            <?php
        }
	?>
</div>

</body>
</html>