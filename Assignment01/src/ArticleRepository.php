<?php

class ArticleRepository
{
    private string $filename;

    public function __construct(string $theFilename)
    {
        $this->filename = $theFilename;
    }

    public function getAllArticles(): array
    {
        if (!file_exists($this->filename)) {
            return [];
        }
        $fileContents = file_get_contents($this->filename);
        if (!$fileContents) {
            return [];
        }
        $decodedArticles = json_decode($fileContents, true, 512, JSON_PRETTY_PRINT);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        $articles = [];
        foreach ($decodedArticles as $decodedArticle) {
            $articleId = $decodedArticle['id'];
            $articles[] = (new Article($articleId))->fill($decodedArticle);
        }
        return $articles;
    }

    public function getArticleById(string $id): Article|null
    {
        $articles = $this->getAllArticles();
        foreach ($articles as $article) {
            if ($article->getId() === $id) {
                return $article;
            }
        }
        return null;
    }

    public function deleteArticleById(string $id): void
    {
        $articles = $this->getAllArticles();
        for ($i = 0; $i < count($articles); $i++) {
            if ($articles[$i]->getId() === $id) {
                unset($articles[$i]);
            }
        }
        file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT));
    }

    public function saveArticle(Article $article): void
    {
        $articles = $this->getAllArticles();
        $articles[] = $article;
        file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT));
    }

    public function updateArticle(string $id, Article $updatedArticle): void
    {
        $articles = $this->getAllArticles();
        foreach ($articles as $article) {
            if ($article->getId() === $id) {
                $article->setTitle($updatedArticle->getTitle());
                $article->setUrl($updatedArticle->getUrl());
            }
        }
        file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT));
    }
}
