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
    public function index(Request $request): void
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
        $this->startSession();
        if ($request->isAuthenticated()) {
            $this->render('createArticle', [], false);
            unset($_SESSION['title_error'], $_SESSION['link_error'], $_SESSION['link'], $_SESSION['title']);
            exit;
        }
        $this->redirect('/login?from=/articles/create');
    }

    /**
     * Process the creation of a new article
     */
    public function store(Request $request): void
    {
        $title = $request->input("title");
        if (empty(trim($title))) {
            Controller::setSessionData('title_error', 'Error! Title cannot be empty.');
            $this->redirect('/articles/create');
        }
        $link = $request->input("link");
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            Controller::setSessionData('link_error', 'Error! Invalid link provided.');
            Controller::setSessionData('link', $link);
            Controller::setSessionData('title', $title);
            $this->redirect('/articles/create');
        }

        $articleRepository = new ArticleRepository();
        $articleRepository->saveArticle($title, $link, Controller::getSessionData('user_id'));
        $this->redirect('/articles');
    }

    /**
     * Show the form for editing an article.
     * @param Request $request
     * @return void
     */
    public function edit(Request $request): void
    {
        $this->startSession();
        $edit_id = $request->input("edit_id");
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->getArticleById($edit_id);
        if ($request->isAuthenticated() && $edit_id !== null && $article && $article->author_id == Controller::getSessionData('user_id')) {
            $this->render('editArticle' , ['edit_id' => $request->input("edit_id")], false);
            unset($_SESSION['title_error'], $_SESSION['link_error']);
            exit;
        }
        $this->redirect('/login?from=/articles/edit?edit_id=' . $request->input("edit_id"));
    }

    /**
     * Process the editing of an article.
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        if ($request->isGuest()) {
            $this->redirect('/login');
        }
        $title = $request->input("title");
        if (empty(trim($title))) {
            Controller::setSessionData('title_error', 'Error! Title cannot be empty.');
            $this->redirect('/articles/edit?edit_id=' . $request->input("edit_id"));
        }
        $link = $request->input("link");
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            Controller::setSessionData('link_error', 'Error! Invalid link provided.');
            $this->redirect('/articles/edit?edit_id=' . $request->input("edit_id"));
        }
        $edit_id = $request->input("edit_id");
        $articleRepository = new ArticleRepository();
        $articleRepository->updateArticle($edit_id, $title, $link);
        $this->redirect('/articles');
    }

    /**
     * Process the deleting of an article.
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        if ($request->isGuest()) {
            $this->redirect('/login?from=/articles');
        };
        $this->startSession();
        $delete_id = $request->input("delete_id");
        $articleRepository = new ArticleRepository();
        $author_id = $articleRepository->getArticleById($delete_id)->author_id;
        if ($author_id && $author_id == Controller::getSessionData('user_id')) {
            $articleRepository->deleteArticleById($delete_id);
        }
        $this->redirect('/articles');
    }

}
