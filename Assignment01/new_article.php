<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';
// ... you'll probably need some of the require statements above
?>

<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body>
	<?php require_once 'layout/navigation.php' ?>
	<div class="flex min-h-full items-center justify-center px-4 mt-16 sm:px-6 lg:px-8">
		<div class="w-full max-w-xl space-y-8">


			The new article page. Handle displaying the new article form and handling article submissions here.

		</div>
	</div>
</body>

</html>