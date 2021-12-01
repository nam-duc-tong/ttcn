<?php
session_start();
    require_once '../classes/adminlogin.php';
?>
<?php

$adminPass = $adminUser = ''; 
    $class = new adminlogin();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);
        $login_check = $class->login_admin($adminUser,$adminPass);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
    <div class="container">
        <section id="content">
            <form action="login.php" method="post">
                <h1>Đăng Nhập Quản Trị Viên</h1>
                <span>
                    <?php
                        if(isset($login_check)){
                            echo $login_check;
                        }
                    ?>
                </span>
                <div>
                    <input type="text" name="adminUser" placeholder="Tên Người Dùng"/>
                </div>
                <div>
                    <input type="password" name="adminPass" placeholder="Mật Khẩu"/>
                </div>
                <div>
                    <input type="submit" value="Đăng Nhập" />
                </div>
            </form>
            <div class="button">
                <a href="http://localhost/project_phone/orderdetails.php?id=live">Shop Bán Hàng</a>
            </div>
        </section>
    </div>
</body>
</html>