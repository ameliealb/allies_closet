<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="editArticleBlock">

    <h2>modifier l'article</h2>
    <div class="underLine"></div>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="?action=submitEditArticle" enctype="multipart/form-data">

        <input type="hidden" name="id_article" value="<?php echo $article['id_article']; ?>">

        <label>titre</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>

        <label>contenu</label>
        <textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>

        <label>statut</label>
        <select name="status">
            <option value="published" <?php if ($article['status'] === 'published') echo 'selected'; ?>>publié</option>
            <option value="draft" <?php if ($article['status'] === 'draft') echo 'selected'; ?>>brouillon</option>
            <option value="archived" <?php if ($article['status'] === 'archived') echo 'selected'; ?>>archivé</option>
        </select>

        <label>image actuelle</label>
        <?php if (!empty($article['article_image'])): ?>
            <img src="<?php echo htmlspecialchars($article['article_image']); ?>" alt="image actuelle">
        <?php else: ?>
            <p>aucune image</p>
        <?php endif; ?>

        <label>changer l'image</label>
        <input type="file" name="article_image" accept="image/*">

        <button type="submit">sauvegarder</button>

    </form>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>