<?php
session_start();
// ob_start();
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
                    <h1 class="login-header">Đăng nhập</h1>
                    <input class="input-box input-email" type="text" name="email" required placeholder="Email">
                    <!-- <span class="focus-input">
                        <i class="ti-email"></i>
                    </span> -->
                    <input class="input-box input-pass" type="password" name="password" required placeholder="Password">
                    <input class="submit-input" type="submit" name="submit-login" value="ĐĂNG NHẬP">
                    <a class="forgot-account" href="#">Quên tài khoản/ Mật khẩu?</a> <br>
                    <a class="create-account" href="./index.php?page=register">Tạo tài khoản mới <i class="ti-arrow-right"></i> </a>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['submit-login'])) {

    // $email = ($_POST['email']);
    // $password = ($_POST['password']);

    // fix
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);

    $sql = "SELECT * FROM USERS WHERE USER_EMAIL='$email' AND USER_PASSWORD='$password'";
    // $sql = "SELECT * FROM USERS WHERE USER_EMAIL='$email' AND USER_PASSWORD='$password'";
    $result = mysqli_query($connect, $sql);


    if (!mysqli_num_rows($result)) {
        echo "<script>alert('Đăng nhập thất bại!');</script>";
        die();
    }
    $row = mysqli_fetch_array($result);


    $_SESSION['email'] = $row['USER_EMAIL'];

    if ($row['USER_ROLE'] == 1) {
        $_SESSION['role'] = 1;
        header("Location: ./admin/index.php");
        // die();
    } else if ($row['USER_ROLE'] == 2) {
        $_SESSION['role'] = 2;
        header("Location: ./index.php");
        // die();
    }
}
?>