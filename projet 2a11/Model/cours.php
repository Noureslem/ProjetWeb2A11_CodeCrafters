<?php

class Cours
{
    // Propriétés privées correspondant aux colonnes de la table cours
    private $id;
    private $titre;
    private $description;
    private $prix;
    private $categorie;
    private $date_creation;
    private $id_professeur;
    private $disponible;

    // Constructeur
    public function __construct(
        $titre = null,
        $description = null,
        $prix = null,
        $categorie = null,
        $date_creation = null,
        $id_professeur = null,
        $disponible = null
    ) {
        $this->titre = $titre;
        $this->description = $description;
        $this->prix = $prix;
        $this->categorie = $categorie;
        $this->date_creation = $date_creation;
        $this->id_professeur = $id_professeur;
        $this->disponible = $disponible;
    }

    // Méthode pour afficher un cours sous forme de tableau
    public function show()
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
                <td>' . $this->id . '</td>
                <td>' . $this->titre . '</td>
                <td>' . $this->description . '</td>
                <td>' . $this->prix . '</td>
                <td>' . $this->categorie . '</td>
                <td>' . $this->date_creation . '</td>
                <td>' . $this->id_professeur . '</td>
                <td>' . ($this->disponible ? 'Oui' : 'Non') . '</td>
            </tr>
        </table>';
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getIdProfesseur()
    {
        return $this->id_professeur;
    }

    public function isDisponible()
    {
        return $this->disponible;
    }

    // Setters
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function setIdProfesseur($id_professeur)
    {
        $this->id_professeur = $id_professeur;
    }

    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }
}

?>
