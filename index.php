<?php
session_start();
if (!array_key_exists('panier', $_SESSION)) {
    $_SESSION['panier'] = array();
}
/* __DIR__ est une constante "magique" de PHP qui contient le
chemin du dossier courant */
$ROOT = __DIR__;
/* DS contient '/' sur Linux et '\' sur Windows*/
$DS = DIRECTORY_SEPARATOR;
$controleur_default = "home";
if (!isset($_REQUEST['controller']))
    //$controller récupère $controller_default;
    $controller = $controleur_default;
else
    // $controller recupère le contrôleur passé dans l'URL
    $controller = $_REQUEST['controller'];
switch (strtolower($controller)) {
    case "command":
        require("{$ROOT}{$DS}controller{$DS}controllerCommand.php");
        break;
    case "home":
        require("{$ROOT}{$DS}controller{$DS}controllerHome.php");
        break;
    case "product":
        require("{$ROOT}{$DS}controller{$DS}controllerProduct.php");
        break;
    case "client":
        require("{$ROOT}{$DS}controller{$DS}controllerClient.php");
        break;
    case "admin":
        require("{$ROOT}{$DS}controller{$DS}controllerAdmin.php");
        break;
}
