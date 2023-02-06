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

if ((isset($_POST["firstName"]) && !empty($_POST["firstName"])) && (isset($_POST["lastName"]) && !empty($_POST["lastName"])) && (isset($_POST["email"]) && !empty($_POST["email"])) && (isset($_POST["password"]) && !empty($_POST["password"])) && (isset($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"]))) {
    
    if ($_POST["password"] === $_POST["confirmPassword"]) {
        
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $newUser = new User($_POST["firstName"], $_POST["lastName"], $_POST["email"], $hash, $_POST["confirmPassword"]);
        
        saveUser($newUser);
    }
    
    else {
        
        echo "Les deux mots de passe ne sont pas identiques.";
    }
    
}
else if ((isset($_POST["firstName"]) && empty($_POST["firstName"])) || (isset($_POST["lastName"]) && empty($_POST["lastName"])) || (isset($_POST["email"]) && empty($_POST["email"])) || (isset($_POST["password"]) && empty($_POST["password"])) || (isset($_POST["confirmPassword"]) && empty($_POST["confirmPassword"]))) {
    
    echo "L'un des champs n'est pas rempli.";
}

//////////////////////// Connexion //////////////////////////

if ((isset($_POST["loginEmail"]) && !empty($_POST["loginEmail"])) && (isset($_POST["loginPassword"]) && !empty($_POST["loginPassword"]))) {
    
    $recup = loadUser($_POST["loginEmail"]);
    $mdp = $recup->getPassword();
    var_dump($mdp);
    
    if (password_verify($_POST["loginPassword"], $mdp)) {
        echo "c'est bon";
    }
    
    else {
        echo "c'est pas bon bête type";
    }
}

else if ((isset($_POST["email"]) && empty($_POST["email"])) || (isset($_POST["password"]) && empty($_POST["password"]))) {
    
    echo "L'un des champs n'est pas rempli.";
}

?>