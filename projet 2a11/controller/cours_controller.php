<?php
include_once "config.php";

class AppController
{

    public function showCours($cours)
    {
        echo '<table border=1 width="100%">
            <tr align="center">
                <td>ID</td>
                <td>Titre</td>
                <td>Description</td>
                <td>Prix</td>
                <td>Catégorie</td>
                <td>Date de création</td>
                <td>ID Professeur</td>
                <td>Disponible</td>
            </tr>
            <tr>
                <td>' . $cours['id'] . '</td>
                <td>' . $cours['titre'] . '</td>
                <td>' . $cours['description'] . '</td>
                <td>' . $cours['prix'] . '</td>
                <td>' . $cours['categorie'] . '</td>
                <td>' . $cours['date_creation'] . '</td>
                <td>' . $cours['id_professeur'] . '</td>
                <td>' . ($cours['disponible'] ? 'Oui' : 'Non') . '</td>
            </tr>
        </table>';
    }

    public function listCours()
    {
        $pdo = config::getConnexion();
        $query = $pdo->query("SELECT * FROM cours");
        return $query->fetchAll();
    }

    public function deleteCours($id)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("DELETE FROM cours WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function addCours($cours)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("INSERT INTO cours (titre, description, prix, categorie, date_creation, id_professeur, disponible) 
                                VALUES (:titre, :description, :prix, :categorie, :date_creation, :id_professeur, :disponible)");
        $query->execute([
            'titre' => $cours['titre'],
            'description' => $cours['description'],
            'prix' => $cours['prix'],
            'categorie' => $cours['categorie'],
            'date_creation' => $cours['date_creation'],
            'id_professeur' => $cours['id_professeur'],
            'disponible' => $cours['disponible']
        ]);
    }
    public function deleteTransaction($id)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("DELETE FROM transaction WHERE id = :id");
        $query->execute(['id' => $id]);
    }

}