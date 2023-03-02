<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = [
        [
            'id' => 1,
            'name' => 'Иван',
            'email' => 'ivan@example.com'
        ],
        [
            'id' => 2,
            'name' => 'Петр',
            'email' => 'petr@example.com'
        ],
        [
            'id' => 3,
            'name' => 'Мария',
            'email' => 'maria@example.com'
        ]
    ];

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $errors = [];

    if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'Заполните все поля';
    } else {
        if (strpos($email, '@') === false || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Некорректный email';
        }

        if ($password !== $confirm_password) {
            $errors[] = 'Пароли не совпадают';
        }


        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $errors[] = 'Пользователь с таким email уже зарегистрирован';
            }
        }
    }

    if (empty($errors)) {
        echo json_encode(['success' => true, 'message' => 'Вы успешно зарегистрировались!']);
    } else {
        echo json_encode(['success' => false, 'errors' => implode('<br>', $errors)]);
    }
} else {
    echo json_encode(['success' => false, 'errors' => 'Произошла ошибка при отправке данных']);
}