<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';
// ... you'll probably need some of the require statements above
?>

<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body>
	<?php require_once 'layout/navigation.php' ?>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold text-primary">Submit A New Article.</h1>
                <p class="py-6 text-base-content">
                    Please provide a title and the link to the article you would like to submit.
                </p>
            </div>
            <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
                <form class="card-body" action="new_article.php" method="post">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-secondary">Title</span>
                        </label>
                        <input id="title" name="title" type="text" placeholder="title" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-secondary">Link</span>
                        </label>
                        <input id="link" name="link" type="text" placeholder="link" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-outline btn-primary" type="submit">Submit</button>
                    </div>
                    <?php if (isset($_GET['submission_error'])) : ?>
                        <div role="alert" class="alert alert-error">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 shrink-0 stroke-current"
                                    fill="none"
                                    viewBox="0 0 24 24">
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><?=htmlspecialchars($_GET['submission_error'])?></span>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $link = htmlspecialchars($_POST['link']);

    $validTitle = (!empty(trim($title)));
    if (!$validTitle) {
        header('location: new_article.php?submission_error=Error! Title must not be empty.');
        exit();
    }

    $validLink = filter_var($link, FILTER_VALIDATE_URL);
    if (!$validLink) {
        header('location: new_article.php?submission_error=Error! Invalid link provided.');
        exit();
    }

    $article = new Article(uniqid(),$title, $link);
    $articleRepository = new ArticleRepository('articles.json');
    $articleRepository->saveArticle($article);

    header('Location: index.php?from=new_article&msg=Article submitted successfully');
    exit();
}
?>