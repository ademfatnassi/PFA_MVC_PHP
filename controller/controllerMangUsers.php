<?php
if (isset($_REQUEST['task'])) {
    /* recupère l'task passée dans l'URL*/
    $task = $_REQUEST['task'];
}
/* NB: On a ajouté un comportement par défaut avec task=readAll.*/ else {
    $task = "mangusers";
}

switch ($task) {
    case "all": {
            $pagetitle = "ADMIN USERs Managment | Fundly";
            $view = "mangusers";
            $HTMLbodyId = "aUserManagment";
            require("{$ROOT}{$DS}view{$DS}view.php");
        }
        break;
}
