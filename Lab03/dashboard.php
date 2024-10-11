<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php REQUIRE_ONCE './layout/header.php'?>
<body>
<?php REQUIRE_ONCE './layout/navigation.php'?>
    <div class="flex w-full flex-col border-opacity-50 p-5 items-center">
        <h1 class="text-2xl text-center text-primary">This is the dashboard page only for logged-in users.</h1>
        <?php if (isset($_SESSION['email'])): ?>
            <div class="card bg-neutral text-neutral-content w-96 m-5">
                <div class="card-body items-center text-center">
                    <h2 class="card-title">User Logged In.</h2>
                    <p>User is logged-in as <?=htmlspecialchars($_SESSION['email'])?></p>
                    <div class="card-actions justify-end">
                        <a href="logout.php" class="btn btn-outline btn-error">Log Out</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
