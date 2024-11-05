<?php
require_once 'header.php'
?>

<body>

    <?php require_once 'nav.php' ?>

    <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

        <h1 class="text-xl text-center font-semibold text-indigo-500 mt-10 mb-10 title">Articles</h1>

        <div class="text-center">
            <?= count($articles) === 0 ? "No articles yet :(" : ""; ?>
        </div>

        <div class="sm:rounded-md">
            <ul role="list" class="mb-20">
                <?php foreach ($articles as $article) : ?>
                    <!-- TODO: display each article, who posted it (profile pic + name), and data about when it was posted/edited -->
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

</body>

<style>
    .cover {
        object-fit: cover;
    }

    .delete-btn:hover {
        cursor: pointer;
    }

    .card-title:hover {
        text-decoration: underline;
    }

    .title {
        font: normal 40px cursive, Arial, sans-serif;
    }
</style>
