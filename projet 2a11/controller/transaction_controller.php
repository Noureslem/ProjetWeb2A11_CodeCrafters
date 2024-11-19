<?php
include_once "config.php";

class tansaction_controller{
    public function show()
    {
        echo '<table border=1 width="100%">
            <tr align="center">
                <td>ID</td>
                <td>ID Commande</td>
                <td>ID Admin</td>
                <td>Montant Total</td>
                <td>Part Entreprise</td>
                <td>Part Professor</td>
                <td>Date Transaction</td>
                <td>Statut Transaction</td>
                <td>Méthode Paiement</td>
            </tr>
            <tr>
                <td>' . $transaction["id"] . '</td>
                <td>' . $transaction["id_commande"] . '</td>
                <td>' . $transaction["id_admin"] . '</td>
                <td>' . $transaction["mantant_total"] . '</td>
                <td>' . $transaction["part_entreprise"] . '</td>
                <td>' . $transaction["part_professor"] . '</td>
                <td>' . $transaction["date_transaction"] . '</td>
                <td>' . $transaction["statut_transaction"] . '</td>
                <td>' . $transaction["methode_paiment"] . '</td>
            </tr>
        </table>';
    }
    public function listTransactions()
    {
        $pdo = config::getConnexion();
        $query = $pdo->query("SELECT * FROM transaction");
        return $query->fetchAll();
    }
    public function addTransaction($transaction)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("INSERT INTO transaction (id_commande,id_admin,mantant_total,part_entreprise,part_professor, date_transaction, statut_transaction,methode_paiment) 
                                VALUES (:id_commande,:id_admin, :mantant_total,:part_entreprise,part_professor,:date_transaction,:statut_transactio,:methode_paiment)");
        $query->execute([
            'id_commande' => $transaction['id_commande'],
            'id_admin' => $transaction['id_admin'],
            'mantant_total' => $transaction['montant_total'],
            'part_entreprise' => $transaction['part_entreprise'],
            'part_professor' => $transaction['part_professor'],
            'date_transaction' => $transaction['date_transaction'],
            'statut_transaction' => $transaction['statut_transaction'],
            'methode_paiment' => $transaction["methode_paiment"],
        ]);
    }
    public function deleteTransaction($id)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("DELETE FROM transaction WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}