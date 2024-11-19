<?php

include "../controller/tansaction_controller.php";
$transactionController = new Ttansaction_controller();
$list = $transactionController->listTransactions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Management</title>
</head>

<body>
    <h1>Liste des Transactions</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>ID Commande</th>
            <th>ID Admin</th>
            <th>Montant Total</th>
            <th>Part Entreprise</th>
            <th>Part Professor</th>
            <th>Date Transaction</th>
            <th>Statut</th>
            <th>Méthode Paiement</th>
        </tr>
        <?php foreach ($list as $transaction) { ?>
            <tr>
                <td><?= $transaction['id']; ?></td>
                <td><?= $transaction['id_commande']; ?></td>
                <td><?= $transaction['id_admin']; ?></td>
                <td><?= $transaction['montant_total']; ?></td>
                <td><?= $transaction['part_entreprise']; ?></td>
                <td><?= $transaction['part_professor']; ?></td>
                <td><?= $transaction['date_transaction']; ?></td>
                <td><?= $transaction['statut_transaction']; ?></td>
                <td><?= $transaction['methode_paiement']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
