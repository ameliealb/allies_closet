<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="createMessageBlock">

    <h2>créer un topic</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=submitMessage">
        <input type="text" name="title" placeholder="titre du topic" required>
        <textarea name="content" placeholder="contenu du topic" required></textarea>
        <button type="submit">publier</button>
    </form>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>