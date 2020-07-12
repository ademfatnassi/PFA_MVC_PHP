<?php

// print_r($_SESSION);
if (isset($_SESSION['userId']) and $_SESSION['role'] == 1) {
    header('Location: ?index.php&controller=admin');
}

$pagetitle = "Fundly | website";
$view = "page";
$HTMLbodyId = "Homepage";
//"redirige" vers la vue
require("{$ROOT}{$DS}view{$DS}view.php");
