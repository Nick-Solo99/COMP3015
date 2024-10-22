<?php

require_once '../Repositories/ItemRepository.php';

use src\Repositories\ItemRepository;

$items = (new ItemRepository())->getAllItems();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["delete_id"]) && !empty($_POST["item_name"]) && !empty($_POST["quantity"])) {
        $item_name = $_POST["item_name"];
        $quantity = $_POST["quantity"];
        if ((new ItemRepository ())->addItem($item_name, $quantity)) {
            header('Location: part2.php');
        }
    }
    if (!empty($_POST["delete_id"]) && empty($_POST["item_name"]) && empty($_POST["quantity"])) {
       $delete_id = $_POST["delete_id"];
       if ((new ItemRepository ())->deleteItem($delete_id)) {
           header('Location: part2.php');
       }
    }
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!empty($_GET["search_term"])) {
        $search_term = $_GET["search_term"];
        $items = (new ItemRepository())->searchItems($search_term);
    }
    if (!empty($_GET["reset"])) {
        header('Location: part2.php');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts Web App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php require_once 'navigation/navigation_header.php' ?>

<body>
    <h1 class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight text-primary md:text-5xl lg:text-6xl">COMP 3014 Lab 4 - Part 2</h1>
    <div class="flex flex-col justify-center items-center m-10">
        <form class="w-full max-w-sm" action="part2.php" method="POST" >
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="item_name">
                        Grocery Item
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="item_name" name="item_name" type="text">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="quantity">
                        Quantity
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="quantity" name='quantity' type="number">
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        Add
                    </button>
                </div>
            </div>
        </form>
        <!-- ====== Table Section Start -->
        <section class="bg-white dark:bg-dark py-5 w-full space-y-4">
            <div class="w-full max-w-lg mx-auto">
                <form class="w-full max-w-lg space-x-4" action="part2.php" method="GET" >
                    <div class="flex items-center space-x-4">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="search_term">
                            Search
                        </label>
                        <input class="flex-grow bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="search_term" name="search_term" type="text" value="<?=empty($search_term) ? '' : $search_term?>">
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Search
                        </button>
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" name="reset" value="true">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
            <?php if (!empty($items)) : ?>
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full px-4">
                        <div class="max-w-full overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="text-center bg-purple-500">
                                    <th
                                            class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4"
                                    >
                                        Item
                                    </th>
                                    <th
                                            class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4"
                                    >
                                        Quantity
                                    </th>
                                    <th
                                            class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4 bg-[#be123c]"
                                    >
                                        Remove Item
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($items as $item) : ?>
                                    <tr>
                                        <td
                                                class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"
                                        >
                                            <?=$item->item_name?>
                                        </td>
                                        <td
                                                class="text-dark border-b border-[#E8E8E8] bg-white dark:border-dark dark:bg-dark-2 dark:text-dark-7 py-5 px-2 text-center text-base font-medium"
                                        >
                                            <?=$item->quantity?>
                                        </td>
                                        <td
                                                class="text-dark border-b border-r border-[#E8E8E8] bg-[#F3F6FF] dark:border-dark dark:bg-dark-2 dark:text-dark-7 py-5 px-2 text-center text-base font-medium"
                                        >
                                            <form action="part2.php" method="POST">
                                                <button
                                                        type="submit"
                                                        name="delete_id"
                                                        value="<?=$item->id?>"
                                                        class="inline-block px-6 py-2.5 border rounded-md border-primary text-primary hover:bg-primary hover:text-white font-medium"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <!-- ====== Table Section End -->
        </section>
    </div>
</body>
</html>