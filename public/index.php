<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../src/storage.php';
require_once __DIR__ . '/../src/render.php';

$_SESSION['user_name'] ??= 'Студент';

$action = $_GET['action'] ?? null;
$page = $_GET['page'] ?? 'list';

if ($action === 'switch_user') {
    $_SESSION['user_name'] = $_SESSION['user_name'] === 'Студент' ? 'Преподаватель' : 'Студент';
    header('Location: index.php');
    exit;
}

if ($action === 'reset_session') {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'add') {
    $title = trim($_POST['title'] ?? '');
    $text = trim($_POST['text'] ?? '');

    if ($title !== '' && $text !== '') {
        $notes = loadNotes();
        $notes[] = [
            'id' => time() . mt_rand(100, 999),
            'title' => $title,
            'text' => $text,
            'author' => $_SESSION['user_name']
        ];
        saveNotes($notes);
        $_SESSION['flash'] = 'Заметка успешно сохранена!';
    }
    header('Location: index.php');
    exit;
}

if ($page !== 'list') {
    http_response_code(404);
    render('404', ['title' => 'Ошибка 404']);
    exit;
}

$notes = loadNotes();
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

render('list', [
    'title' => 'Менеджер заметок',
    'notes' => $notes,
    'flashMessage' => $flash
]);