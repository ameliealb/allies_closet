<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="createMessageBlock">

    <h2>créer un topic</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=submitMessage">
        <input type="text" name="title" placeholder="titre du topic" required>
        <textarea name="content" placeholder="contenu du topic" required></textarea>
        <label>catégorie</label>
        <select name="category">
            <option value="mode">mode</option>
            <option value="maquillage">maquillage</option>
            <option value="chaussures">chaussures</option>
            <option value="cheveux">cheveux</option>
            <option value="skincare">skincare</option>
            <option value="lifestyle">lifestyle</option>
        </select>
        <button type="submit">publier</button>
    </form>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>