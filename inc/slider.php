
	<div class="header_bottom">
		<div class="header_bottom_left"style="margin-top:4px;">
			<div class="section group" style="height: 165px;" >
				<?php
					$getLastApple = $product->getLastestApple();
					if($getLastApple){
						while($resultApple = $getLastApple->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2"style="height: 140px; padding-top: 10x;">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultApple['image']?>" alt="" style="height:100px;"/></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Apple</h2>
						<p><?php echo $resultApple['productName']?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultApple['productId']?>"style="font-size: 10px;">Thêm Giỏ Hàng</a></span></div>
				   </div>
			   </div>
			   <?php			
					}
				}  
			   ?>	
			   	<?php
					$getLastOPPO = $product->getLastestOPPO();
					if($getLastOPPO){
						while($resultOppo = $getLastOPPO->fetch_assoc()){
				?>		
				<div class="listview_1_of_2 images_1_of_2"style="height: 140px;padding-top: 10px;">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultOppo['image']?>" alt="" style="height:100px;"/></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>OPPO</h2>
						<p><?php echo $resultOppo['productName']?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultOppo['productId']?>" style="font-size: 10px;">Thêm Giỏ Hàng</a></span></div>
				   </div>
			   </div>
				<?php			
					}
				}  
			   ?>
			</div>
			<div class="section group"style="height: 165px;">
			<?php
					$getLastIphone = $product->getLastestIPhone();
					if($getLastIphone){
						while($resultIP = $getLastIphone->fetch_assoc()){
				?>		
				<div class="listview_1_of_2 images_1_of_2"style="height: 140px; padding-top: 10px;">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"><img src="admin/uploads/<?php echo $resultIP['image']?>" alt=""  style="height:100px;"/></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $resultIP['productName']?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultIP['productId']?>" style="font-size: 10px;">Thêm Giỏ Hàng</a></span></div>
				   </div>
			   </div>			
			   <?php
						}
					}  
			   ?>
			   <?php
					$getLastSS = $product->getLastestSamSung ();
					if($getLastSS){
						while($resultSS = $getLastSS->fetch_assoc()){
				?>		
				<div class="listview_1_of_2 images_1_of_2"style="height: 140px; padding-top: 10px;">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="admin/uploads/<?php echo $resultSS['image']?>" alt=""  style="height:100px;"/></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>SamSung</h2>
						  <p><?php echo $resultSS['productName']?></p>
						  <div class="button"><span><a href="details.php?proId=<?php echo $resultSS['productId'] ?>" style="font-size: 10px;" >Thêm Giỏ Hàng</a></span></div>
					</div>
				</div>
				<?php
						}
					}  
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$get_slider = $product->show_slider();
							if($get_slider)
							{
								while($result_slider = $get_slider->fetch_assoc()){
						?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image']?>" alt=""/></li>
						<?php
							}
						}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>