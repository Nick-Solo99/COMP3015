<?php

class Article implements JsonSerializable
{
    private string $title;
    private string $url;
    private string $id;

    public function __construct(string $id, string $title = '', string $url = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function fill(array $articleData): Article
    {
        foreach ($articleData as $key => $value) {
            $this->{$key} = $value; // dynamically add properties to the Book object
        }
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'url' => $this->getUrl(),
        ];
    }
}
