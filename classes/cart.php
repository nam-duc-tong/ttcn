<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/dbhelper.php');
?>
<?php
    class cart{  
        private $fm;
        private $db;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }                                                                                                   
        public function add_to_cart($quantity,$id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link,$quantity );
            $id = mysqli_real_escape_string($this->db->link,$id);
            $sId = session_id();

            // $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            // if($check_cart){
            //     $msg = "Product Already Added";
            //     return $msg;
            // }
            // else{
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $image = $result["image"];
            $price= $result["price"];
            $productName = $result["productName"];
                $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
                $insert_cart = $this->db->insert($query_insert);
    
                if($result){
                    header('Location: cart.php');
                }   
                else{
                    header('Location: 404.php');
                }
            // }
            
        }
        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_quantity_cart($quantity,$cartid){
            $quantity = mysqli_real_escape_string($this->db->link,$quantity);
            $cartid = mysqli_real_escape_string($this->db->link,$cartid);
            //neu nguoi dung khong chon anh
            $query = "UPDATE tbl_cart SET
            quantity = '$quantity'

            WHERE cartId = '$cartid'";
            $result = $this->db->update($query);
            if($result){
                $msg = "<span class ='success'>Product Quantity Updated Successfully</span>";
                return $msg;
            }
            else{
                $msg = "<span class='error'>Product Quantity Updated not Successfully</span>";
                return $msg;
            }
        }
        public function del_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link,$cartid);
            $query = "DELETE FROM tbl_cart WHERE cartId ='$cartid'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
            }
            else{
                $msg = "<span class='error'>Product Deleted Not Successfully</span>";
                return $msg;
            }
        }
        public function check_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function check_order($customer_Id){

            $sId = session_id();
            $query = "SELECT * FROM tbl_order WHERE customer_Id = '$customer_Id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_all_data_cart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";   
            $result = $this->db->select($query);
            return $result;
        }
        public function insertOrder($customer_Id){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price']*$quantity;
                    $image = $result['image'];
                    $customer_Id = $customer_Id;

                    $query_insert = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_Id) VALUES('$productId','$productName','$quantity','$price','$image','$customer_Id')";
                    $insert_cart = $this->db->insert($query_insert);             

                }
            }
        }
        public function getAmountPrice($customer_Id){
            // $sId = session_id();
            $query = "SELECT price FROM tbl_order WHERE customer_Id ='$customer_Id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }
        public function get_cart_ordered($customer_Id){
         
            $query = "SELECT * FROM tbl_order WHERE customer_Id ='$customer_Id'";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }
        public function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order ORDER BY date_order";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
        }
        public function shifted($Id,$time,$price){
            $Id = mysqli_real_escape_string($this->db->link,$Id);
            $price = mysqli_real_escape_string($this->db->link,$price);
            $time = mysqli_real_escape_string($this->db->link,$time);

            $query = "UPDATE tbl_order SET status = '1' WHERE Id = '$Id' AND date_order='$time' AND price = '$price'";
            $result = $this->db->update($query);
            if($result){
                $msg = "<span class ='success'>Updated Order Successfully</span>";
                return $msg;
            }
            else{
                $msg = "<span class='error'>Updated Order not Successfully</span>";
                return $msg;
            }
        }
        public function del_shifted($Id,$time,$price){
            $Id = mysqli_real_escape_string($this->db->link,$Id);
            $price = mysqli_real_escape_string($this->db->link,$price);
            $time = mysqli_real_escape_string($this->db->link,$time);

            $query = "DELETE FROM tbl_order
             WHERE Id = '$Id' AND date_order='$time' AND price = '$price'";
            $result = $this->db->update($query);
            if($result){
                $msg = "<span class ='success'>Delete Order Successfully</span>";
                return $msg;
            }
            else{
                $msg = "<span class='error'>Delete Order not Successfully</span>";
                return $msg;
            }
        }
        public function shifted_confirm($Id,$time,$price){
            $Id = mysqli_real_escape_string($this->db->link,$Id);
            $price = mysqli_real_escape_string($this->db->link,$price);
            $time = mysqli_real_escape_string($this->db->link,$time);
            $query = "UPDATE tbl_order SET status = '2' WHERE customer_Id = '$Id' AND date_order='$time' AND price = '$price'";
            $result = $this->db->update($query);
            return $result;
        }
    }

?>    