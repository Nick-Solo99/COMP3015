<?php

use src\Repositories\ArticleRepository;

$articleRepo = new ArticleRepository();
$article = $articleRepo->getArticleById($edit_id);

?>


<?php require_once 'header.php' ?>

<body>
<?php require_once 'nav.php' ?>
<div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold text-primary">Update Article.</h1>
            <p class="py-6 text-base-content">
                Please provide a new title and the link for the article you would like to update.
            </p>
        </div>
        <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" method="post">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-primary">Title</span>
                    </label>
                    <input id="title" name="title" type="text" value="<?=htmlspecialchars($article->title) ?? 'title'?>" class="input input-bordered" required />
                </div>
                <?php if (!empty($_SESSION['title_error'])) : ?>
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
                        <span><?=$_SESSION['title_error']?></span>
                    </div>
                <?php endif; ?>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-primary">Link</span>
                    </label>
                    <input id="link" name="link" type="text" value="<?=htmlspecialchars($article->url) ?? 'link'?>" class="input input-bordered" required />
                </div>
                <?php if (!empty($_SESSION['link_error'])) : ?>
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
                        <span><?=$_SESSION['link_error']?></span>
                    </div>
                <?php endif; ?>
                <div class="form-control mt-6">
                    <button class="btn btn-outline btn-primary" type="submit" name="edit_id" value="<?=$article->id ?? null?>">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>