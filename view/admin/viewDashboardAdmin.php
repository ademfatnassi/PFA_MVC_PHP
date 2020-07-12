<?php
// session_start();
// if (isset($_SESSION['userId'])) {
//     if ($_SESSION['role'] == 1) {
//         echo "Login as Admin";
//     } else {
//         echo "Login as client";
//         header('Location: /pfa/index.php');
//     }
// } else {
//     echo "no session variable";
// }
?>
<img style="position: absolute;top: 1em;left: 1em;" src="assets/Images/WhiteLogo.png" alt="" class="white_logo">
<div class="dash_left"></div>
<div class="dash_right">
    <a href="?index.php&controller=admin&action=users" class="dash_opert"><i class="fas fa-users    "></i> Users Management</a>
    <a href="?index.php&controller=admin&action=themes" class="dash_opert"><i class="fas fa-chart-pie    "></i> Themes Management</a>
    <a href="?index.php&controller=admin&action=products" class="dash_opert"><i class="fab fa-product-hunt    "></i> Products Management</a>
    <a href="?index.php&controller=admin&action=commands" class="dash_opert"><i class="fas fa-box    "></i> Commands Management</a>
</div>