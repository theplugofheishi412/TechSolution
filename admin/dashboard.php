<?php
require_once '../config/DataBase.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: acces.php");
    exit;
}
$stmt = $conn->query("SELECT * FROM rendezvous ORDER BY date DESC, heure DESC");
$rendezvous = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - Rendez-vous</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px #ccc;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #0a0a23;
      color: white;
    }
    h2 {
      text-align: center;
      color: #0a0a23;
    }
  </style>
</head>
<body>

<h2>Liste des rendez-vous - TechSolutions</h2>
<!-- gere la deconnection de l'admin -->

<button>LogOut</button>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Email</th>
      <th>Téléphone</th>
      <th>Date</th>
      <th>Heure</th>
      <th>Service</th>
      <th>Message</th>
      <th>Créé le</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rendezvous as $rdv): ?>
      <tr>
        <td><?= $rdv['id'] ?></td>
        <td><?= htmlspecialchars($rdv['nom']) ?></td>
        <td><?= htmlspecialchars($rdv['email']) ?></td>
        <td><?= htmlspecialchars($rdv['telephone']) ?></td>
        <td><?= $rdv['date'] ?></td>
        <td><?= $rdv['heure'] ?></td>
        <td><?= htmlspecialchars($rdv['service']) ?></td>
        <td><?= nl2br(htmlspecialchars($rdv['message'])) ?></td>
        <td><?= $rdv['created_at'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>
