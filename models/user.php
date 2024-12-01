<?php
class User {
    private ?string $idUser;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $dateOfBirth;
    private ?string $password;
    private ?string $role;
    private ?string $phoneNumber;

    public function __construct(
        string $firstName, 
        string $lastName, 
        string $email, 
        string $dateOfBirth, 
        string $password, 
        string $role, 
        ?string $phoneNumber = null,
        ?string $idUser = null
    ) {
        $this->idUser = $idUser;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
        $this->password = $password;
        $this->role = $role;
        $this->phoneNumber = $phoneNumber;
    }

    public function getIdUser(): ?string {
        return $this->idUser;
    }
    public function setIdUser(string $idUser): void {
        $this->idUser = $idUser;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }
    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getDateOfBirth(): string {
        return $this->dateOfBirth;
    }
    public function setDateOfBirth(string $dateOfBirth): void {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getRole(): string {
        return $this->role;
    }
    public function setRole(string $role): void {
        $this->role = $role;
    }
    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }
}
?>
