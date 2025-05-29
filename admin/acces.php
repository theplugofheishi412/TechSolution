<?php
session_start();
require_once '../config/DataBase.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($motDePasse, $admin['mot_de_passe'])) {
        $_SESSION['admin'] = $admin['email'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
</head>
<body>
  <h2>Connexion Administrateur</h2>
  <?php if ($error): ?>
    <p style="color: red;"><?= $error ?></p>
  <?php endif; ?>
  <form method="POST">
    <input type="email" name="email" placeholder="Email admin" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
  </form>
</body>
</html>
