<?php
echo "CREATED PRODUCT works !!<br>";
// $file = $_FILES['imgFile'];
// echo "<br> s:" . count($file) . "<br>";
// print_r($file);
// $fileName = $_FILES['imgFile']['name'];
// $fileTmpName = $_FILES['imgFile']['tmp_name'];
// $fileSize = $_FILES['imgFile']['size'];
// $fileError = $_FILES['imgFile']['error'];
// $fileType = $_FILES['imgFile']['type'];

// $fileExt = explode('.', $fileName);
// $fileActualExt = strtolower(end($fileExt));

// $allowed = array('jpg', 'jpeg', 'png');

// if (in_array($fileActualExt, $allowed)) {
//     if ($fileError == 0) {
//         if ($fileSize < 1000000) {
//             $fileNewName = uniqid('', true) . "." . $fileActualExt;
//             $fileDestination = "{$ROOT}{$DS}assets{$DS}Images{$DS}product{$DS}" . $fileNewName;
//             move_uploaded_file($fileTmpName, $fileDestination);
//             echo "<br>*fd: " . $fileDestination . "fnn:" . $fileNewName . "<br>";
//         } else {
//             echo "ur file is too big";
//         }
//     } else {
//         echo "There was an error uploading your file!";
//     }
// } else {
//     echo "you cannot upload these file";
// }

// print_r($_REQUEST);
