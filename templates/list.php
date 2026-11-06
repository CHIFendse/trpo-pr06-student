<main>
    <h2>Заметки</h2>

    <?php if (!empty($flashMessage)): ?>
        <div class="alert"><?= htmlspecialchars($flashMessage) ?></div>
    <?php endif; ?>

    <section class="card form-card">
        <h3>Новая заметка</h3>
        <form method="POST" action="index.php?action=add">
            <div class="form-group">
                <input type="text" name="title" placeholder="Заголовок заметки..." required>
            </div>
            <div class="form-group">
                <textarea name="text" placeholder="Текст заметки..." rows="4" required></textarea>
            </div>
            <button type="submit" class="btn">Добавить заметку</button>
        </form>
    </section>

    <section class="notes-grid">
        <?php if (empty($notes)): ?>
            <p class="empty-state">Заметок пока нет. Добавьте первую запись выше.</p>
        <?php else: ?>
            <?php foreach ($notes as $item): ?>
                <article class="card note-card">
                    <h4><?= htmlspecialchars($item['title'] ?? '') ?></h4>
                    <p><?= nl2br(htmlspecialchars($item['text'] ?? '')) ?></p>
                    <div class="meta">
                        <small>Автор: <strong><?= htmlspecialchars($item['author'] ?? 'Аноним') ?></strong></small>
                        <small>ID: <?= htmlspecialchars((string)($item['id'] ?? '')) ?></small>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>