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
?>
    <div class="mb-6 bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
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
                    <!-- Поле для ввода начальной даты -->
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Начальная дата</label>
                    <input type="date" id="startDate" name="date_begin"
                           class="mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
                <div>
                    <!-- Поле для ввода конечной даты -->
                    <label for="endDate" class="block text-sm font-medium text-gray-700">Конечная дата</label>
                    <input type="date" id="endDate" name="date_end"
                           class="mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
            </div>
            <button id="addTask"
                    name="add_task"
                    class="w-full mb-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-blue-500">
                Добавить
            </button>
        </form>
        <div class="overflow-x-hidden bg-white p-8 rounded-lg shadow-lg w-full max-w-xl max-h-60 mx-auto">
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
                            <td class="py-2 border-b hidden md:table-cell"><?= isset($task->date_begin) ? helper::formatDate($task->date_begin) : ''  ?></td>
                            <td class="py-2 border-b hidden md:table-cell"><?= isset($task->date_end) ? helper::formatDate($task->date_end) : ''  ?></td>
                            <td class="py-2 px-4 border-b">
                                <a href="/show/<?= $task->task_id ?>"
                                   class="text-blue-500 cursor-pointer">Просмотреть</a>
                                <a href="/edit/<?= $task->task_id ?>" class="text-green-500 cursor-pointer">Редактировать</a>
                                <form action="/" METHOD="POST" class="inline">
                                    <input name="task_id" type="hidden" value="<?= $task->task_id ?>">
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

<?php require_once __DIR__ . "/footer.php" ?>