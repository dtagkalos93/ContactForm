<?php
require('config.php');

$id = $_REQUEST["id"];
$name = $_REQUEST["name"];
$lastname = $_REQUEST["lastname"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];

$bridge = utf8_decode(urldecode($_REQUEST["bridge"]));
$comment = $_REQUEST["comment"];

$sql = "UPDATE info SET name='" . $name . "', lastName='" . $lastname . "'  , email='" . $email . "'"
        . ", phone='" . $phone . "', bridge='" . $bridge . "' , comments='" . $comment . "' WHERE id='" . $id . "'";

$success = $mysqli->query($sql);
if ($success === TRUE) {
    echo     "success";
} else {
    echo  "error";
}
?>