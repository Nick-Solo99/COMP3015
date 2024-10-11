<div class="navbar bg-neutral text-neutral-content">
    <div class="navbar-start">
        <a href="/index.php" class="btn btn-ghost text-xl text-primary">COMP 3015 Lab03</a>
    </div>
    <div class="navbar-end space-x-2">

        <?php if ($_SESSION['email']): ?>
        <a href="/logout.php" class="btn btn-outline btn-error">Log Out</a>

        <?php else: ?>
        <a href="/login.php" class="btn btn-outline btn-primary">Log In</a>
        <a href="/register.php" class="btn btn-outline btn-base-content">Register</a>
        <?php endif; ?>

    </div>
</div>