<?php
	require_once 'inc/header.php';
	// require_once 'inc/slider.php';	
?>
<?php
	if(isset($_GET['cartId'])){
		$cartid = $_GET['cartId'];
		$delcart = $ct->del_product_cart($cartid);
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$cartid = $_POST['cartid'];
        $quantity = $_POST['quantity'];
		$update_quantity_cart = $ct->update_quantity_cart($quantity,$cartid);
		if($quantity<=0){
			$delcart = $ct->del_product_cart($cartid);
		}
    }
?>
<?php 
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ Hàng</h2>
					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>
					<?php		
						if(isset($delcart)){
							echo $delcart;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="20%">Tên Sản Phẩm</th>
								<th width="15%">Hình Ảnh</th>
								<th width="15%">Giá</th>
								<th width="20%">Số Lượng</th>
								<th width="20%">Tổng Tiền</th>
								<th width="20%">Trạng Thái</th>
							</tr>
							<?php
								$get_product_cart = $ct ->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
									$qty = 0;
									while($result = $get_product_cart->fetch_assoc()){
												
							?>
							<tr>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt="" style="width:40px; height: 40px;"/></td>
								<td><?php echo $result['price']." VND"?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartid" value="<?php echo $result['cartId']?>"/>
										<input type="number" name="quantity" min = "0" value="<?php echo $result['quantity']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php $total = $result['price'] * $result['quantity']; echo $total." VND";?></td>
								<td><a href="?cartid=<?php echo $result['cartId']?>">Xóa</a></td>
								
							</tr>
							<?php
								$subtotal +=$total;
								$qty = $qty + $result['quantity'];
								}
							}
							?>
						</table>
						<?php
									$check_cart = $ct->check_cart();
									if($check_cart){
										
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php
									// $qty = $qty + $result['quantity'];
									echo $subtotal;
									Session::set('sum',$subtotal);
									Session::set('qty',$qty);
								?>
							</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>15%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php $vat = $subtotal*0.15;
										$glotal = $subtotal+$vat;
										echo $glotal;
									?>
								</td>
							</tr>
					   </table>
					   <?php
								}
								else{
									echo 'Giỏ Hàng Của Bạn Hiện Tại Đang Trống';
								}  
						?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
	require_once 'inc/footer.php';
?>