<?php
require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';

$articleRepository = new ArticleRepository('articles.json');
$articles = $articleRepository->getAllArticles();

if (isset($_POST['deleteArticle'])) {
    $deleteId = $_POST['deleteArticle'];
    $selectedArticle = $articleRepository->getArticleById($deleteId);
}

if (isset($_POST['confirmDelete'])) {
    $deleteId = $_POST['confirmDelete'];
    $articleRepository->deleteArticleById($deleteId);
    header('location: index.php?delete=success!');
    exit();
}

if (isset($_POST['editArticle'])){
    $editId = htmlspecialchars($_POST['editArticle']);
    $selectedArticle = $articleRepository->getArticleById($editId);
}

if (isset($_POST['applyChanges']) && isset($_POST['title']) && isset($_POST['link'])) {
    $editId = htmlspecialchars($_POST['applyChanges']);
    $selectedArticle = $articleRepository->getArticleById($editId);

    $title = htmlspecialchars($_POST['title']);
    $validTitle = (!empty(trim($title)));
    if (!$validTitle) {
        $editError = 'Error! Title must not be empty.';
    }

    $link = htmlspecialchars($_POST['link']);
    $validLink = filter_var($link, FILTER_VALIDATE_URL);
    if (!$validLink) {
        $editError = 'Error! Invalid link provided.';
    }

    $newArticle = new Article(uniqid(), $title, $link);
    $articleRepository->updateArticle($editId, $newArticle);
    if (!isset($editError)) {
        header('location: index.php?edit=success!');
        exit();
    }
}

?>

<!doctype html>
<html lang="en">

<?php require_once 'layout/header.php' ?>

<body >

    <?php require_once 'layout/navigation.php' ?>

    <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
        <h2 id="page-title" class="text-xl text-center font-semibold mt-10 mb-5 text-primary">Articles</h2>
        <div class="overflow-auto">
            <ul role="list">
                <?php foreach ($articles as $article) : ?>
                <li>
                    <div class="card bg-neutral rounded-box shadow-xl box-border my-5">
                        <div class="card-body">
                            <h2 class="card-title text-primary"><?=$article->GetTitle()?></h2>
                            <a href="<?=$article->getUrl()?>" class="text-secondary" target="_blank"><?=$article->getUrl()?></a>
                            <div class="card-actions justify-end">
                                <form action="index.php" method="post">
                                    <button type="submit" name="editArticle" class="btn btn-outline btn-secondary" value="<?=$article->getId()?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                        </svg>
                                    </button>
                                    <button type="submit" name="deleteArticle" class="btn btn-outline btn-error" value="<?=$article->getId()?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php require_once 'layout/modals.php' ?>

</body>
</html>