<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\ArticleRepository;
use src\Repositories\UserRepository;

class ArticleController extends Controller
{
    /**
     * Display the page showing the articles.
     * @return void
     */
    public function index(): void
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getAllArticles();
        $this->render('index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the page for creating a new article
     */
    public function create(Request $request): void
    {
        // TODO
    }

    /**
     * Process the creation of a new article
     */
    public function store(Request $request): void
    {
        // TODO
    }

    /**
     * Show the form for editing an article.
     * @param Request $request
     * @return void
     */
    public function edit(Request $request): void
    {
        // TODO
    }

    /**
     * Process the editing of an article.
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        // TODO
    }

    /**
     * Process the deleting of an article.
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        // TODO
    }

}
