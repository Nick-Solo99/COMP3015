<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__ . '/header.php'; ?>
<body>
<?php include_once __DIR__ . '/nav.php'; ?>

<div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold text-primary">Upload Image</h1>
            <p class="py-6">
                Select an Image to upload.
            </p>
        </div>
        <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" enctype="multipart/form-data" method="POST">
                <div class="form-control">
                    <input
                            type="file"
                            name="image"
                            id="image"
                            class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary" type="submit">Upload</button>
                </div>
                <?php if (isset($success)) : ?>
                    <div role="alert" class="alert alert-success">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 shrink-0 stroke-current"
                                fill="none"
                                viewBox="0 0 24 24">
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Your purchase has been confirmed!</span>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <?php if (isset($success) && isset($fileName) && isset($metadata)) : ?>
            <div class="card bg-base-100 w-full max-w-xl shrink-0 shadow-2xl">
                <h2><?=$fileName?></h2>
                <pre><?=$metadata?></pre>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>

</html>