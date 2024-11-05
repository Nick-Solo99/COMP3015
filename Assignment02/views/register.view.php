<?php require_once 'header.php'; ?>
<body>
<?php require_once 'nav.php'; ?>

<div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold text-primary">Register now!</h1>
            <p class="py-6">
                Please enter your name, an email address, and a password to sign up for an account.
            </p>
        </div>
        <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" method="POST">
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text text-primary">Name</span>
                    </label>
                    <input type="text" placeholder="name" class="input input-bordered" id="name" name="name" value="<?=htmlspecialchars($_SESSION['name'] ?? null)?>" required />
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
                        <span>Error! Name must not be empty.</span>
                    </div>
                <?php endif; ?>
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text text-primary">Email</span>
                    </label>
                    <input type="text" placeholder="email" class="input input-bordered" id="email" name="email" value="<?=htmlspecialchars($_SESSION['email'] ?? null)?>" required />
                </div>
                <?php if (!empty($_SESSION['email_error'])) : ?>
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
                        <span><?=$_SESSION['email_error']?></span>
                    </div>
                <?php endif; ?>
                <div class="form-control">
                    <label class="label" for="password">
                        <span class="label-text text-primary">Password</span>
                    </label>
                    <input type="password" placeholder="password" class="input input-bordered" id="password" name="password" required />
                </div>
                <?php if (!empty($_SESSION['password_error'])) : ?>
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
                    <span>Error! Password cannot contain spaces, must be at least 8 chars long and contain at least 1 special character.</span>
                </div>
                <?php endif; ?>
                <label class="label">
                    <a href="/login" class="label-text-alt link link-hover">Already Have An Account?</a>
                </label>
                <div class="form-control mt-6">
                    <button class="btn btn-outline btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

<?php
function foo() : void {

}