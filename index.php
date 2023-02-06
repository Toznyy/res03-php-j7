<?php 
require("logic/router.php");
require("logic/database.php");

if (isset($_GET["route"])) {
    checkRoute($_GET["route"]);
}
else {
    checkRoute("");
};

//////////////////// Création de compte //////////////////////

if ((isset($_POST["firstName"]) && !empty($_POST["firstName"])) || (isset($_POST["lastName"]) && !empty($_POST["lastName"])) || (isset($_POST["email"]) && !empty($_POST["email"])) || (isset($_POST["password"]) && !empty($_POST["password"])) || (isset($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"]))) {
    
    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $newUser = new User($_POST["firstName"], $_POST["lastName"], $_POST["email"], $hash, $_POST["confirmPassword"]);
    
    saveUser($newUser);
}
    
    
?>