<?php

include "../controller/user_controller.php";
$userController = new user_controller();
$list = $userController->listUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>

<body>
    <h1>Liste des Utilisateurs</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Spécialité</th>
            <th>Date de Création</th>
        </tr>
        <?php foreach ($list as $user) { ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['nom']; ?></td>
                <td><?= $user['prenom']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['role']; ?></td>
                <td><?= $user['specialite']; ?></td>
                <td><?= $user['date_creation']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
