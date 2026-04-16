<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div class="container" id="createArticleView">

    <h2>création d'un article</h2>
    <div class="underLine">&nbsp</div>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- enctype is absolutely needed to upload an image -->
    <form method="POST" action="?action=submitArticle" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="titre" required>

        <textarea name="content" placeholder="contenu de l'article" required></textarea>

        <label>catégorie</label>
        <select name="category">
            <option value="mode">mode</option>
            <option value="maquillage">maquillage</option>
            <option value="chaussures">chaussures</option>
            <option value="cheveux">cheveux</option>
            <option value="skincare">skincare</option>
            <option value="lifestyle">lifestyle</option>
        </select>

        <select name="status">
            <option value="published">publié</option>
            <option value="draft">brouillon</option>
        </select>

        <input type="file" name="article_image" accept="image/*">

        <button type="submit">publier</button>

    </form>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>