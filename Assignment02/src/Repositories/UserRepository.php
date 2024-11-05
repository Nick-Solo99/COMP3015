<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/User.php';

use src\Models\User;

class UserRepository extends Repository
{
    /**
     * @param string $id
     * @return User|false
     */
    public function getUserById(string $id): User|false
    {
        $sqlStatement = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $success = $sqlStatement->execute([$id]);
        if ($success) {
            $user = $sqlStatement->fetch();
            return new User($user);
        }
        return false;
    }

    /**
     * @param string $email
     * @return User|false
     */
    public function getUserByEmail(string $email): User|false
    {
        $sqlStatement = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $success = $sqlStatement->execute([$email]);
        if ($success) {
            $user = $sqlStatement->fetch();
            if ($user === false) return false;
            return new User($user);
        }
        return false;
    }

    /**
     * @param string $passwordDigest
     * @param string $email
     * @param string $name
     * @return User|false
     */
    public function saveUser(string $name, string $email, string $passwordDigest): User|false
    {
        $sqlStatement = $this->pdo->prepare("INSERT INTO users (name, email, password_digest) VALUES (?, ?, ?)");
        $success = $sqlStatement->execute([$name, $email, $passwordDigest]);
        if ($success) {
            $id = $this->pdo->lastInsertId();
            return $this->getUserById($id);
        }
        return false;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string|null $profilePicture
     * @return bool
     */
    public function updateUser(int $id, string $name, string $profilePicture = null): bool
    {
        if ($profilePicture != null) {
            $sqlStatement = $this->pdo->prepare("UPDATE users SET name = ?, profile_picture = ? WHERE id = ?");
            return $sqlStatement->execute([$name, $profilePicture, $id]);
        }
        $sqlStatement = $this->pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
        return $sqlStatement->execute([$name, $id]);
    }

}
