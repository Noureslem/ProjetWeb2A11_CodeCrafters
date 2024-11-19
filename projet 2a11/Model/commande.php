<?php

class Commande
{
    // Propriétés privées correspondant aux colonnes de la table commande
    private $id;
    private $cours_id;
    private $etudiant_id;
    private $statut;
    private $date_commande;

    // Constructeur
    public function __construct($cours_id = null, $etudiant_id = null, $statut = null, $date_commande = null)
    {
        $this->cours_id = $cours_id;
        $this->etudiant_id = $etudiant_id;
        $this->statut = $statut;
        $this->date_commande = $date_commande;
    }

    // Méthode pour afficher une commande sous forme de tableau
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
                <td>' . $this->id . '</td>
                <td>' . $this->cours_id . '</td>
                <td>' . $this->etudiant_id . '</td>
                <td>' . $this->statut . '</td>
                <td>' . $this->date_commande . '</td>
            </tr>
        </table>';
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getCoursId()
    {
        return $this->cours_id;
    }

    public function getEtudiantId()
    {
        return $this->etudiant_id;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getDateCommande()
    {
        return $this->date_commande;
    }

    // Setters
    public function setCoursId($cours_id)
    {
        $this->cours_id = $cours_id;
    }

    public function setEtudiantId($etudiant_id)
    {
        $this->etudiant_id = $etudiant_id;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function setDateCommande($date_commande)
    {
        $this->date_commande = $date_commande;
    }
}
?>
