<?php

include "../controller/cours_controller.php";
$coursController = new AppController();
$list = $coursController->listCours();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours Management</title>
</head>

<body>
    <h1>Liste des Cours</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Professeur ID</th>
            <th>Type de Cours</th>
            <th>Description</th>
            <th>Niveau</th>
            <th>Prix</th>
            <th>Langue</th>
            <th>Durée</th>
            <th>Date de Création</th>
        </tr>
        <?php foreach ($list as $cours) { ?>
            <tr>
                <td><?= $cours['id']; ?></td>
                <td><?= $cours['professor_id']; ?></td>
                <td><?= $cours['types_cours']; ?></td>
                <td><?= $cours['description']; ?></td>
                <td><?= $cours['niveau']; ?></td>
                <td><?= $cours['prix']; ?></td>
                <td><?= $cours['langue']; ?></td>
                <td><?= $cours['duree']; ?></td>
                <td><?= $cours['date_creation']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
