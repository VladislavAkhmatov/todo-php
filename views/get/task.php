<?php
require_once __DIR__ . "/header.php";

use App\Controllers\TaskController;

if (!isset($_SESSION['user_id'])) {
    Header("location: /auth");
    exit();
}

$task = new TaskController();
$user_id = $_SESSION['user_id'];
$tasks = $task->allTaskByUserId($user_id);
?>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl mx-auto">
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
            <?php if ($tasks): ?>
            <?php foreach ($tasks as $task): ?>
            <tbody>
            <tr>
                <td class="py-2 px-4 border-b"><?= htmlspecialchars($task->task_text) ?></td>
                <td class="py-2 px-4 border-b"></td>
                <td class="py-2 px-4 border-b"></td>
                <td class="py-2 px-4 border-b">
                        <a href="/edit/<?= $task->task_id ?>" class="text-blue-500 cursor-pointer">Редактировать
                        </a>
                    <form action="/" METHOD="POST">
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
<?php require_once __DIR__ . "/footer.php" ?>