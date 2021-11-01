<?php
    include 'inc/header.php';
?>
<?php
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/category.php';
?>
<?php
    $cat = new category();
    if(!isset($_GET['catId']) || $_GET['catId']==NULL){
        echo "<script>window.location ='catlist.php'</script>";
    }
    else{
        $id = $_GET['catId'];
    }
    
    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $catName = $_POST['catName'];
        $updatecat = $cat->update_category($catName,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa Danh Mục</h2>
        
        <div class="block copyblock">
        <?php
        if(isset($updatecat)){
            echo $updatecat;
        }
        ?>
        <?php
            $get_cate_name = $cat->getcatbyid($id);
            if($get_cate_name){
                while($result = $get_cate_name->fetch_assoc()){
        ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['catName']?>" name="catName" class="medium" placeholder="Sửa danh mục sản phẩm"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="update"/>
                        </td>
                    </tr>
                </table>
            </form>
    <?php
                }
            }
    ?>
        </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>