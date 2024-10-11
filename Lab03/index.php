<?php
session_start();
?>

<!doctype html>
<html lang="en">
<?php REQUIRE_ONCE './layout/header.php'; ?>
<body>
<?php require_once './layout/navigation.php'; ?>
<h1 class="text-3xl text-primary text-center">Welcome!</h1>

<?php if ($_SESSION['email']): ?>
    <div class="flex w-full flex-col border-opacity-50 p-5">
        <div class="card lg:card-side bg-blue-950 shadow-xl">
            <figure>
                <img
                        src="https://img.icons8.com/?size=100&id=iPqKoSmxmAyJ&format=png&color=000000"
                        alt="Dashboard Icon" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Dashboard</h2>
                <p>Click the button to view the dashboard.</p>
                <div class="card-actions justify-end">
                    <a href="dashboard.php" class="btn btn-outline btn-primary">View</a>
                </div>
            </div>
        </div>
        <div class="divider">OR</div>
        <div class="card lg:card-side bg-blue-950 shadow-xl">
            <figure>
                <img
                        src="https://img.icons8.com/?size=100&id=44001&format=png&color=000000"
                        alt="Log out icon" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Log Out</h2>
                <p>Click the button to log out of your account</p>
                <div class="card-actions justify-end">
                    <a href="logout.php" class="btn btn-outline btn-error">Log Out</a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="flex w-full flex-col border-opacity-50 p-5">
        <div class="card lg:card-side bg-blue-950 shadow-xl">
            <figure>
                <img
                        src="https://img.icons8.com/?size=100&id=48303&format=png&color=000000"
                        alt="Log in icon" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Log In</h2>
                <p>Click the button to log in now.</p>
                <div class="card-actions justify-end">
                    <a href="login.php" class="btn btn-outline btn-primary">Log in</a>
                </div>
            </div>
        </div>
        <div class="divider">OR</div>
        <div class="card lg:card-side bg-blue-950 shadow-xl">
            <figure>
                <img
                        src="https://img.icons8.com/?size=100&id=43970&format=png&color=000000"
                        alt="Register icon" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Register</h2>
                <p>Click the button to register a new account.</p>
                <div class="card-actions justify-end">
                    <a href="register.php" class="btn btn-outline btn-primary">Register</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
