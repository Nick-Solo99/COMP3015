<?php
use src\Repositories\UserRepository;

$userRepo = New UserRepository();
$authenticatedUser = null;
if (!empty($_SESSION["user_id"])){
    $authenticatedUser = $userRepo->getUserByID($_SESSION["user_id"]);
}

?>

<?php require_once 'header.php' ?>

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
                    <li>
                        <div class="card bg-neutral rounded-box shadow-xl box-border my-5">
                            <div class="card-body">
                                <h2 class="card-title text-primary"><?=htmlspecialchars($article->title)?></h2>
                                <a href="<?=htmlspecialchars($article->url)?>" class="text-secondary" target="_blank"><?=htmlspecialchars($article->url)?></a>
                                <div class="flex items-center text-sm text-gray-500">
                                    <!-- Heroicon name: mini/calendar -->
                                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                    </svg>
                                    <p>
                                        Created on
                                        <time><?= $article->createdAtFmt() ?></time>
                                    </p>
                                </div>
                                <?php if ($article->updatedAtFmt()) :?>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <!-- Heroicon name: mini/calendar -->
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                        </svg>
                                        <p>
                                            Edited on
                                            <time><?= $article->updatedAtFmt() ?></time>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <div class="flex justify-between items-center mt-4">
                                    <div class="avatar">
                                        <div class="w-24 rounded-full">
                                            <img src="<?= image($userRepo->getUserById($article->author_id)->profile_picture) ?>" />
                                        </div>
                                    </div>
                                    <p class="ml-4">Created By <?=htmlspecialchars($userRepo->getUserById($article->author_id)->name)?></p>
                                    <?php if ($authenticatedUser && $authenticatedUser->id === $article->author_id) :?>
                                        <div class="flex space-x-2">
                                            <form method="get" action="/articles/edit">
                                                <button type="submit" name="edit_id" class="btn btn-outline btn-secondary" value="<?=$article->id?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            <form method="get" action="/articles/delete">
                                                <button type="submit" name="delete_id" class="btn btn-outline btn-error" value="<?=$article->id?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>


                            </div>
                        </div>
                    </li>
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
