<?php

require("../models/User.php");

function loadUser(string $email) : User {
    
    $db = new PDO(
        'mysql:host=db.3wa.io;port=3306;dbname=anthonycormier_phpj7',
        'anthonycormier',
        'f7af5a3387016b3d12b42619a8ad2703'
    );
    
    $query = $db->prepare('SELECT * FROM users WHERE email = :email');
    $parameters = ['email' => $email];
    $query->execute($parameters);
    $users = $query->fetch(PDO::FETCH_ASSOC);
}

function saveUser(User $user) : User {
    
    $db = new PDO(
    'mysql:host=db.3wa.io;port=3306;dbname=anthonycormier_phpj7',
    'anthonycormier',
    'f7af5a3387016b3d12b42619a8ad2703'
    );
    
    $query = $db->prepare("INSERT INTO users VALUES (null, :firstName, :lastName, :email, :password)");
    $parameters = [
        'firstName' => $user -> getFirstName(),
        'lastName' => $user -> getLastName(),
        'email' => $user -> getEmail(),
        'password' => $user -> getPassword()
        ];
    
    $query->execute($parameters);
    $users = $query->fetch(PDO::FETCH_ASSOC);
}

$user1 = new User("anto","corm","anto@an.fr","antoanto");
saveUser($user1);
?>