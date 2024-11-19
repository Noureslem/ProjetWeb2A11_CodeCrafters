<?php 
include_once "config.php";
class commande_controller{
    public function show()
    {
        echo '<table border=1 width="100%">
            <tr align="center">
                <td>ID</td>
                <td>Cours ID</td>
                <td>Étudiant ID</td>
                <td>Statut</td>
                <td>Date de commande</td>
            </tr>
            <tr>
                <td>' . $commande["id"] . '</td>
                <td>' . $commande["cours_id"] . '</td>
                <td>' . $commande["etudiant_id"] . '</td>
                <td>' . $commande["statut"] . '</td>
                <td>' . $commande["date_commande"] . '</td>
            </tr>
        </table>';
    }
    public function listCommandes()
    {
        $pdo = config::getConnexion();
        $query = $pdo->query("SELECT * FROM commande");
        return $query->fetchAll();
    }

    public function addCommande($commande)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("INSERT INTO commande (cours_id, etudiant_id, statut, date_commande) 
                                VALUES (:cours_id, :etudiant_id, :statut, :date_commande)");
        $query->execute([
            'cours_id' => $commande['cours_id'],
            'etudiant_id' => $commande['etudiant_id'],
            'statut' => $commande['statut'],
            'date_commande' => $commande['date_commande']
        ]);
    }
    public function deleteCommande($id)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("DELETE FROM commande WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}



?>