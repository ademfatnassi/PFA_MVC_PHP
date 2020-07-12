<?php
if (!isset($_SESSION['userId']) or $_SESSION['role'] == 2) {
    header('Location: ?index.php');
}
require_once("{$ROOT}{$DS}model{$DS}ModelUser.php"); // Chargement du modèle User
require_once("{$ROOT}{$DS}model{$DS}ModelCity.php"); // chargement du modèle City
require_once("{$ROOT}{$DS}model{$DS}ModelTheme.php"); // chargement du modèle Theme
require_once("{$ROOT}{$DS}model{$DS}ModelProduct.php"); // chargement du modèle Product
require_once("{$ROOT}{$DS}model{$DS}ModelCommand.php"); // chargement du modèle Command
require_once("{$ROOT}{$DS}model{$DS}ModelDetailCommand.php"); // chargement du modèle detailCommand


if (isset($_REQUEST['action'])) {
    /* recupère l'action passée dans l'URL*/
    $action = $_REQUEST['action'];
}
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/ else {
    $action = "dashboard";
}

switch ($action) {
    case "dashboard": {
            $pagetitle = "ADMIN Dashboard | Fundly";
            $view = "dashboard";
            $HTMLbodyId = "admin__dash";
            require("{$ROOT}{$DS}view{$DS}view.php");
        } //dashboard
        break;
    case "logout": {
            session_start();
            session_unset();
            session_destroy();
            header('location: ?index.php&controller=client&action=login');
        }
        break;
    case "users": {
            // require("{$ROOT}{$DS}controller{$DS}controllerMangUsers.php");
            if (isset($_REQUEST['task'])) {
                /* recupère l'task passée dans l'URL*/
                $task = $_REQUEST['task'];
            }
            /* NB: On a ajouté un comportement par défaut avec task=readAll.*/ else {
                $task = "all";
            }

            switch ($task) {
                case "all": {
                        $pagetitle = "ADMIN USERs Managment | Fundly";
                        $view = "AllUsers";
                        $HTMLbodyId = "aUserManagment";
                        $tab_u = ModelUser::getAll();
                        require("{$ROOT}{$DS}view{$DS}view.php");
                    } //themes/task/all/
                    break;

                case "detail": {
                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $pagetitle = "ADMIN USER id details | Fundly";
                            $view = "detailUser";
                            $HTMLbodyId = "aUserManagment";
                            $user = ModelUser::select($id);
                            $city = ModelCity::select($user->getIdCity());
                            $tab_com = ModelCommand::getAllByColumn("idUser", $id);
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } //users/task/detail
                    break;
                case "active": {
                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $user = ModelUser::select($id);
                            if ($user != NULL) {
                                $tab = array(
                                    "uStatus" => 1,
                                );
                                $u = $user->update($tab, $id);
                                header('Location: ?index.php&controller=admin&action=users');
                            } else {
                                header('Location: ?index.php&controller=admin&action=users');
                            }

                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } // users/task/active/:id
                case "desactive": {
                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $user = ModelUser::select($id);
                            if ($user != NULL) {
                                $tab = array(
                                    "uStatus" => 2,
                                );
                                $u = $user->update($tab, $id);
                                header('Location: ?index.php&controller=admin&action=users');
                            } else {
                                header('Location: ?index.php&controller=admin&action=users');
                            }

                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } //users/task/desactive/:id
                    break;
                case "edit":
                case "add": {
                        $view = "inputUser";
                        $HTMLbodyId = "aUserManagment";
                        $tab_c = ModelCity::getAll(); //appel au modèle pour gerer la BD
                        if ($task == "edit") {
                            if (isset($_REQUEST['id'])) {
                                $id = $_REQUEST['id'];
                                $pagetitle = "ADMIN USER EDIT| Fundly";
                                $btnSendValue = "Edit";
                                $user = ModelUser::select($id);
                                $actionForm = "?index.php&controller=admin&action=users&task=updated&id=" . $user->getIdUser();
                                require("{$ROOT}{$DS}view{$DS}view.php");
                            }
                        } else {
                            $pagetitle = "ADMIN USER ADD | Fundly";
                            $btnSendValue = "Add";
                            // $tab_c = ModelCity::getAll(); //appel au modèle pour gerer la BD
                            $actionForm = "?index.php&controller=admin&action=users&task=created";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } // users/task/add - users/task/edit
                    break;
                case "created": {
                        if (
                            isset($_REQUEST['fname']) && isset($_REQUEST['lname'])
                            && isset($_REQUEST['phone']) && isset($_REQUEST['gender'])
                            && isset($_REQUEST['BDate']) && isset($_REQUEST['region'])
                            && isset($_REQUEST['addresse']) && isset($_REQUEST['zip'])
                            && isset($_REQUEST['email']) && isset($_REQUEST['pwd'])
                            && isset($_REQUEST['status']) && isset($_REQUEST['role'])
                        ) {
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
                            $role = $_REQUEST['role'];
                            $uStatus = $_REQUEST['status'];
                            $idCity = $_REQUEST['region'];

                            $inscritDate = date("Y-m-d");

                            // $recherche = ModelUser::findUserByEmail($email);


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
                                "password" => $password,
                                "gender" => $gender,
                                "idCity" => $idCity,
                                "role" => $role,
                                "uStatus" => $uStatus,
                                "inscritDate" => $inscritDate,
                            );
                            $u->insert($tab);
                            $pagetitle = 'Account Creation';
                            $view = "created";
                            $HTMLbodyId = "";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        } else {
                            $pagetitle = 'Account Creation';
                            $view = "failedToCreate";
                            $HTMLbodyId = "";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } //users/task/created
                    break;
                case "updated": {
                        $pagetitle = "";
                        $view = "";
                        $HTMLbodyId = "";
                        if (
                            isset($_REQUEST['id']) && isset($_REQUEST['fname']) && isset($_REQUEST['lname'])
                            && isset($_REQUEST['phone']) && isset($_REQUEST['gender'])
                            && isset($_REQUEST['BDate']) && isset($_REQUEST['region'])
                            && isset($_REQUEST['addresse']) && isset($_REQUEST['zip'])
                            && isset($_REQUEST['email']) && isset($_REQUEST['pwd'])
                            && isset($_REQUEST['status']) && isset($_REQUEST['role'])
                        ) {
                            $oldId = $_REQUEST['id'];
                            $user = ModelUser::select($_REQUEST['id']);
                            $inscritDate = $user->getInscritDate(); //get old value from database

                            $nom = $_REQUEST['lname'];
                            $prenom = $_REQUEST['fname'];
                            $phone = $_REQUEST['phone'];
                            $birthDate = $_REQUEST['BDate'];
                            $addresse = $_REQUEST['addresse'];
                            $zip = $_REQUEST['zip'];
                            $email = $_REQUEST['email'];
                            $password = $_REQUEST['pwd'];
                            if (empty($password)) {
                                $password = $user->Password;
                            } else {
                                # Some treatment here if I decied to crypt new password
                            }
                            $gender = $_REQUEST['gender'];
                            $role = $_REQUEST['role'];
                            $uStatus = $_REQUEST['status'];
                            $idCity = $_REQUEST['region'];


                            $tab = array(
                                "idUser" => $oldId,
                                "nom" => $nom,
                                "prenom" => $prenom,
                                "phone" => $phone,
                                "birthDate" => $birthDate,
                                "adresse" => $addresse,
                                "zip" => $zip,
                                "email" => $email,
                                "password" => md5($password),
                                "gender" => $gender,
                                "idCity" => $idCity,
                                "role" => $role,
                                "uStatus" => $uStatus,
                                "inscritDate" => $inscritDate
                            );
                            if ($user != null) {
                                $u = $user->update($tab, $oldId);
                                header('Location: ?index.php&controller=admin&action=users');
                                // print_r($u, false);
                                // print_r($user, false);
                                // print_r($tab, false);
                            } else {
                                echo "ff";
                            }
                        }
                    } //users/task/updated/
                    break;
                case "delete":
                    if (isset($_REQUEST['id'])) {
                        $id = $_REQUEST['id'];
                        $del = ModelUser::select($id);
                        if ($del != null) {
                            $del->delete($id);
                            header('Location: ?index.php&controller=admin&action=users');
                        }
                    }
                    //users/task/delete
                    break;
            } //users/task
        } //users
        break;
    case "products": {
            // require("{$ROOT}{$DS}controller{$DS}controllerMangUsers.php");
            if (isset($_REQUEST['task'])) {
                /* recupère l'task passée dans l'URL*/
                $task = $_REQUEST['task'];
            }
            /* NB: On a ajouté un comportement par défaut avec task=all.*/ else {
                $task = "all";
            }

            switch ($task) {
                case "all": {
                        $pagetitle = "ADMIN PRODUCTs Managment | Fundly";
                        $view = "AllProducts";
                        $HTMLbodyId = "aUserManagment";
                        $tab_p = ModelProduct::getAll();
                        require("{$ROOT}{$DS}view{$DS}view.php");
                    } //product/task/all/
                    break;

                case "detail": {
                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $pagetitle = "ADMIN PRODUCT id details | Fundly";
                            $view = "detailProduct";
                            $HTMLbodyId = "aUserManagment";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } // product/task/detail/
                    break;
                case "edit":
                case "add": {
                        $view = "inputProduct";
                        $HTMLbodyId = "aUserManagment";
                        $tab_t = ModelTheme::getAll();
                        if ($task == "edit") {
                            if (isset($_REQUEST['id'])) {
                                $id = $_REQUEST['id'];
                                $pagetitle = "ADMIN PRODUCT EDIT| Fundly";
                                $btnSendValue = "Edit";
                                $product = ModelProduct::select($id);
                                $actionForm = "?index.php&controller=admin&action=products&task=updated&id=" . $product->getIdProduct();
                                require("{$ROOT}{$DS}view{$DS}view.php");
                            }
                        } else {
                            $pagetitle = "ADMIN PRODUCT ADD | Fundly";
                            $btnSendValue = "Add";
                            $actionForm = "?index.php&controller=admin&action=products&task=created";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } //product/task/add/ - product/task/edit/ 
                    break;
                case "created": {

                        if (
                            isset($_REQUEST['Ptitle']) && isset($_REQUEST['Mdate'])
                            && isset($_REQUEST['Edate']) && isset($_REQUEST['price'])
                            && isset($_REQUEST['stock']) && isset($_REQUEST['provider'])
                            && isset($_REQUEST['description']) && isset($_REQUEST['theme'])
                            && count($_FILES['imgFile']) > 0
                        ) {
                            echo "RECIVED PARAMETER::";
                            echo "State=";
                            echo isset($_REQUEST['Ptitle']) && isset($_REQUEST['Mdate'])
                                && isset($_REQUEST['Edate']) && isset($_REQUEST['price'])
                                && isset($_REQUEST['stock']) && isset($_REQUEST['provider'])
                                && isset($_REQUEST['description']) && isset($_REQUEST['theme'])
                                && count($_FILES['imgFile']) > 0;
                            echo "<br>";
                            $file = $_FILES['imgFile']; //array
                            $fileName = $_FILES['imgFile']['name'];
                            $fileTmpName = $_FILES['imgFile']['tmp_name']; //temporary location eg.C:\xampp\tmp\php6775.tmp
                            $fileSize = $_FILES['imgFile']['size'];
                            $fileError = $_FILES['imgFile']['error'];
                            $fileType = $_FILES['imgFile']['type'];

                            $fileExt = explode('.', $fileName);
                            $fileActualExt = strtolower(end($fileExt));

                            $allowed = array('jpg', 'jpeg', 'png');

                            /**FILE TESTING */
                            $error = false;
                            if (in_array($fileActualExt, $allowed)) {
                                if ($fileError == 0) {
                                    if ($fileSize < 1000000) {
                                        $error = false;
                                    } else {
                                        $msgError = "ur file is too big";
                                        $error = true;
                                    }
                                } else {
                                    $msgError = "There was an error uploading your file!";
                                    $error = true;
                                }
                            } else {
                                $msgError = "you cannot upload these file";
                                $error = true;
                            }

                            if ($error) {
                                $pagetitle = 'Product failed to Create';
                                $view = "FailedProduct";
                                $HTMLbodyId = "";
                                require("{$ROOT}{$DS}view{$DS}view.php");
                            } else {
                                $fileNewName = bin2hex(random_bytes(5)) . "." . $fileActualExt;
                                // random string concat with file extention
                                # The random_bytes() function generates cryptographically secure pseudo-random bytes, 
                                # which can later be converted to hexadecimal format using bin2hex() function.
                                //$fileDestination = "{$ROOT}{$DS}assets{$DS}Images{$DS}product{$DS}" . $fileNewName;
                                $fileDestination = "assets{$DS}Images{$DS}product{$DS}" . $fileNewName;
                                move_uploaded_file($fileTmpName, $fileDestination);


                                $idProduct = NULL;
                                $pTitre = $_REQUEST['Ptitle'];
                                $mDate = $_REQUEST['Mdate'];
                                $eDate = $_REQUEST['Edate'];
                                $price = $_REQUEST['price'];
                                $stock = $_REQUEST['stock'];
                                $provider = $_REQUEST['provider'];
                                $description = $_REQUEST['description'];
                                $theme = $_REQUEST['theme'];
                                $imgSRC = $fileDestination;

                                $p = new ModelProduct($idProduct, $imgSRC, $pTitre, $price, $description, $provider, $mDate, $eDate, $stock, $theme);

                                $tab = array(
                                    'idProduct' => $idProduct,
                                    'imgSRC' => $fileDestination,
                                    'Title' => $pTitre,
                                    'Price' => $price,
                                    'Description' => $description,
                                    'Provider' => $provider,
                                    'ManufDate' => $mDate,
                                    'ExpDate' => $eDate,
                                    'Stock' => $stock,
                                    'idTheme' => $theme
                                );

                                print_r($tab);

                                echo "<br>";

                                print_r($p);

                                $p->insert($tab);

                                $pagetitle = 'Product Creation';
                                $view = "createdProduct";
                                $HTMLbodyId = "";
                                require("{$ROOT}{$DS}view{$DS}view.php");
                            }
                        }
                    } //product/task/created
                    break;
                case "updated": {
                        $pagetitle = "";
                        $view = "";
                        $HTMLbodyId = "";
                        if (
                            isset($_REQUEST['id']) && isset($_REQUEST['Ptitle']) && isset($_REQUEST['Mdate'])
                            && isset($_REQUEST['Edate']) && isset($_REQUEST['price'])
                            && isset($_REQUEST['stock']) && isset($_REQUEST['provider'])
                            && isset($_REQUEST['description']) && isset($_REQUEST['theme'])
                        ) {
                            $oldId = $_REQUEST['id'];
                            $product = ModelProduct::select($_REQUEST['id']);
                            $imgFileSRC = $product->getImgSRC(); //get old value from database

                            echo "PRODUCT SELECTED::";
                            print_r($product);
                            echo "<br>";

                            print_r($_FILES);

                            echo "RECIVED PARAMETER::";
                            echo "State=";
                            echo isset($_REQUEST['Ptitle']) && isset($_REQUEST['Mdate'])
                                && isset($_REQUEST['Edate']) && isset($_REQUEST['price'])
                                && isset($_REQUEST['stock']) && isset($_REQUEST['provider'])
                                && isset($_REQUEST['description']) && isset($_REQUEST['theme']);
                            echo "<br>";

                            if ($_FILES['imgFile']['error'] != 4) {
                                /**
                                 * UPLOAD_ERR_NO_FILE
                                 *      Valeur : 4. Aucun fichier n'a été téléchargé.
                                 */
                                $file = $_FILES['imgFile']; //array
                                $fileName = $_FILES['imgFile']['name'];
                                $fileTmpName = $_FILES['imgFile']['tmp_name']; //temporary location eg.C:\xampp\tmp\php6775.tmp
                                $fileSize = $_FILES['imgFile']['size'];
                                $fileError = $_FILES['imgFile']['error'];
                                $fileType = $_FILES['imgFile']['type'];

                                $fileExt = explode('.', $fileName);
                                $fileActualExt = strtolower(end($fileExt));

                                $allowed = array('jpg', 'jpeg', 'png');
                                /**FILE TESTING */
                                $error = false;
                                if (in_array($fileActualExt, $allowed)) {
                                    if ($fileError == 0) {
                                        if ($fileSize < 1000000) {
                                            $error = false;
                                        } else {
                                            $msgError = "ur file is too big";
                                            $error = true;
                                        }
                                    } else {
                                        $msgError = "There was an error uploading your file!";
                                        $error = true;
                                    }
                                } else {
                                    $msgError = "you cannot upload these file";
                                    $error = true;
                                }

                                if ($error) {
                                    $pagetitle = 'Product failed to update';
                                    $view = "FailedProduct";
                                    $HTMLbodyId = "";
                                    require("{$ROOT}{$DS}view{$DS}view.php");
                                } else {
                                    $fileNewName = bin2hex(random_bytes(5)) . "." . $fileActualExt;
                                    $imgFileSRC = "assets{$DS}Images{$DS}product{$DS}" . $fileNewName;
                                    move_uploaded_file($fileTmpName, $imgFileSRC);
                                }
                            }

                            $idProduct = $oldId;
                            $pTitre = $_REQUEST['Ptitle'];
                            $mDate = $_REQUEST['Mdate'];
                            $eDate = $_REQUEST['Edate'];
                            $price = $_REQUEST['price'];
                            $stock = $_REQUEST['stock'];
                            $provider = $_REQUEST['provider'];
                            $description = $_REQUEST['description'];
                            $theme = $_REQUEST['theme'];
                            $imgSRC = $imgFileSRC;

                            $tab = array(
                                'idProduct' => $idProduct,
                                'imgSRC' => $imgFileSRC,
                                'Title' => $pTitre,
                                'Price' => $price,
                                'Description' => $description,
                                'Provider' => $provider,
                                'ManufDate' => $mDate,
                                'ExpDate' => $eDate,
                                'Stock' => $stock,
                                'idTheme' => $theme
                            );

                            print_r($tab);

                            echo "<br>";

                            if ($product != null) {
                                $p = $product->update($tab, $oldId);
                                // print_r($u, false);
                                // print_r($user, false);
                                // print_r($tab, false);
                            } else {
                                echo "ff";
                            }
                        }
                    } //users/task/updated/
                    break;
            } //product/task
        } // product
        break;
    case "commands": {
            $pagetitle = "ADMIN COMMANDS Managment | Fundly";
            $view = "commands";
            $HTMLbodyId = "aUserManagment";
            $tab_com = ModelCommand::getAll();
            require("{$ROOT}{$DS}view{$DS}view.php");
        } // commands
        break;
    case "themes": {

            if (isset($_REQUEST['task'])) {
                /* recupère l'task passée dans l'URL*/
                $task = $_REQUEST['task'];
            }
            /* NB: On a ajouté un comportement par défaut avec task=readAll.*/ else {
                $task = "all";
            }

            switch ($task) {
                case "all": {
                        $pagetitle = "ADMIN Themes Managment | Fundly";
                        $view = "themes";
                        $HTMLbodyId = "aUserManagment";
                        $tab_t = ModelTheme::getAll();
                        require("{$ROOT}{$DS}view{$DS}view.php");
                    } //theme/task/all/
                    break;

                case "detail": {
                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $pagetitle = "ADMIN USER id details | Fundly";
                            $view = "detailUser";
                            $HTMLbodyId = "aUserManagment";
                            $theme = ModelTheme::select($id);
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } //theme/task/detail
                    break;
                case "edit":
                case "add": {
                        $view = "inputTheme";
                        $HTMLbodyId = "aUserManagment";
                        if ($task == "edit") {
                            if (isset($_REQUEST['id'])) {
                                $id = $_REQUEST['id'];
                                $pagetitle = "ADMIN Theme EDIT| Fundly";
                                $btnSendValue = "Edit";
                                $theme = ModelTheme::select($id);
                                $actionForm = "?index.php&controller=admin&action=themes&task=updated&id=" . $theme[0];
                                require("{$ROOT}{$DS}view{$DS}view.php");
                            }
                        } else {
                            $pagetitle = "ADMIN Theme ADD | Fundly";
                            $btnSendValue = "Add";
                            $actionForm = "?index.php&controller=admin&action=themes&task=created";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } // themes/task/add - themes/task/edit
                    break;
                case "created": {
                        if (
                            isset($_REQUEST['themeTitle'])
                        ) {
                            $idTheme = NULL;
                            $tName = $_REQUEST['themeTitle'];

                            $t = new ModelTheme($idTheme, $tName);
                            $tab = array(
                                "idTheme" => $idTheme,
                                "name" => $tName,
                            );
                            $t->insert($tab);
                            header('Location: ?index.php&controller=admin&action=themes');

                            // $pagetitle = 'Theme Creation';
                            // $view = "createdTheme";
                            // $HTMLbodyId = "";
                            // require("{$ROOT}{$DS}view{$DS}view.php");
                        } else {
                            $pagetitle = 'Theme Creation';
                            $view = "failedToCreate";
                            $HTMLbodyId = "";
                            require("{$ROOT}{$DS}view{$DS}view.php");
                        }
                    } //theme/task/created
                    break;
                case "updated": {
                        $pagetitle = "";
                        $view = "";
                        $HTMLbodyId = "";
                        if (isset($_REQUEST['id']) && isset($_REQUEST['themeTitle'])) {
                            $oldId = $_REQUEST['id'];
                            $tName = $_REQUEST['themeTitle'];
                            $tab = array(
                                'idTheme' => $_REQUEST['id'],
                                'tName' => $_REQUEST['themeTitle']
                            );
                            $theme = ModelTheme::select($oldId);
                            // this return an array and It should be an object of ModelTheme
                            $t = new ModelTheme($theme[0], $theme[1]);
                            //{1} there is a problem : Fatal error: Uncaught Error: Call to a member function update() on array
                            // I solved but i don't now how
                            if ($t != NULL) {
                                $th = $t->update($tab, $oldId);
                                header('Location: ?index.php&controller=admin&action=themes');
                            }
                        }
                    }
                    break;
                case "delete":
                    if (isset($_REQUEST['id'])) {
                        $id = $_REQUEST['id'];
                        $theme = ModelTheme::select($id);
                        $t = new ModelTheme($theme[0], $theme[1]);
                        if ($t != null) {
                            $t->delete($id);
                            header('Location: ?index.php&controller=admin&action=themes');
                        }
                    }
                    //theme/task/delete
                    break;
            } //theme/task
        } // themes
        break;
}
