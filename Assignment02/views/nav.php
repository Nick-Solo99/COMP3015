<?php
use src\Repositories\UserRepository;
session_start();
$userRepository = new UserRepository();
$authenticatedUser = null;
if (!empty($_SESSION['user_id']))
{
    $authenticatedUser = $userRepository->getUserById($_SESSION['user_id']);
}
?>

<div class="navbar bg-indigo-500 text-primary-content">
    <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl" href="/">NewCo.</a>
    </div>
    <li class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li>
                <?php if ($authenticatedUser): ?>
                <a href="/articles/create">New Article</a>
                <?php endif; ?>
            </li>

            <?php if ($authenticatedUser): ?>
            <li>
                <a
                    href="<?= "/settings?id=$authenticatedUser->id" ?>">
                    <span class="relative inline-block">
                        <img class="h-8 w-8 rounded-full cover"
                            src="<?= image($authenticatedUser->profile_picture) ?>"
                            alt="">
                        <span
                            class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-green-400 ring-2 ring-white"></span>
                    </span>
                    <span>Welcome,
                        <?= htmlspecialchars($authenticatedUser->name) ?>!&nbsp;&nbsp;</span>
                </a>
            </li>

            &nbsp;&nbsp;


            <li>
                <form id="logout-form" action="/logout" method="POST">
                    <svg onclick="logout()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 clickable" fill="none"
                        viewBox="0 0 24 24" stroke="white" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </form>
            </li>

            <?php else: ?>
            <div class="flex float-right">
                <a href="/login" class="text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                <a href="/register" class="text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
            </div>

            <?php endif; ?>
        </ul>
</div>

<script>
    logout = () => {
        document.getElementById('logout-form').submit();
    }
</script>

<style>
    .clickable {
        cursor: pointer;
    }

    .cover {
        object-fit: cover;
    }
</style>