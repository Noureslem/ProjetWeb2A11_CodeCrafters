<?php

class User
{
    // Propriétés privées correspondant aux colonnes de la table user
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $role;
    private $specialite;
    private $date_creation;

    // Constructeur
    public function __construct($nom = null, $prenom = null, $email = null, $role = null, $specialite = null, $date_creation = null)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role = $role;
        $this->specialite = $specialite;
        $this->date_creation = $date_creation;
    }

    // Méthode pour afficher un utilisateur sous forme de tableau
    public function show()
    {
        echo '<table border=1 width="100%">
            <tr align="center">
                <td>Nom</td>
                <td>Prénom</td>
                <td>Email</td>
                <td>Role</td>
                <td>Specialité</td>
                <td>Date de création</td>
            </tr>
            <tr>
                <td>' . $this->nom . '</td>
                <td>' . $this->prenom . '</td>
                <td>' . $this->email . '</td>
                <td>' . $this->role . '</td>
                <td>' . $this->specialite . '</td>
                <td>' . $this->date_creation . '</td>
            </tr>
        </table>';
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getSpecialite()
    {
        return $this->specialite;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    // Setters
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }
}

?>
