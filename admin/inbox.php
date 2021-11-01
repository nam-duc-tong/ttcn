<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
 $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
    // echo "<script>window.location = 'productlist.php'</script>";
    include_once ($filepath.'/../helpers/dbhelper.php');
?>
<?php
$ct = new cart();
 if(isset($_GET['shiftid'])){
    $Id = $_GET['shiftid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted = $ct->shifted($Id,$time,$price);
 }

 if(isset($_GET['delid'])){
    $Id = $_GET['delid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $del_shifted = $ct->del_shifted($Id,$time,$price);
 }  
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <?php
                if(isset($shifted)){
                    echo $shifted;
                }
            ?>
             <?php
                if(isset($del_shifted)){
                    echo $del_shifted;
                }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order Time</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>CustomerID</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $ct = new cart();
                        $fm = new format();
                        $get_inbox_cart = $ct->get_inbox_cart();
                        if($get_inbox_cart){
                            $i = 0;
                            while($result = $get_inbox_cart->fetch_assoc()){
                            ++$i;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i?></td>
                        <td><?php echo $fm->formatDate($result['date_order'])?></td>
                        <td><?php echo $result['productName']?></td>
                        <td><?php echo $result['quantity']?></td>
                        <td><?php echo $result['price'].' '.' VND'?></td>
                        <td><?php echo $result['customer_Id']?></td>
                        <td><a href="customer.php?customerId=<?php echo $result['customer_Id']?>">View Customer</a></td>
                        <td>
                            <?php
                                if($result['status']=='0')
                                {
                            ?>
                                <a href="?shiftid=<?php echo $result['Id']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Đang xử lý</a>
                            <?php
                                }
                                elseif($result['status']=='1'){       
                                    ?>
                                    <?php
                                    echo 'Đang vận chuyển';
                                ?>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="?delid=<?php echo $result['Id']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Xóa</a>   
                                  <?php
                                }
                                ?>
                        </td>
                    </tr>
                    <?php                            
                           }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
</script>
<?php include 'inc/footer.php'?>