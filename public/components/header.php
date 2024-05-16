<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>

<header class="row header">
        <div class="web-logo col-lg-3 col-md-2">
            <a href="./index.php"><img src="./public/assets/img/logo.png" class="header-logo" alt="Logo" /></a>
        </div>
        <div class="search-bar col-lg-4 col-md-3">
            <form action="search.php" method="post">
                <input type="text" class="search-product" placeholder="Sản phẩm..." />
                <span class="input-group-text search-btn btn"><i class="ti-search"></i></span>
                </input>
            </form>
        </div>
        <div class="header-function col-lg-5 col-md-7">
            <div class="search-order-btn btn text-center text-break"><a href="
            <?php
                if (isset($_SESSION['role']) && ($_SESSION['role'] == 2)) {
                    echo "./index.php?page=purchase-history";
                }
                else{
                    echo "./index.php?page=login";
                }
            ?>  
            ">Tra cứu đơn hàng</a></div>
            
            <?php
                if (isset($_SESSION['role']) && ($_SESSION['role'] == 2)) {
                    echo "<div class=\"login-btn btn text-center\"><a href=\"./admin/backend/logout.php\">Xin chào<br />".$_SESSION['email']."</a></div>";
                }
                else{
                    echo "<div class=\"login-btn btn text-center\"><a href=\"./index.php?page=login\">Đăng kí<br />Đăng nhập</a></div>";
                }
            ?>
            <div class="cart-btn btn align-right col"><a href="./index.php?page=cart">Giỏ hàng <i class="ti-shopping-cart"></i></a></div>
        </div>
</header>

