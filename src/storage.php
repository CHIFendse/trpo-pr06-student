<?php
declare(strict_types=1);

function getNotesFilePath(): string
{
    return __DIR__ . '/../data/notes.json';
}

function loadNotes(): array
{
    $path = getNotesFilePath();
    if (!file_exists($path)) {
        return [];
    }
    $content = file_get_contents($path);
    if ($content === false || trim($content) === '') {
        return [];
    }
    try {
        return json_decode($content, true, flags: JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
        return [];
    }
}

function saveNotes(array $notes): bool
{
    $path = getNotesFilePath();
    $data = json_encode($notes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path, $data, LOCK_EX) !== false;
}