<?php
	require_once 'inc/header.php';
	// require_once 'inc/slider.php';
?>
<?php
	if(!isset($_GET['proId'])||$_GET['proId']==NULL){
        echo "<script>window.location = '404.php'<script>";
    }
    else{
        $id = $_GET['proId'];
    }
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity'];
		$Addtocart = $ct-> add_to_cart($quantity,$id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$get_product_details = $product->get_details($id);
				if($get_product_details){
					while($result_details = $get_product_details->fetch_assoc()){
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image']?>" style="width:90%;" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName']?></h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'],150)?></p>					
					<div class="price">
						<p>Giá: <span><?php echo $result_details['price']." VND"?></span></p>
						<p>Danh Mục Sản Phẩm: <span><?php echo $result_details['catName']?></span></p>
						<p>Thương Hiệu:<span><?php echo $result_details['brandName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min = "1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua Hàng"/>
						
					</form>		
					<?php
							if(isset($Addtocart)){
								echo '<span style="color:red;font-size:18px;font-weight:bold;">Sản Phẩm Đã Được Thêm</span>';
							}
						?>		
				</div>
			</div>
			<div class="product-desc">
				<h2>Chi Tiết Sản Phẩm</h2>
				<p><?php echo $fm->textShorten($result_details['product_desc'],150)?></p>	
			</div>
	</div>
	<?php
	}
}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh Mục Sản Phẩm</h2>
					<ul>
				 		<?php
						 	$getall_category = $cat->show_category_fontend();
							 if($getall_category){
								 while($result_allcat = $getall_category->fetch_assoc()){
						 ?>
						 <li><a href="productbycat.php?catId=<?php echo $result_allcat['catId']?>"><?php echo $result_allcat['catName']?></a></li>
						<?php	 
								}
							}
						?>
						</ul>
				
 				</div>
 		</div>
 	</div>

<?php
	require_once 'inc/footer.php';
?>