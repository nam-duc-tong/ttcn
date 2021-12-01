<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/dbhelper.php');
?>
<?php
    class product{  
        private $fm;
        private $db;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }                                                                                                   
        public function insert_product($data,$files){
           
            $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
            $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
            $category = mysqli_real_escape_string($this->db->link,$data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link,$data['price']);
            $type = mysqli_real_escape_string($this->db->link,$data['type']);
            //kiem tra hinh anh va lay hinh anh cho vao folder uploads
            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName==""||$brand==""||$category==""||$product_desc==""||$price==""||$type==""||$file_name==""){
                $alert = "<span class='error'>Các Trường Không Được Để Trống</span>";
                return $alert;
            }
            else{
                move_uploaded_file($file_temp,$uploaded_image); 
                  $query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
                $result = $this->db->insert($query);    
                if($result){
                    $alert = "<span class= 'success'>Thêm Sản Phẩm Thành Công</span>";
                    return $alert;
                }   
                else{
                    $alert = "<span class= 'error'>Thêm Sản Phẩm Thất Bại</span>";
                    return $alert;
                }
            }
        }
        public function show_product(){

            $query = "SELECT tbl_product.*,tbl_category.catName, tbl_brand.brandName
            from  tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId order by tbl_product.productId desc";
            // $query = "SELECT * from  tbl_product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product where productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data,$files,$id){          
            $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
            $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
            $category = mysqli_real_escape_string($this->db->link,$data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link,$data['price']);
            $type = mysqli_real_escape_string($this->db->link,$data['type']);
            //kiem tra hinh anh va lay hinh anh cho vao folder uploads

            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName==""||$brand==""||$category==""||$product_desc==""||$price==""||$type==""){
                $alert = "<span class='error'>Các Trường Không Được Để Trống</span>";
                return $alert;
            }
            else{
                if(!empty($file_name)){
                    //neu nguoi dung chon anh
                    if($file_size>20480){
                        $alert = "<span class='success'>Kích Thước Ảnh Phải Quá Lớn</span>";
                        return $alert;
                    }
                    elseif(in_array($file_ext,$permited)===false){
                        $alert = "<span class='error'>Bạn Chỉ Có Thể Tải Lên:-".implode(',',$permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tbl_product SET
                     productName ='$productName',
                     brandId ='$brand',
                     catId ='$category',
                     type ='$type',
                     price ='$price',
                     image ='$unique_image', 
                     product_desc ='$product_desc' 
                     WHERE productId = '$id'";
                       $result = $this->db->update($query);
                       if($result){
                           $alert = "<span class='success'>Cập Nhật Sản Phẩm Thành Công</span>";
                           return $alert;
                       }
                       else{
                           $alert = "<span class='error'>Cập Nhật Sản Phẩm Thất Bại</span>";
                           return $alert;
                       }
                }
                else
                    {
                        //neu nguoi dung khong chon anh
                        $query = "UPDATE tbl_product SET
                        productName ='$productName' ,
                        brandId ='$brand' ,
                        catId ='$category' ,
                        type ='$type' ,
                        price ='$price' ,
                        -- image ='$unique_image',
                        product_desc ='$product_desc'  
   
                        WHERE productId = '$id'";
                         $result = $this->db->update($query);
                         if($result){
                             $alert = "<span class='success'>Cập Nhật Sản Phẩm Thành Công</span>";
                             return $alert;
                         }
                         else{
                             $alert = "<span class='error'>Cập Nhật Sản Phẩm Thất Bại</span>";
                             return $alert;
                         }
                    }
            
            // $query = "UPDATE tbl_brand SET brandName ='$brandName' WHERE brandId = '$id'";
          
          }
        }
        public function del_product($id){
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa Sản Phẩm Thành Công</span>";
                return $alert;
            }
            else{
                $alert = "<span class = 'error'>Xóa Sản Phẩm Thất Bại</span>";
                return $alert;
            }
        }
    
        public function getproduct_feathered(){
            $query = "SELECT * FROM tbl_product where type = '0'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function get_details($id){
            $query = "SELECT tbl_product.*,tbl_category.catName, tbl_brand.brandName
            from  tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId where tbl_product.productId = '$id'";
            // $query = "SELECT * from  tbl_product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestDell(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '14' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestOPPO(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '7' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestSamSung(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '8' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestIPhone(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '9' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }

?>    