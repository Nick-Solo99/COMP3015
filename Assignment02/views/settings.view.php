<?php

use src\Repositories\UserRepository;

$userRepository = new UserRepository();
$user = null;

if (!empty($_SESSION['user_id'])) {
    $user = $userRepository->getUserById($_SESSION['user_id']);
}
?>


<?php require_once 'header.php'; ?>

<body>
<?php require_once 'nav.php'; ?>

<div class="hero bg-base-100 min-h-screen flex flex-col items-center space-y-4 pt-10">

    <h1 class="text-primary text-4xl text-center mb-4">Settings</h1>

    <form class="w-full max-w-xl space-y-6" method="post" enctype="multipart/form-data">
        <div class="grid grid-cols-2 items-center gap-4">
            <label>
                <span>Email:</span>
            </label>
            <input
                type="text"
                placeholder="<?=htmlspecialchars($user->email ?? 'Email')?>"
                class="input input-bordered input-primary w-full" disabled/>
        </div>
        <div class="divider divider-primary"></div>
        <div class="grid grid-cols-2 items-center gap-4">
            <label>
                <span>Name:</span>
            </label>
            <input
                type="text"
                value="<?=htmlspecialchars($user->name ?? 'Name')?>"
                class="input input-bordered input-primary w-full"
                name="name"/>
        </div>
        <?php if (!empty($_SESSION['name_error'])) : ?>
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
                <span><?=$_SESSION['name_error']?></span>
            </div>
        <?php endif; ?>
        <div class="divider divider-primary"></div>
        <div class="grid grid-cols-2 items-center gap-4">
            <div class="avatar">
                <div class="w-24 rounded-full">
                    <img src="<?=image($user->profile_picture) ?? 'https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp'?>"  alt="Profile Picture"/>
                </div>
            </div>
            <input
                type="file"
                class="file-input file-input-bordered file-input-primary w-full"
                name="img"/>
        </div>
        <?php if (!empty($_SESSION['upload_error'])) : ?>
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
                <span><?=$_SESSION['upload_error']?></span>
            </div>
        <?php endif; ?>
        <div class="flex justify-end">
            <button type="submit" class="btn btn-outline btn-primary" name="id" value="<?=htmlspecialchars($user->id ?? null)?>">Save</button>
        </div>
    </form>

</div>

</body>
