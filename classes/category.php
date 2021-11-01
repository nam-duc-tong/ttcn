<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/dbhelper.php');
?>
<?php
    class category{  
        private $fm;
        private $db;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }
        public function insert_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName); 
            if(empty($catName)){
                $alert = "<span class= 'success'>Category must be not empty</span>";
                return $alert;
            }
            else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result = $this->db->insert($query);    
                if($result){
                    $alert = "<span class= 'success'>Insert Category Successfully</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class= 'error'>Insert Category Not Success</span>";
                    return $alert;
                }
            }
        }
        public function show_category(){
            $query = "SELECT * from  tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getcatbyid($id){
            $query = "SELECT * FROM tbl_category where catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_category($catName,$id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $id = mysqli_real_escape_string($this->db->link,$id);
            if(empty($catName)){
                $alert = "<span class='error'>category must be not empty</span>";
                return $alert;
            }
            else{
                $query = "UPDATE tbl_category SET catName ='$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Category Update Successfully</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class='error'>Category Updated Not Success</span>";
                    return $alert;
                }
            }
        } 
        public function del_category($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'> Category Deleted SuccessLy</span>";
                return $alert;
            }
            else{
                $alert = "<span class = 'error'> Category  Delete NOT Success</span>";
                return $alert;
            }
        }
        public function show_category_fontend(){
            $query = "SELECT * from  tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_product_by_cat($id){
            $query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_name_by_cat($id){
            $query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM  tbl_product,tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }

?>    