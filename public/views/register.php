<?php
    session_start();
?>

<link rel="stylesheet" href="./public/assets/css/authentication.css" />

<section>
    <div class="container">
        <div class="frame">
            <div class="login-img col-half">
                <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png" alt="Picture">
            </div>

            <div class="login-form col-half">

                <form class="form" method="POST">
                    <h1 class="signup-header">Tạo tài khoản</h1>
                    <input class="input-box" type="test" name="fullname" placeholder="Full name" required>
                    <input class="input-box input-email" type="text" name="email" placeholder="Email" required>
                    <!-- <span class="focus-input">
                        <i class="ti-email"></i>
                    </span> -->
                    <input class="input-box" type="password" name="password" placeholder="Password" required>
                    <input class="input-box" type="password" name="repassword" placeholder="Confirm password" required>

                    <input class="submit-input" type="submit" name="submit-signup" value="ĐĂNG KÍ">

                    <a class="create-account" href="./index.php?page=login">Bạn đã có tài khoản? <i class="ti-arrow-right"></i> </a>
                </form>
            </div>
        </div>
    </div>
</section>


<?php
if (isset($_POST['submit-signup'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if (!$fullname || !$email || !$password || !$repassword) {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        die();
    }

    if ($password != $repassword) {
        echo "<script>alert('Mật khẩu không giống nhau!');</script>";
        die();
    }

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM USERS WHERE USER_EMAIL='$email'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result)) {
        echo "<script>alert('Email này đã tồn tại!');</script>";
        // Chuyển hướng về trang chủ hoặc trang khác
        // header("Location: ./index.php?page=login");
        die();
    }

    $sql_insert = "INSERT INTO users (USER_EMAIL, USER_PASSWORD,USER_NAME , USER_ROLE, USER_STATE, CREATE_DATE, LAST_LOGIN)
        VALUES ('$email', '$password', '$fullname' , 2, 'active', NOW(), NOW())";
    $result = mysqli_query($connect, $sql_insert);

    if ($result) {
        // Hiển thị popup thông báo đăng ký thành công sử dụng JavaScript
        echo "<script>alert('Đăng ký thành công!');</script>";
        // Chuyển hướng về trang chủ hoặc trang khác
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 2;
        header("Location: ./index.php");
        // die();
    } else {
        echo "<script>alert('Đăng ký thất bại!');</script>";
        // Chuyển hướng về trang chủ hoặc trang khác
        // header("Location: ./index.php?page=register");
        // die();
    }
}

?>