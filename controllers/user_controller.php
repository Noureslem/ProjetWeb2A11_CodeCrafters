<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function createUser(User $user): bool {
        try {
            $sql = "INSERT INTO user (firstname, lastname, email, dateOfBirth, password, role) 
                    VALUES (:firstname, :lastname, :email, :dateOfBirth, :password, :role)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':firstname', $user->getFirstName());
            $stmt->bindParam(':lastname', $user->getLastName());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':dateOfBirth', $user->getDateOfBirth());
            $stmt->bindParam(':password', $user->getPassword());
            $stmt->bindParam(':role', $user->getRole());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function getUserById(string $id): ?User {
        try {
            $sql = "SELECT * FROM user WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new User(
                    $row['firstname'],
                    $row['lastname'],
                    $row['email'],
                    $row['dateOfBirth'],
                    $row['password'],
                    $row['role'],
                    $row['id']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
    public function getAllUsers(): array {
        try {
            $sql = "SELECT * FROM user";
            $stmt = $this->conn->query($sql);
            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = new User(
                    
                    $row['firstname'],
                    $row['lastname'],
                    $row['email'],
                    $row['dateOfBirth'],
                    $row['password'],
                    $row['role'],
                    $row['phoneNumber'],
                    $row['id'],
                );
            }
            return $users;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function updateUser(User $user): bool {
        try {
            $sql = "UPDATE user 
                    SET firstname = :firstname, lastname = :lastname, email = :email, 
                        dateOfBirth = :dateOfBirth, password = :password, role = :role 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':firstname', $user->getFirstName());
            $stmt->bindParam(':lastname', $user->getLastName());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':dateOfBirth', $user->getDateOfBirth());
            $stmt->bindParam(':password', $user->getPassword());
            $stmt->bindParam(':role', $user->getRole());
            $stmt->bindParam(':id', $user->getIdUser());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function deleteUserById(string $id): bool {
        try {
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
?>
