<?php
$emailRegex = "/^.*@bcit.ca$/";
session_start();
if (isset($_SESSION['email']))
{
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = false;
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !preg_match($emailRegex, $_POST['email'])) {
        $_SESSION['email_error'] = "invalid email address provided.";
        $errors = true;
    } elseif (empty($_POST["password"])) {
        $_SESSION['password_error'] = "password must not be empty";
        $errors = true;
    }
    if ($errors === true) {
        $_SESSION["attempted_email"] = $_POST["email"];
        header('Location: login.php');
    } else {
        $_SESSION['email'] = $_POST["email"];
        header('Location: dashboard.php');
    }
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php REQUIRE_ONCE './layout/header.php'?>
<body>
<?php REQUIRE_ONCE './layout/navigation.php' ?>
<div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">Login now!</h1>
            <p class="py-6">
                Enter your login information here.
            </p>
        </div>
        <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" action="login.php" method="post">
                <div class="form-control">
                    <span class="text-error">
                        <?php
                        if (isset($_SESSION['email_error'])) {
                            echo $_SESSION['email_error'];
                            unset($_SESSION['email_error']);
                        }
                        ?>
                    </span>
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input id="email" name="email" type="text" placeholder="email" value="<?=isset($_SESSION['attempted_email']) ? $_SESSION['attempted_email'] : ''?>" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <span class="text-error">
                        <?php
                        if (isset($_SESSION['password_error'])) {
                            echo $_SESSION['password_error'];
                            unset($_SESSION['password_error']);
                        }
                        ?>
                    </span>
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input id="password" name="password" type="password" placeholder="password" class="input input-bordered" required />
                    <label class="label">
                        <a href="#" class="label-text-alt link link-hover">Forgot password?</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
