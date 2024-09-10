<?php
// Lab 1, part 2
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1, Part 2</title>
</head>

<body>

    <h1>FizzBuzz Problem</h1>

    <p>
        <?php for ($i = 1; $i <= 100; $i++):
            if ($i % 3 === 0 && $i % 5 === 0)
            {
                echo "<b>FizzBuzz</b><br>" . PHP_EOL;
            }
            else if ($i % 3 === 0)
            {
                echo "<b>Fizz</b><br>" . PHP_EOL;
            }
            else if ($i % 5 === 0)
            {
                echo "<b>Buzz</b><br>" . PHP_EOL;
            }
            else
            {
                echo "$i<br>" . PHP_EOL;
            }
        endfor; ?>
    </p>

</body>

</html>