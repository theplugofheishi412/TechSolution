<?php
require_once '../config/DataBase.php';


$email = "Polo412@gmail.com";
$motDePasse = "Hunter412"; // Mot de passe

// Hachage du mot de passe
$hash = password_hash($motDePasse, PASSWORD_DEFAULT);

// Insertion dans la table `admins`
$sql = "INSERT INTO admins (email, mot_de_passe) VALUES (:email, :mot_de_passe)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':email' => $email,
    ':mot_de_passe' => $hash
]);

echo "✅ Admin succes!";
