<!DOCTYPE html>
<html lang="EN">

<head>
    <base href="/pfa/">
    <meta charset="UTF-8">
    <!-- 
        #StyleSheet: 
            1: W3.css[FrameWork we used in EditClientView and some other Views for InfoCollapse and tables] 
            2: custum CSS 
    -->
    <link rel="stylesheet" href="CSS/w3.css">

    <link rel="stylesheet" href="CSS/style.css">

    <!-- Datatables CSS for some table :)-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">


    <!--FaviICON-->
    <link rel="icon" href="./assets/Images/logo.ico" />

    <!-- FontAwesome Icons for some icons we used in some views -->
    <!--Icon I used in navigation bar (right arrow)-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

    <title> <?php echo $pagetitle; ?> </title>
</head>

<?php
/**
 * THIS SECTION OF CODE IS TO RENDER the navbar 
 * and add classes to behave in different form
 * like adding boxshadow and some IntersectionObserver 
 * while scrolling the navbar
 */
$HTMLheaderClass = "header";
$HTMLonLoadTag = "onload=\"name('nav-scrolled')\"";
if (isset($_REQUEST['controller']) and $_REQUEST['controller'] != 'home') {
    $HTMLheaderClass .= " nav-scrolled mobile_scroll";
    $HTMLonLoadTag = '';
}
?>

<body id="<?= $HTMLbodyId ?>" <?= $HTMLonLoadTag ?>>
    <?php
    $home_default_conroller = "home";
    if (!isset($_REQUEST['controller']))
        $control = $home_default_conroller;
    else
        $control = $_REQUEST['controller'];

    switch (strtolower($control)) {
        case "home":
        case "product":
            require_once($ROOT . $DS . "view" . $DS . "header.php");
            break;
        case "admin": {

                if (isset($_REQUEST['action']) and $_REQUEST['action'] != "dashboard") {
                    if (isset($_REQUEST['task']) and $_REQUEST['task'] == "created" and $_REQUEST['task'] != "updated") {
                    } else {
                        require_once($ROOT . $DS . "view" . $DS . "sideNavbar.php");
                    }
                }
            }
            break;
        case "client":
            if (!isset($_REQUEST['action']))
                //$controller récupère $controller_default;
                $act = "account";
            else
                // $controller recupère le contrôleur passé dans l'URL
                $act = $_REQUEST['action'];
            switch ($act) {
                case "account":
                case "cart":
                case "edit":
                case "command": {
                        require_once($ROOT . $DS . "view" . $DS . "header.php");
                    }
                    break;
            }
            break;
    }

    // filepath détermine le chemin de la vue en fonction de $controller
    $filepath = $ROOT . $DS . "view" . $DS . $controller . $DS;
    // filename détermine le nom du fichier
    $filename = "view" . ucfirst($view) . ucfirst($controller) . '.php';
    require_once($filepath . $filename);
    // require_once($ROOT . $DS . "view" . $DS . "footer.php");
    ?>
</body>

</html>