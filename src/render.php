<?php
declare(strict_types=1);

function render(string $template, array $data = []): void {
    extract($data);
    $viewPath = __DIR__ . '/../templates/' . $template . '.php';
    if (!file_exists($viewPath)) {
        http_response_code(404);
        require __DIR__ . '/../templates/404.php';
        return;
    }
    require __DIR__ . '/../templates/header.php';
    require $viewPath;
    require __DIR__ . '/../templates/footer.php';
}