<?php 

$message = "";
if(!empty($_POST['submit'])){
    if(empty($_POST["title"]) || empty($_POST["content"])){
        $message = "ERROR";
    } else {
        require_once 'connect.php';
        $todo = R::dispense('todos');
        $todo->title_todo = $_POST['title'];
        $todo->content_todo = $_POST['content'];
        $todo->done_todo = false;
        $todo->created_todo = date('Y-m-d H:i:s');
        $id = R::store($todo);
        if ($id){
            $message = "Done";
        } else {
            $message = "Error";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10">
        <h1 class="text-4xl font-bold mb-5 text-center">Todo List</h1>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <form method="post" action="#">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <input type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="Add todo">
            </form>
            <?=$message?>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 flex justify-between">
            <ul class="mb-4 todo-list">
                <?php
                require_once 'connect.php';

                $datas = R::find('todos');
                foreach($datas as $data):
                if ($data['done_todo'] == 0): ?>
                <li>
                    <h2 class="text-2xl font-semibold"><?=$data['title_todo']?></h2>
                    <p class="text-gray-700"><?=$data['content_todo']?></p>
                    <p class="text-gray-700"><?=$data['created_todo']?></p>
                    <span class="inline-block mt-2 px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">Todo</span>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <ul class="mb-4 done-todo-list">
            <?php
                foreach($datas as $data):
                if ($data['done_todo'] == 1): ?>
                <li>
                    <h2 class="text-2xl font-semibold"><?=$data['title_todo']?></h2>
                    <p class="text-gray-700"><?=$data['content_todo']?></p>
                    <p class="text-gray-700"><?=$data['created_todo']?></p>
                    <span class="inline-block mt-2 px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">Done</span>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>


                

            <!-- Add more todo items here -->
        </div>
    </div>

</body>
<script src="script.js"></script>
</html>
