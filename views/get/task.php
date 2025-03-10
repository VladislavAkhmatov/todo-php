<?php
require_once __DIR__ . "/header.php";

use App\Controllers\TaskController;
use App\helper;

if (!isset($_SESSION['user_id'])) {
    Header("location: /auth");
    exit();
}

$task = new TaskController();
$user_id = $_SESSION['user_id'];
$tasks = $task->tasksByUserId($user_id);
$overdueTasks = $task->overdueTasksByUserId($user_id);
$doneTasks = $task->doneTaskByUserId($user_id);
?>


<div class="bg-white overflow-y-auto p-8 rounded-lg shadow-lg w-full max-w-3xl mx-auto max-h-screen">
    <!-- Рекламные блоки -->
    <h1 class="text-2xl font-bold text-center">Просроченные задачи</h1>

    <div class="mb-6 overflow-x-hidden bg-white p-8 rounded-lg shadow-lg w-full max-w-l max-h-40 mx-auto bg-red-200">
        <table class="w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Задача</th>
                <th class="py-2 px-4 border-b hidden md:table-cell">Дата начала</th>
                <th class="py-2 px-4 border-b hidden md:table-cell">Дата окончания</th>
                <th class="py-2 px-4 border-b">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($overdueTasks): ?>
                <?php foreach ($overdueTasks as $overdueTask): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($overdueTask->task_text) ?></td>
                        <td class="py-2 border-b hidden md:table-cell"><?= isset($overdueTask->date_begin) ? helper::formatDate($overdueTask->date_begin) : '' ?></td>
                        <td class="py-2 border-b hidden md:table-cell"><?= isset($overdueTask->date_end) ? helper::formatDate($overdueTask->date_end) : '' ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="/show/<?= $overdueTask->task_id ?>"
                               class="text-blue-500 cursor-pointer">Просмотреть</a>
                            <form action="/" METHOD="POST" class="inline">
                                <input name="task_id" type="hidden" value="<?= $overdueTask->task_id ?>">
                                <button name="delete_task" class="text-red-500 cursor-pointer"
                                        onclick="return confirm('Вы уверены?')">Удалить
                                </button>
                            </form>
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
    </div>

    <h1 class="text-2xl font-bold text-center mb-2">Todo List</h1>
    <h4 class="text-center font-bold mb-2">Добро пожаловать, <?= $_SESSION['name'] ?>.
        <form action="/logout" method="POST">
            <button name="logout" class="text-blue-500 hover:underline">Выйти</button>
        </form>
    </h4>
    <form action="/" method="POST">
        <div class="flex mb-6">
            <input name="task_text" type="text" id="newTask" placeholder="Новая задача"
                   class="flex-1 p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>
        <div class="flex justify-between mb-4">
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700">Начальная дата</label>
                <input type="datetime-local" id="startDate" name="date_begin"
                       class="mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>
            <div>
                <label for="endDate" class="block text-sm font-medium text-gray-700">Конечная дата</label>
                <input type="datetime-local" id="endDate" name="date_end"
                       class="mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>
        </div>
        <input type="hidden" name="overdue" value="0">
        <input type="hidden" name="done" value="0">
        <button id="addTask"
                name="add_task"
                class="w-full mb-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-blue-500">
            Добавить
        </button>
    </form>


    <div class="mb-6 overflow-x-hidden bg-white p-8 rounded-lg shadow-lg w-full max-h-60 mx-auto bg-green-200">
        <table class="w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Задача</th>
                <th class="py-2 px-4 border-b hidden md:table-cell">Дата начала</th>
                <th class="py-2 px-4 border-b hidden md:table-cell">Дата окончания</th>
                <th class="py-2 px-4 border-b">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($tasks): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($task->task_text) ?></td>
                        <td class="py-2 border-b hidden md:table-cell"><?= isset($task->date_begin) ? helper::formatDate($task->date_begin) : '' ?></td>
                        <td class="py-2 border-b hidden md:table-cell"><?= isset($task->date_end) ? helper::formatDate($task->date_end) : '' ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="/show/<?= $task->task_id ?>"
                               class="text-blue-500 cursor-pointer">Просмотреть</a>
                            <a href="/edit/<?= $task->task_id ?>"
                               class="text-green-500 cursor-pointer">Редактировать</a>
                            <form action="/" METHOD="POST" class="inline">
                                <input name="task_id" type="hidden" value="<?= $task->task_id ?>">
                                <button name="delete_task" class="text-red-500 cursor-pointer"
                                        onclick="return confirm('Вы уверены?')">Удалить
                                </button>
                            </form>
                            <form action="/" METHOD="POST" class="inline">
                                <input name="task_id" type="hidden" value="<?= $task->task_id ?>">
                                <button name="done_task" class="text-yellow-500 cursor-pointer">Отметить как выполненое
                                </button>
                            </form>
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
    </div>

    <h1 class="text-2xl font-bold text-center">Выполненые задачи</h1>
    <div class="overflow-x-hidden bg-white p-8 rounded-lg shadow-lg w-full max-h-60 mx-auto bg-yellow-200">
        <table class="w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Задача</th>
                <th class="py-2 px-4 border-b hidden md:table-cell">Дата начала</th>
                <th class="py-2 px-4 border-b hidden md:table-cell">Дата окончания</th>
                <th class="py-2 px-4 border-b">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($doneTasks): ?>
                <?php foreach ($doneTasks as $doneTask): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($doneTask->task_text) ?></td>
                        <td class="py-2 border-b hidden md:table-cell"><?= isset($doneTask->date_begin) ? helper::formatDate($doneTask->date_begin) : '' ?></td>
                        <td class="py-2 border-b hidden md:table-cell"><?= isset($doneTask->date_end) ? helper::formatDate($doneTask->date_end) : '' ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="/show/<?= $doneTask->task_id ?>"
                               class="text-blue-500 cursor-pointer">Просмотреть</a>
                            <form action="/" METHOD="POST" class="inline">
                                <input name="task_id" type="hidden" value="<?= $doneTask->task_id ?>">
                                <button name="delete_task" class="text-red-500 cursor-pointer"
                                        onclick="return confirm('Вы уверены?')">Удалить
                                </button>
                            </form>
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
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let now = new Date();

        let timezoneOffset = now.getTimezoneOffset() * 60000;
        let localDateTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);

        document.getElementById("startDate").value = localDateTime;
    });
</script>
<?php require_once __DIR__ . "/footer.php" ?>
