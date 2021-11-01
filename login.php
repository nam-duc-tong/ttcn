<?php
// Session_start();

	require_once 'inc/header.php';
	// require_once 'inc/slider.php';
?>
<?php
				$login_check = Session::get('customer_login');
				if($login_check){
					header('Location:order.php');
				}
?>
<?php
    // $pd = new product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertCustomers = $cs-> insert_customers($_POST);
    }
?>
<?php
    // $pd = new product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $loginCustomers = $cs-> login_customers($_POST);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="login_panel">
		<?php
				if(isset($loginCustomers)){
					echo $loginCustomers;
				}
			?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="POST">
                	<input type="text" name="email" class="field" placeholder="Enter Email">
                    <input type="password" name="password" class="field" placeholder="Enter Password...........">
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sign In" style="background-color:#fff;color: #000; padding: 10px;"></input></div></div>
			</form>
			</div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
				if(isset($insertCustomers)){
					echo $insertCustomers;
				}
			?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter Name ..." >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter City ...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Enter Zip_code ...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter Email ...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Address ...">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="HCM">Thành phố hcm</option>
							<option value="HCM">Ninh Bình</option>
							<option value="HCM">Hà Nội</option>
							<option value="HCM">Hà Nam</option>
							<option value="HCM">Nghệ An</option>
							<option value="HCM">Hà Tĩnh</option>
		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter Phone ...">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Enter Password ...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account" style="background-color:#fff;color: #000; padding: 10px;"></input></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 
<?php
	require_once 'inc/footer.php';
?>