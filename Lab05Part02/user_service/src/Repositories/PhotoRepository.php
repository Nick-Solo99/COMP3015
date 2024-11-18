<?php

namespace NewCo\UserService\Repositories;

use NewCo\UserService\Models\Photo;

require_once __DIR__ . '/Repository.php';
require_once __DIR__ . '/../Models/Photo.php';

class PhotoRepository extends Repository
{
    function addPhoto(string $file_name, string $metadata) : bool {
        $uploaded_at = date("Y-m-d H:i:s");
        $sqlStatement = $this->pdo->prepare("INSERT INTO photos (file_name, metadata, uploaded_at) VALUES (?, ?, ?)");
        return $sqlStatement->execute([$file_name, $metadata, $uploaded_at]);
    }

}