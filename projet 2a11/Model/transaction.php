<?php

class Transaction
{
    // Propriétés privées correspondant aux colonnes de la table transactions
    private $id;
    private $id_commande;
    private $id_admin;
    private $montant_total;
    private $part_entreprise;
    private $part_professor;
    private $date_transaction;
    private $statut_transaction;
    private $methode_paiement;

    // Constructeur
    public function __construct(
        $id_commande = null,
        $id_admin = null,
        $montant_total = null,
        $part_entreprise = null,
        $part_professor = null,
        $date_transaction = null,
        $statut_transaction = null,
        $methode_paiement = null
    ) {
        $this->id_commande = $id_commande;
        $this->id_admin = $id_admin;
        $this->montant_total = $montant_total;
        $this->part_entreprise = $part_entreprise;
        $this->part_professor = $part_professor;
        $this->date_transaction = $date_transaction;
        $this->statut_transaction = $statut_transaction;
        $this->methode_paiement = $methode_paiement;
    }

    // Méthode pour afficher une transaction sous forme de tableau
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
                <td>' . $this->id . '</td>
                <td>' . $this->id_commande . '</td>
                <td>' . $this->id_admin . '</td>
                <td>' . $this->montant_total . '</td>
                <td>' . $this->part_entreprise . '</td>
                <td>' . $this->part_professor . '</td>
                <td>' . $this->date_transaction . '</td>
                <td>' . $this->statut_transaction . '</td>
                <td>' . $this->methode_paiement . '</td>
            </tr>
        </table>';
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getIdCommande()
    {
        return $this->id_commande;
    }

    public function getIdAdmin()
    {
        return $this->id_admin;
    }

    public function getMontantTotal()
    {
        return $this->montant_total;
    }

    public function getPartEntreprise()
    {
        return $this->part_entreprise;
    }

    public function getPartProfessor()
    {
        return $this->part_professor;
    }

    public function getDateTransaction()
    {
        return $this->date_transaction;
    }

    public function getStatutTransaction()
    {
        return $this->statut_transaction;
    }

    public function getMethodePaiement()
    {
        return $this->methode_paiement;
    }

    // Setters
    public function setIdCommande($id_commande)
    {
        $this->id_commande = $id_commande;
    }

    public function setIdAdmin($id_admin)
    {
        $this->id_admin = $id_admin;
    }

    public function setMontantTotal($montant_total)
    {
        $this->montant_total = $montant_total;
    }

    public function setPartEntreprise($part_entreprise)
    {
        $this->part_entreprise = $part_entreprise;
    }

    public function setPartProfessor($part_professor)
    {
        $this->part_professor = $part_professor;
    }

    public function setDateTransaction($date_transaction)
    {
        $this->date_transaction = $date_transaction;
    }

    public function setStatutTransaction($statut_transaction)
    {
        $this->statut_transaction = $statut_transaction;
    }

    public function setMethodePaiement($methode_paiement)
    {
        $this->methode_paiement = $methode_paiement;
    }
}

?>
