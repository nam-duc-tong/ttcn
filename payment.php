<?php
	require_once 'inc/header.php';
	// require_once 'inc/slider.php';
?>
 <?php
	 	$login_check = Session::get('customer_login');
		 if($login_check==false){
			header('Location:login.php');
		 } 
		 else{
			 echo '<a href="profile.php"></a>';
		 }
	  ?>
<?php
	// if(!isset($_GET['proId'])||$_GET['proId']==NULL){
    //     echo "<script>window.location = '404.php'<script>";
    // }
    // else{
    //     $id = $_GET['proId'];
    // }
	// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    //     $quantity = $_POST['quantity'];
	// 	$Addtocart = $ct-> add_to_cart($quantity,$id);
    // }
?>
<style>
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight:bold;
        text-decoration: underline;
    }
    .wrapper_method{
        text-align: center;
        width: 550px;
        height:120px;
        margin:0 auto;
        border:1px solid #666;
        padding: 20px;
        background:cornsilk;
        /* justify-content: space-between; */
    }
    .wrapper_method a{
        padding: 10px;
        background: red;
        color: #fff;
        /* padding-right:2px; */
        margin-right:5px;
    }
    .wrapper_method a:hover{
        background: #df5353;
    }
    .wrapper_method h3{
        margin-bottom: 20px;
    }
    .pre{
        margin-top:30px;
    }

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Methods</h3>
                </div>
    		<div class="clear"></div>
            <div class="wrapper_method">
                <h3 class="payment">Choose your method payment</h3>
                 <a href="offinepayment.php">Offine Payment</a>
                 <a href="onlinepayment.php">Online Payment</a>    
                <div class="pre">
                    <a href="cart.php" style="background:grey;"><< Previous</a>
                </div>
            </div>
    	</div>
 		</div>
 	</div>

<?php
	require_once 'inc/footer.php';
?>