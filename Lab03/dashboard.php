<?php
// TODO
// Prevent guest users from accessing this page.
// We will need to call session_start() and check $_SESSION['some_index']
// in order to determine if the user is authenticated or not.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
</head>
<body>
    <p>This is the dashboard page only for logged in users.</p>

    <?php
        // TODO
        // Display a "You're logged in as <email>" message as well as a logout link.
    ?>

</body>
</html>
