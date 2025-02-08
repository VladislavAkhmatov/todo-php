<?php
require_once __DIR__ . "/header.php";
use App\helper;

$user_id = $_SESSION['user_id'];
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
    <h2 class="text-xl font-bold mb-4">Редактирование текста</h2>
    <form action="/" method="POST">
        <label for="textInput" class="block text-gray-700 font-medium mb-2">Введите текст:</label>
        <textarea name="task_text" id="textInput"
                  class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  rows="4"><?= $task->task_text ?></textarea>
        <input type="hidden" name="task_id" value="<?= $task->task_id ?>">

        <label for="endDate" class="block text-sm font-medium text-gray-700">Дата создания</label>
        <input type="datetime-local" id="endDate" name="date_begin"
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
               value="<?= helper::formatDateForDB($task->date_begin) ?>"
               required>

        <label for="endDate" class="block text-sm font-medium text-gray-700">Конечная дата</label>
        <input type="datetime-local" id="endDate" name="date_end"
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
               value="<?= helper::formatDateForDB($task->date_end) ?>"
               required>


        <button name="edit_task" type="submit"
                class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Сохранить
        </button>
        <a href="/" class="mt-4 w-full bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 text-center block">Назад</a>
    </form>
</div>
<?php require_once __DIR__ . "/footer.php" ?>
