<?php
// TODO: Get the authenticated user and display their data in the navigation bar
$authenticatedUser = null;
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
                        <?= $authenticatedUser->name ?>!&nbsp;&nbsp;</span>
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
</div>


<!--<nav class="bg-gray-800">-->
<!--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">-->
<!--        <div class="flex justify-between h-16">-->
<!--            <div class="flex">-->
<!---->
<!--                <div class="flex-shrink-0 flex items-center text-lg text-white">-->
<!--                    NewCo.-->
<!--                </div>-->
<!---->
<!--                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">-->
<!--                    <a href="/" class=" text-white px-3 py-2 rounded-md text-sm font-medium">All Articles</a>-->
<!--                </div>-->
<!---->
<!--				--><?php //if ($authenticatedUser):?>
<!--                    <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">-->
<!--                        <a href="/articles/create" class="text-white px-3 py-2 rounded-md text-sm font-medium">New-->
<!--                            Article</a>-->
<!--                    </div>-->
<!--				--><?php //endif;?>
<!---->
<!--            </div>-->
<!---->
<!--            <div class="flex items-center">-->
<!---->
<!--				--><?php //if ($authenticatedUser):?>
<!---->
<!--                    <a href="--><?php //= "/settings?id=$authenticatedUser->id"?><!--" class="mt-2">-->
<!--                        <span class="relative inline-block">-->
<!--                            <img class="h-8 w-8 rounded-full cover"-->
<!--                                 src="--><?php //= image($authenticatedUser->profile_picture)?><!--"-->
<!--                                 alt="">-->
<!--                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-green-400 ring-2 ring-white"></span>-->
<!--                        </span>-->
<!--                    </a>-->
<!---->
<!--                    &nbsp;&nbsp;-->
<!---->
<!--                    <div class="flex-shrink-0 text-white">-->
<!--                        <span>Welcome, --><?php //= $authenticatedUser->name?><!--!&nbsp;&nbsp;</span>-->
<!--                    </div>-->
<!---->
<!--                    <div>-->
<!--                        <form id="logout-form" action="/logout" method="POST">-->
<!--                            <svg onclick="logout()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 clickable"-->
<!--                                 fill="none"-->
<!--                                 viewBox="0 0 24 24"-->
<!--                                 stroke="white" stroke-width="2">-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round"-->
<!--                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>-->
<!--                            </svg>-->
<!--                        </form>-->
<!--                    </div>-->
<!---->
<!--				--><?php //else:?>
<!---->
<!--                    <div class="flex float-right">-->
<!--                        <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">-->
<!--                            <a href="/login" class="text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>-->
<!--                        </div>-->
<!--                        <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">-->
<!--                            <a href="/register"-->
<!--                               class="text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--				--><?php //endif;?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->

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