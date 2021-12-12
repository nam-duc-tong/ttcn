<?php
    include_once 'lib/session.php';
    Session::init();
	//khởi tao session
?>
<?php
	require_once 'lib/database.php';
	require_once 'helpers/dbhelper.php';
	// hàm tự động lấy lớp
	spl_autoload_register(function($className){
		include_once "classes/".$className.".php";
	});
	 $db = new Database();
	 $fm = new Format();
	 $ct = new cart();
	 $us = new user();
	 $cs = new customer();
	 $cat = new category();
	 $product = new product();

?>
<?php
//kiểm soát bộ nhớ đệm trong trình duyệt và bộ đệm được chia sẻ
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<!-- Thêm ảnh logo -->
				<a href="index.php"><img src="" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method = "post">
				    	<input type="text" placeholder="Tìm Kiếm Sản Phẩm" name="tukhoa">
						<input type="submit" name = "search_product" value="Tìm Kiếm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="Xem giỏ hàng" rel="nofollow">
								<!-- <span class="cart_title">G</span> -->
								<span class="no_product">
									<?php
									$check_cart = $ct->check_cart();
									if($check_cart){
										$sum = Session::get("sum");
										$qty = Session::get("qty");
										echo $fm->format_currency($sum).'VND'.' - '.'SL: '.$qty;
									}
									else{
										echo 'Empty';
									}
									?>
								</span>
							</a>
						</div>
			      </div>

				  <?php
				 	if(isset($_GET['customer_Id'])){
						 $customer_id = $_GET['customer_id'];
						 $delCart = $ct->del_all_data_cart();
						 $delCompare = $ct->del_compare($customer_id);
						 Session::destroy();//xóa session
					 } 
				  ?>
		   <div class="login">
			<?php
				$login_check = Session::get('customer_login');
				if($login_check==false){
					echo '<a href="login.php">Đăng Nhập</a></div>';
				}
				else{
					echo '<a href="?customer_Id='.Session::get('customer_Id').'">Đăng Xuất</a></div>';
				}
			?>
		 
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>

<div class="menu">

	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang Chủ</a></li>
	  <li><a href="topbrands.php">Sản Phẩm</a></li>
		<?php
		 $customer_Id = Session::get('customer_Id');
			$check_order = $ct->check_order($customer_Id);
			if($check_order==true){
				echo '<li><a href="orderdetails.php">Chi Tiết Đơn Hàng</a></li>';
			}
			else{
				echo '';
			}
		?>
	  <?php
	 	$login_check = Session::get('customer_login');
		 if($login_check==false){
			 echo '';
		 } 
		 else{
			 echo '<li><a href="profile.php">Thông Tin Khách Hàng</a></li>';
		 }
	  ?>
	 
	  <?php
	 	$login_check = Session::get('customer_login');
		 if($login_check){
			echo '<li><a href="wishlist.php">Danh Sách Yêu Thích</a> </li>';
		 }
	  ?>
	  <li><a href="contact.php">Liên Hệ</a> </li>
	  <div class="clear"></div>
	</ul>
</div>