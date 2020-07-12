<?php

if (isset($_SESSION['userId']) and $_SESSION['userId'] == 1) {
    header('Location: ?index.php&controller=admin');
}

require_once("{$ROOT}{$DS}model{$DS}ModelProduct.php"); // chargement du modèle Product
require_once("{$ROOT}{$DS}model{$DS}ModelTheme.php"); // chargement du modèle Theme


if (isset($_REQUEST['action'])) {
    /* recupère l'action passée dans l'URL*/
    $action = $_REQUEST['action'];
}
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/ else {
    $action = "readAll";
}

switch (strtolower($action)) {
    case "readall": {
            $pagetitle = "Product | Fundly";
            $view = "readAll";
            $HTMLbodyId = "ProductsPage";
            $tab_t = ModelTheme::getAll();
            if (isset($_REQUEST['theme'])) {
                /* recupère l'theme passée dans l'URL*/
                $theme = $_REQUEST['theme'];
                settype($theme, "int"); // set theme type to handle it after, to display product of theme
                $tab_p = ModelProduct::selectAll($theme);
            } elseif (isset($_REQUEST['search'])) {
                $tab_p = ModelProduct::search($_REQUEST['search']);
            } else {
                $theme = NULL;
                $tab_p = ModelProduct::selectAll($theme);
            }
            // if (count(ModelProduct::selectAll($theme)) == 0) {
            //     $tab_p = ModelProduct::selectAll(NULL);
            //     // if there is no product with same idTheme we pass NULL to the methode and display all products 
            // } else {
            //     $tab_p = ModelProduct::selectAll($theme);
            // }
            require("{$ROOT}{$DS}view{$DS}view.php");
            break;
        }

    case "read":
        if (isset($_REQUEST['id']) and $_REQUEST['id'] != NULL) {
            $id = $_REQUEST['id'];
            $p = ModelProduct::select($id);
            if ($p != null) {
                $pagetitle =  $p->getTitle() . ' | Fundly';
                $view = "read";
                $HTMLbodyId = "ProductItemPage";
                require("{$ROOT}{$DS}view{$DS}view.php");
            }
            break;
        } else {
            // Redirect to 404 page
            header('Location:www.google.com');
        }
    case 'addtocart':
        if (isset($_REQUEST['idproduct'])) {
            session_start();
            array_push($_SESSION['panier'], $_REQUEST['idproduct']);
            header('Location:?index.php&controller=product&action=read&id=' . $_REQUEST['idproduct']);
        }
        break;
}
