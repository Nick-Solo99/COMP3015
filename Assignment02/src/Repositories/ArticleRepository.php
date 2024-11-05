<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Article.php';

use src\Models\Article as Article;
use src\Models\User;

class ArticleRepository extends Repository
{
    /**
     * @return Article[]
     */
    public function getAllArticles(): array
    {
        $sqlStatement = $this->pdo->query("SELECT * FROM articles;");
        $rows = $sqlStatement->fetchAll();

        $articles = [];
        foreach ($rows as $row) {
            $articles[] = new Article($row);
        }

        return $articles;
    }

    /**
     * @param string $title
     * @param string $url
     * @param string $authorId
     * @return Article|false
     */
    public function saveArticle(string $title, string $url, string $authorId): Article|false
    {
        $createdAt = date("Y-m-d H:i:s");

        $sqlStatement = $this->pdo->prepare("INSERT INTO articles (title, url, author_id, created_at) VALUES (?, ?, ?, ?)");
        $success = $sqlStatement->execute([$title, $url, $authorId, $createdAt]);
        if ($success) {
            $article = $sqlStatement->fetch();
            if ($article) {
                return new Article($article);
            }
        }
        return false;
    }

    /**
     * @param int $id
     * @return Article|false Article object if it was found, false otherwise
     */
    public function getArticleById(int $id): Article|false
    {
        $sqlStatement = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $success = $sqlStatement->execute([$id]);
        if ($success) {
            $article = $sqlStatement->fetch();
            if ($article) {
                return new Article($article);
            }
        }
        return false;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $url
     * @return bool true on success, false otherwise
     */
    public function updateArticle(int $id, string $title, string $url): bool
    {
        $updatedAt = date("Y-m-d H:i:s");
        $sqlStatement = $this->pdo->prepare("UPDATE articles SET title = ?, url = ?, updated_at = ? WHERE id = ?");
        return $sqlStatement->execute([$title, $url, $updatedAt, $id]);
    }

    /**
     * @param int $id
     * @return bool true on success, false otherwise
     */
    public function deleteArticleById(int $id): bool
    {
        $sqlStatement = $this->pdo->prepare("DELETE FROM articles WHERE id = ?");
        return $sqlStatement->execute([$id]);
    }

    /**
     * @param string $articleId
     * @return ?User
     */
    public function getArticleAuthor(string $articleId): ?User
    {
        $sqlStatement = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $success = $sqlStatement->execute([$articleId]);
        if ($success) {
            $user = $sqlStatement->fetch();
            return new User($user);
        }
        return null;
    }
}
