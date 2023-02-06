<?php

require("models/User.php");

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
    $user = new User($users["first_name"], $users["last_name"], $users["email"], $users["password"]);
    $user -> setId($users["id"]);
    return $user;
    
};

function saveUser(User $user) : User {
    
    $db = new PDO(
    "mysql:host=db.3wa.io;port=3306;dbname=anthonycormier_phpj7",
    "anthonycormier",
    "f7af5a3387016b3d12b42619a8ad2703"
    );
    
    $query = $db -> prepare("INSERT INTO users VALUES (null, :first_name, :last_name, :email, :password)");
    $parameters = [
        'first_name' => $user -> getFirstName(),
        'last_name' => $user -> getLastName(),
        'email' => $user -> getEmail(),
        'password' => $user -> getPassword()
        ];
    
    $query->execute($parameters);
    return loadUser($user -> getEmail());
}

?>