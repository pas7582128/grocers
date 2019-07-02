<?php
$msg="";
@$msg = $_GET['query'];

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
		background-color: grey;
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
		float: left;
		margin: 1%;
		margin-top: 1%;
	}
    #livesearch{
        position:absolute;
        z-index:2;
    }
</style>
<script type="text/javascript">

		$(document).ready(function(){

            $("#logout").click(function(){
			    window.location.href="logout.php";
		    });

            $(".addcart").click(function(){
 			var quantity = $(this).siblings('.nos').val();
            var price = $(this).attr('price');
            var fprice=quantity*price;
            var proname = $(this).attr('proname');
            var pid = $(this).attr('pid');
            $.ajax({
 				url: "addcart.php",
 				type: 'post',
 				data:{quantity:quantity,proname:proname,pid:pid,price:fprice},
 				success: function( data ) {
 					alert("Product added to your cart");
 				}

 			});

         });

         $("#searchbox").keyup(function(){
             var str = $("#searchbox").val();
            if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.width="315px";
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
         });



	});
</script>
<body>
	<div style="background-color: grey;">
	<nav class="navbar navbar-expand-sm  navbar-light">
		<ul class="navbar-nav">
		<li class="nav-item">
		      <a class="nav-link" href="userpage.php"><b>Home</b></a>
		    </li>
            <li class="nav-item">
		      <a class="nav-link" href="mycart.php">My Cart</a>
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
	</div>
    <form style="float:left;margin-left:30em;margin-top: 02em;">
    <input type="text" size="30" style="font-size: 20px;" id="searchbox"  placeholder="Search">
    <div id="livesearch" style="z-index:5"></div>
</form>
    <h5 style="text-align:right;margin-right:2em"><?php echo "Logged in as ".$pname ?></h5>
	<div id="mainpart" style="margin-top: 5em ">
    <?php

            if($msg==""){
                $sql = "SELECT * from products ORDER BY RAND() LIMIT 8;";
            }else{
                $sql = "SELECT * from products WHERE proname='$msg'";
            }
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
?>
							<div class="card" style="width: 23%;">
					    		<img class="card-img-top" src="<?php echo $row['image'];?>" alt="Card image cap" style="width:290px;height:300px">
					    		<div class="card-body">
							      	<span><label><b>Name :</b></label><i><?php echo $row['proname']?></i></span><br>
							      	<span><label><b>Price :</b></label><i><?php echo $row['price']?></i></span>

							    </div>
							     <div class="card-footer">
                                 <input type="number" min="1" max="10" value="1" size="3" class="nos" style="margin-right:1em"/><button type="button" price="<?php echo $row['price']?>" proname="<?php echo $row['proname']?>" pid="<?php echo $row['uid']?>" class="btn btn-primary addcart" name="download" value="<?php echo $row['image'];?>">Add to cart</button>

				    			</div>
						  	</div>
<?php

			}
		}
	?>

    </div>
</body>
</html>
