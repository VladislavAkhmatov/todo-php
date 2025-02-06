<?php
require_once __DIR__ . "/header.php";

use App\Controllers\TaskController;

$task = new TaskController();
$user_id = $_SESSION['user_id'];
$tasks = $task->taskById($user_id);
?>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-center mb-6">Todo List</h1>

    <form action="/tasks" method="POST">
        <div class="flex mb-6">
            <input name="task_text" type="text" id="newTask" placeholder="Новая задача"
                class="flex-1 p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <button id="addTask"
                name="add_task"
                class="bg-blue-500 text-white p-2 rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Добавить
            </button>
        </div>
    </form>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Задача</th>
            <th class="py-2 px-4 border-b">Дата начала</th>
            <th class="py-2 px-4 border-b">Дата окончания</th>
            <th class="py-2 px-4 border-b">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($tasks)): ?>
            <?php foreach($tasks as $task): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($task->task_text) ?></td>
                    <td class="py-2 px-4 border-b"></td>
                    <td class="py-2 px-4 border-b"></td>
                    <td class="py-2 px-4 border-b">
                        <a href="/edit/<?= $task->id ?>" class="text-blue-500 hover:text-blue-700">Редактировать</a>
                        <a href="/delete/<?= $task->id ?>" class="text-red-500 hover:text-red-700 ml-2" onclick="return confirm('Вы уверены?')">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="py-2 px-4 border-b text-center">Задачи не найдены</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <form action="/logout" method="POST" class="mt-4 text-center">
        <button name="logout" class="text-blue-500 hover:underline">Выйти</button>
    </form>
</div>
<?php require_once __DIR__ . "/footer.php" ?>