<?php require_once __DIR__ . "/header.php" ?>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>
        <form action="/register" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Имя</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="age" class="block text-gray-700">Возраст</label>
                <input type="number" id="age" name="age" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Пароль</label>
                <input type="password" id="password" name="pass" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" name="reg" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Зарегистрироваться</button>
        </form>
        <p class="mt-4 text-center">
            Уже есть аккаунт? <a href="/auth" class="text-blue-500 hover:underline">Войти</a>
        </p>
    </div>
<?php require_once __DIR__ . "/footer.php" ?>