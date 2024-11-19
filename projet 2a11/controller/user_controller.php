<?php 
include_once "config.php";
class user_controller{
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
                <td>' . $user["nom"] . '</td>
                <td>' . $user["prenom"] . '</td>
                <td>' . $user["email"] . '</td>
                <td>' . $user["role"] . '</td>
                <td>' . $user["specialite"] . '</td>
                <td>' . $user["date_creation"] . '</td>
            </tr>
        </table>';
    }
    public function listUsers()
    {
        $pdo = config::getConnexion();
        $query = $pdo->query("SELECT * FROM user");
        return $query->fetchAll();
    }
    public function addUser($user)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("INSERT INTO user (nom, prenom, email, role, specialite, date_creation) 
                                VALUES (:nom, :prenom, :email, :role, :specialite, :date_creation)");
        $query->execute([
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email'],
            'role' => $user['role'],
            'specialite' => $user['specialite'],
            'date_creation' => $user['date_creation']
        ]);
    }
    public function deleteUser($id)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("DELETE FROM user WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}