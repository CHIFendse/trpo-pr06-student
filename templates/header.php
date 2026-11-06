<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Менеджер заметок') ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="main-header">
        <div class="logo">ТРПО: ПР-06</div>
        <div class="user-info">
            Текущий пользователь: <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Гость') ?></strong>
            <span class="actions">
                [ <a href="index.php?action=switch_user">Сменить</a> | <a href="index.php?action=reset_session">Сбросить сессию</a> ]
            </span>
        </div>
    </header>