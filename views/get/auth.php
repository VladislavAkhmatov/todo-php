<?php
require_once __DIR__ . "/header.php" ;
if(isset($_GET['q'])){
    $message = 'Ошибка. Такого пользователя не существует!';
}
?>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto flex-col" id="loginForm">
        <h2 class="text-2xl font-bold mb-4 text-center">Авторизация</h2>
        <?php if(isset($message)): ?>
            <p class="font-bold text-m text-center text-red-500 "><?= $message ?></p>
        <?php endif ?>
        <form action="/auth" method="POST">
            <div class="mb-4">
                <label for="loginEmail" class="block text-gray-700">Email</label>
                <input type="email" id="loginEmail" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="loginPassword" class="block text-gray-700">Пароль</label>
                <input type="password" id="loginPassword" name="pass" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" name="auth" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Войти</button>
        </form>
        <p class="mt-4 text-center">
            Нет аккаунта? <a href="/register" class="text-blue-500 hover:underline">Зарегистрироваться</a>
        </p>
    </div>
<?php require_once __DIR__ . "/footer.php" ?>