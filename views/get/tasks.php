<?php
require_once __DIR__ . "/header.php";

use App\Controllers\TaskController;

$task = new TaskController();
$tasks = $task->AllTasks();
?>
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-6">Todo List</h1>

    <!-- Форма для добавления новой задачи -->
    <form action="/tasks" method="POST">
        <div class="flex mb-6">
            <input type="text" id="newTask" placeholder="Новая задача"
                class="flex-1 p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button id="addTask"
                class="bg-blue-500 text-white p-2 rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Добавить
            </button>
        </div>
    </form>

    <!-- Список задач -->
    <ul id="taskList" class="space-y-2">
        <?php if ($tasks): ?>
            <?php foreach ($tasks as $item): ?>
                <?= $item->user_id; ?>
                <?= $item->name; ?>
                <?= $item->age; ?>
                <?= $item->email; ?>
                <?= $item->pass; ?>
            <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>
<?php require_once __DIR__ . "/footer.php" ?>