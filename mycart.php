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
    if($x!=1){
        header("Location: index.php?login=false");
        exit();
    }
    $row = mysqli_fetch_array($result);
    $star = $row['star'];
    $pname = $row['pname'];
    $uid = $row['uid'];
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

            $("#placeorder1").click(function(){
                var uid = $(this).attr('uid');
                var slot = $('#selslot').val();
                $.ajax({
 				url: "placeorder.php",
 				type: 'post',
 				data:{uid:uid,slot:slot},
 				success: function( data ) {
                  window.location.href="myorders.php";
                 }

                });

            });


            $(".deleteitem").click(function(){
                var oid = $(this).attr('oid');
                var price = $(this).attr('price');
                var pageRef = 0;
                $.ajax({
 				url: "deleteitem.php",
 				type: 'post',
 				data:{oid:oid,pageRef:pageRef},
 				success: function( data ) {
                   window.location.href="mycart.php";
 				}

 			});
            });

        });


</script>
<body>
	<nav class="navbar navbar-expand-sm navbar-light"  style="background-color: grey;">
		<ul class="navbar-nav">
		<li class="nav-item">
		      <a class="nav-link" href="userpage.php">Home</a>
		    </li>
            <li class="nav-item">
		      <a class="nav-link" href="mycart.php"><b>My Cart</b></a>
		    </li>
            <li class="nav-item">
		      <a class="nav-link" href="myorders.php">My Orders</a>
		    </li>
            <?php if($star==0){?><li class="nav-item">
		      <a class="nav-link" href="star.php">Star membership</a>
		    </li><?php } ?>

			<li class="nav-item">
		      <a class="nav-link" id="logout" style="cursor:pointer">Logout</a>
		    </li>
		</ul>
	</nav>
    <h5 style="text-align:right;margin-right:2em"><?php echo "Logged in as ".$pname ?></h5>

    <?php
			$sql = "SELECT * from orders WHERE cid='$uid' AND stage='0'";
			$result1 = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result1)>0){
                ?>
                    <center><h4>My cart</h4></center>
                    <div class="card">
                    <table class="table" style="margin-right:2em">
    <thead>
      <tr>
        <th>P ID</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
                <?php
				while($row = mysqli_fetch_array($result1)){
                    $finalprice=$finalprice+$row['price'];
?>
        <tr>
            <td><?php echo $row['pid']?></td>
            <td><?php echo $row['pname']?></td>
            <td><?php echo $row['quantity']?></td>
            <td><?php echo $row['price']?></td>
            <td><button class="btn btn-negative deleteitem" oid="<?php echo $row['oid']?>"  price="<?php echo $row['price']?>" style="margin:0em">Delete</button></td>
        </tr>

<?php

            }
            ?>
            </tbody>
            </table>
            </div>
            <h4 style="margin-top:2em;margin-left:10em;">Sum: Rs. <?php echo $finalprice ?><?php if($star==0){
                $finalprice=$finalprice+50;
                ?>
                Rs 50(Delivery) <br>Total : Rs.
                <?php echo $finalprice; }else{ ?>
                   + Free(Delivery) <br>Total : Rs.
                    <?php echo $finalprice; } ?>
                </h4>
                <div class="form-group" style="margin-top:1em;margin-left:15em;">
            <label for="selslot"><b>Slot : </b></label>
            <select id="selslot">
      <option value="Morning">Morning (7am-12pm)</option>
    <option value="Afternoon">Afternoon (1pm-5pm)</option>
    <option value="Evening">Evening (5pm-10pm)</option>
  </select>
</div>

            <button class="btn btn-primary" style="margin-top:1em;margin-left:15em;" uid="<?php echo $uid ?>" style="margin:0em" id="placeorder1">Place Order</button>
            <?php
		}else{
            ?>
                <center><h4>Your cart is empty. <br><a href="userpage.php">Click here</a> to add items to your cart.</h4></center>
            <?php
        }
	?>



</body>
</html>
