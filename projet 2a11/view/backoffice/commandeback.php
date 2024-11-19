<?php

include "../controller/commande_controller.php";
$commandeController = new commande_controller();
$list = $commandeController-> listCommandes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Management</title>
</head>

<body>
    <h1>Liste des Commandes</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Cours ID</th>
            <th>Étudiant ID</th>
            <th>Statut</th>
            <th>Date de Commande</th>
        </tr>
        <?php foreach ($list as $commande) { ?>
            <tr>
                <td><?= $commande['id']; ?></td>
                <td><?= $commande['cour_id']; ?></td>
                <td><?= $commande['etudiant_id']; ?></td>
                <td><?= $commande['statut']; ?></td>
                <td><?= $commande['date_commande']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
