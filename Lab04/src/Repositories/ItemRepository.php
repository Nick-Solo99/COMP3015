<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Item.php';

use src\Models\Item as Item;
class ItemRepository extends Repository
{
    public function __construct() {
        $this->databaseName = 'c3015_lab4';
        parent::__construct();
    }

    public function addItem(string $item_name, int $quantity) : bool {
        $sqlStatement = $this->pdo->prepare("INSERT INTO inventory (item_name, quantity) VALUES (?, ?);");
        return $sqlStatement->execute([$item_name, $quantity]);
    }

    public function getAllItems() : array {
        $sqlStatement = $this->pdo->query("SELECT * FROM inventory;");
        $rows = $sqlStatement->fetchAll();
        $items = [];
        foreach ($rows as $row) {
            $items[] = new Item($row);
        }
        return $items;
    }

    public function deleteItem(int $id) : bool {
        $sqlStatement = $this->pdo->prepare("DELETE FROM inventory WHERE id = ?;");
        return $sqlStatement->execute([$id]);
    }

    public function searchItems(string $search_term) : array {
        $sqlStatement = $this->pdo->prepare("SELECT * FROM inventory WHERE item_name LIKE ?;");
        $sqlStatement->execute(["%$search_term%"]);
        $rows = $sqlStatement->fetchAll();
        $items = [];
        foreach ($rows as $row) {
            $items[] = new Item($row);
        }
        return $items;
    }
}