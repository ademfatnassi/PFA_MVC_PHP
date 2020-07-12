<?php
// session_start();

//$controller = "user";
require_once("{$ROOT}{$DS}model{$DS}ModelUser.php"); // chargement du modèle
require_once("{$ROOT}{$DS}model{$DS}ModelCity.php"); // chargement du modèle
require_once("{$ROOT}{$DS}model{$DS}ModelProduct.php"); // chargement du modèle
require_once("{$ROOT}{$DS}model{$DS}ModelCommand.php"); // chargement du modèle Command
require_once("{$ROOT}{$DS}model{$DS}ModelDetailCommand.php"); // chargement du modèle detailCommand


if (isset($_REQUEST['action'])) {
    /* recupère l'action passée dans l'URL*/
    $action = $_REQUEST['action'];
}
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/ else {
    $action = "account";
}

switch ($action) {
    case "account": {
            if (isset($_SESSION['userId'])) {
                if ($_SESSION['role'] == 1) {
                    header('Location: ?index.php&controller=admin');
                }
            } else {
                header('Location: ?index.php');
            }
            $id = $_SESSION['userId']; // it will be changed for session 'id'
            $pagetitle = "My Account | Fundly";
            $view = "account";
            $HTMLbodyId = "AccountPage";
            $user = ModelUser::select($id);
            require("{$ROOT}{$DS}view{$DS}view.php");
        }
        break;
    case "cart": {
            // session_start();
            if (isset($_SESSION['userId'])) {
                if ($_SESSION['role'] == 1) {
                    header('Location: ?index.php&controller=admin');
                }
            }
            $pagetitle = 'Cart | Fundly';
            $view = "cart";
            $HTMLbodyId = "CartPage";
            $cartList = array();
            // session_start();
            foreach (array_count_values($_SESSION['panier']) as $idProduct => $qte) {
                $p = ModelProduct::select($idProduct);
                array_push($cartList, $p);
            }
            require("{$ROOT}{$DS}view{$DS}view.php");
        }
        break;
    case "removecartitem": {
            // session_start();

            if (isset($_REQUEST['idproduct'])) {
                $IdProductKey = array_search($_REQUEST['idproduct'], $_SESSION['panier']);
                if ($IdProductKey !== false) {
                    unset($_SESSION['panier'][$IdProductKey]);
                    header('Location: ?index.php&controller=client&action=cart');
                }
            }
        }
        break;
    case "command": {
            if (isset($_SESSION['userId'])) {
                $pagetitle = 'My Command | Fundly';
                $view = "command";
                $HTMLbodyId = "CommandPage";
                $tab_com = ModelCommand::getAllByColumn("idUser", $_SESSION['userId']);
                require("{$ROOT}{$DS}view{$DS}view.php");
            }
        }
        break;
    case "edit": {
            if (isset($_SESSION['userId'])) {
                if ($_SESSION['role'] == 1) {
                    header('Location: ?index.php&controller=admin');
                }
                $id = $_SESSION['userId'];
                $pagetitle = 'Edit Profile | Fundly';
                $view = "edit";
                $HTMLbodyId = "updateaccountPage";
                $user = ModelUser::select($id);
                $tab_c = ModelCity::getAll();
                require("{$ROOT}{$DS}view{$DS}view.php");
            }
        }
        break;
    case "join": {
            if (isset($_SESSION['role']) and $_SESSION['role'] == 2) {
                header('Location: /pfa/index/client/');
            } elseif (isset($_SESSION['role']) and $_SESSION['role'] == 1) {
                header('Location: ?index.php&controller=admin');
            }
            $pagetitle = 'Join | Fundly';
            $view = "join";
            $HTMLbodyId = "JoinPage";
            $tab_c = ModelCity::getAll(); //appel au modèle pour gerer la BD
            require("{$ROOT}{$DS}view{$DS}view.php");
        }
        break;
    case "created":
        if (isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['phone']) && isset($_REQUEST['gender']) && isset($_REQUEST['BDate']) && isset($_REQUEST['region']) && isset($_REQUEST['addresse']) && isset($_REQUEST['zip']) && isset($_REQUEST['email']) && isset($_REQUEST['pwd'])) {
            $idUser = NULL;
            $nom = $_REQUEST['lname'];
            $prenom = $_REQUEST['fname'];
            $phone = $_REQUEST['phone'];
            $birthDate = $_REQUEST['BDate'];
            $addresse = $_REQUEST['addresse'];
            $zip = $_REQUEST['zip'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['pwd'];
            $gender = $_REQUEST['gender'];
            $role = 2;
            $uStatus = 1;
            $idCity = $_REQUEST['region'];
            $inscritDate = date("Y-m-d");

            $recherche = ModelUser::findUserByEmail($email);

            if ($recherche == null) {
                $u = new ModelUser($idUser, $nom, $prenom, $phone, $birthDate, $addresse, $zip, $email, $password, $gender, $idCity, $role, $uStatus,  $inscritDate);
                $tab = array(
                    "idUser" => $idUser,
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "phone" => $phone,
                    "birthDate" => $birthDate,
                    "addresse" => $addresse,
                    "zip" => $zip,
                    "email" => $email,
                    "password" => md5($password),
                    "gender" => $gender,
                    "idCity" => $idCity,
                    "role" => $role,
                    "uStatus" => $uStatus,
                    "inscritDate" => $inscritDate,
                );
                $u->insert($tab);
                // $pagetitle = 'Account Creation';
                // $view = "created";
                // $HTMLbodyId = "";
                // require("{$ROOT}{$DS}view{$DS}view.php");
                $msg = "Inscription avec success";
                $pagetitle = 'Account Creation';
                $view = "created";
                $HTMLbodyId = "accountCreation";
                require("{$ROOT}{$DS}view{$DS}view.php");
            } else {
                $msg = "Verify your email, please!";
                $pagetitle = 'Account Failed to Create';
                $view = "failToCreate";
                $HTMLbodyId = "accountCreation";
                require("{$ROOT}{$DS}view{$DS}view.php");
            }
        }
        break;
    case "login": {
            if (isset($_SESSION['role']) and $_SESSION['role'] == 2) {
                header('Location: ?index.php');
            } elseif (isset($_SESSION['role']) and $_SESSION['role'] == 1) {
                header('Location: ?index.php&controller=admin');
            }
            $pagetitle = 'Login | Fundly';
            $view = "login";
            $HTMLbodyId = "LoginPage";
            require("{$ROOT}{$DS}view{$DS}view.php");
        }
        break;
    case "desactive": {
            if (isset($_SESSION['userId'])) {
                $id = $_SESSION['userId'];
                $user = ModelUser::select($id);
                if ($user != NULL) {
                    $tab = array(
                        "uStatus" => 2,
                    );
                    $u = $user->update($tab, $id);
                    session_start();
                    session_unset();
                    session_destroy();
                    header('location: ?index.php&controller=client&action=login');
                } else {
                    header('Location: ?index.php&controller=client&action=edit');
                }

                require("{$ROOT}{$DS}view{$DS}view.php");
            }
        } //desactive/
        break;
    case "delete": {
            if (isset($_SESSION['userId'])) {
                $id = $_SESSION['userId'];
                $del = ModelUser::select($id);
                if ($del != null) {
                    $del->delete($id);
                    session_start();
                    session_unset();
                    session_destroy();
                    header('location: ?index.php&controller=client&action=login');
                } else {
                    header('Location: ?index.php');
                }

                require("{$ROOT}{$DS}view{$DS}view.php");
            }
        } //desactive/
        break;
    case "check": {
            // Recuperer de XMLHttpRequest de la viewJoinClient
            // pour vérifier l'existance d'un email dans ma base
            $q = $_GET["q"];
            $recherche = ModelUser::findUserByEmail($q);
            if ($recherche != NULL) {
                echo $recherche->email;
            }
        }
        break;
    case "afterlogin": {
            // Recuperation des paramètres après le login
            if ($_REQUEST["email"] and  $_REQUEST["pwd"]) {

                $email = $_REQUEST["email"];
                $pwd = $_REQUEST["pwd"];

                // $pwd = MD5($_REQUEST["pwd"]);

                $recherche = ModelUser::login($email, md5($pwd));

                print_r($recherche);

                if ($recherche != null and  $recherche->getUStatus() != 2) {
                    session_start();
                    $_SESSION['userId'] = $recherche->getIdUser();
                    $_SESSION['role'] = $recherche->Role;
                    // $_SESSION['panier'] = array();
                    if ($recherche->Role == 1) {
                        header("Location: ?index.php&controller=admin}");
                    }
                    header("Location: ?index.php&controller=client&id={$recherche->getIdUser()}");
                    // $msg = "login avec success";
                    // $pagetitle = 'Account Creation';
                    // $view = "created";
                    // $HTMLbodyId = "accountCreation";
                    // require("{$ROOT}{$DS}view{$DS}view.php");
                } else {
                    $msg = "Something Wrong ...";
                    $pagetitle = 'Account Failed to login';
                    $view = "failToCreate"; // redirect me to this view to display $msg
                    $HTMLbodyId = "accountCreation";
                    require("{$ROOT}{$DS}view{$DS}view.php");
                }
            } else {
                header("Location: ?index.php&controller=client&action=login");
            }
        }
        break;
    case "logout": {
            session_start();
            session_unset();
            session_destroy();
            header('location: ?index.php&controller=client&action=login');
        }
        break;
    case "updated": {
            $pagetitle = "";
            $view = "";
            $HTMLbodyId = "";
            $oldId = $_REQUEST['id'];
            $user = ModelUser::select($_REQUEST['id']);

            #1 condition: firstname & lastname & BirthDate & gender been updated
            if (isset($_REQUEST['id']) && isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['BDate'])) {
                // echo $_REQUEST['id'] . " " . $_REQUEST['fname'] . " " . $_REQUEST['lname'] . " " . $_REQUEST['BDate'] . "<br>";
                $user->Prenom = $_REQUEST['fname'];
                $user->Nom = $_REQUEST['lname'];
                $user->BirthDate = $_REQUEST['BDate'];
            } elseif (isset($_REQUEST['email']) && isset($_REQUEST['pwd'])) {
                // echo $_REQUEST['email'] . " pass: " . empty($_REQUEST['pwd']) . "<br>";
                $user->Email = $_REQUEST['email'];
                $user->Password = md5($_REQUEST['pwd']);
                // password here
            } elseif (isset($_REQUEST['addresse']) && isset($_REQUEST['region']) && isset($_REQUEST['zip']) && isset($_REQUEST['phone'])) {
                // echo $_REQUEST['region'] . " " . $_REQUEST['addresse'] . " " . $_REQUEST['zip'] . " " . $_REQUEST['phone'] . "<br>";
                $user->Adresse = $_REQUEST['addresse'];
                $user->setIdCity($_REQUEST['region']);
                $user->ZIP = $_REQUEST['zip'];
                $user->Phone = $_REQUEST['phone'];
            }
            // echo "<br>";
            // print_r($user);

            $inscritDate = $user->getInscritDate(); //get old value from database

            $nom = $user->Nom;
            $prenom = $user->Prenom;
            $phone = $user->Phone;
            $birthDate = $user->BirthDate;
            $addresse = $user->Adresse;
            $zip = $user->ZIP;
            $email = $user->Email;
            $password = $user->Password;
            if (empty($password)) {
                $password = $user->Password;
            } else {
                # Some treatment here if I decied to crypt new password
                $password = $user->Password;
            }
            $gender = $user->Gender;
            $role = $user->Role;
            $uStatus = $user->getUStatus();
            $idCity = $user->getIdCity();


            $tab = array(
                "idUser" => $oldId,
                "nom" => $nom,
                "prenom" => $prenom,
                "phone" => $phone,
                "birthDate" => $birthDate,
                "adresse" => $addresse,
                "zip" => $zip,
                "email" => $email,
                "password" => $password,
                "gender" => $gender,
                "idCity" => $idCity,
                "role" => $role,
                "uStatus" => $uStatus,
                "inscritDate" => $inscritDate
            );
            print_r($tab);
            if ($user != null) {
                $u = $user->update($tab, $oldId);
                header('Location: ?index.php&controller=client&action=edit&id=' . $oldId);
            } else {
                echo "Somthing wrong I can feel it";
            }
        } //users/task/updated/
        break;
}
