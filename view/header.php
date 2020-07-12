<?php
if (isset($_REQUEST['controller']) and $_REQUEST['controller'] != 'home') {
    $HTMLheaderClass .= "header nav-scrolled mobile_scroll";
    $HTMLimgSRC = "assets/Images/logo.png";
} else {
    $HTMLheaderClass = "header";
    $HTMLimgSRC = "assets/Images/WhiteLogo.png";
}
?>
<header class="<?php echo $HTMLheaderClass ?>">
    <!--
            IF this nav bar contain "products.php" in $_SERVER['PHP_SELF'];
             then shop card will added only on it not on other pages conatin this header 
        -->
    <!-- <h1 class="site-logo">Fundly</h1> -->
    <a href="/pfa/" class="site__logo"> <img src=<?= $HTMLimgSRC ?> id="logo_site" alt="" class="logo_site"></a>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <div class="header-menu-wrap">
        <nav class="main-nav">
            <ul class="nav__list">
                <li class="nav__list-item"><a href="/pfa/" class="nav__link">Home</a></li>
                <!-- <li class="nav__list-item"><a href="#" class="nav__link">About</a></li>
                <li class="nav__list-item"><a href="#" class="nav__link">Causes</a></li> -->
                <li class="nav__list-item"><a href="/pfa/?controller=product" class="nav__link">Products</a></li>
            </ul>
        </nav>
        <aside class="authenticate">
            <ul class="nav__list">
                <li class="nav__list-item"><a href="/pfa/?controller=client&action=cart" class="nav__link auth-user">My Cart</a></li>
                <?php
                if (isset($_SESSION['userId'])) {
                    echo '<li class="nav__list-item"><a href="/pfa/?controller=client" class="nav__link auth-user">My Account</a></li>
                    <li class="nav__list-item"><a href="?index.php&controller=client&action=logout" class="nav__link auth-user">log out</a></li>
                    ';
                } else {
                    echo '<li class="nav__list-item"><a href="index/client/login/" class="nav__link nav__link--btn">Login</a>
                    </li>
                    <li class="nav__list-item"><a href="index/client/join/" class="nav__link nav__link--btn nav__link--btn--highlight ">Join</a></li>
                ';
                }

                ?>
            </ul>
        </aside>
    </div>

    <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
    </label>
</header>