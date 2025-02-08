<?php
require_once __DIR__ . "/header.php";
use App\helper;
$taskObj = new \App\Controllers\TaskController();
if(isset($id)) {
    $task = $taskObj->taskById($id);
    if(!$task){
        Header('Location: /');
    }
}else{
    Header('Location: /');
}

?>
<div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-xl font-bold mb-4">Просмотр задачи</h2>

    <label class="font-bold">Текст задачи:</label>
    <p class="w-full p-2 bg-gray-100 rounded-lg"> <?= htmlspecialchars($task->task_text) ?> </p>

    <label class="font-bold mt-4 block">Дата создания:</label>
    <p class="w-full p-2 bg-gray-100 rounded-lg"> <?= isset($task->date_begin) ? helper::formatDate($task->date_begin) : '' ?> </p>

    <label class="font-bold mt-4 block">Крайний срок выполнения:</label>
    <p class="w-full p-2 bg-gray-100 rounded-lg"> <?= isset($task->date_end) ? helper::formatDate($task->date_end) : '' ?> </p>

    <a href="/">
        <button class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Назад</button>
    </a>
</div>
<?php require_once __DIR__ . "/footer.php" ?>
