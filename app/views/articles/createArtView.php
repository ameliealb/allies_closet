<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div class="container" id="createArticleView">

    <h2>création d'un article</h2>
    <div class="underLine">&nbsp</div> 

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- enctype is absolutely needed to upload an image -->
    <form method="POST" action="index.php?action=submitArticle" enctype="multipart/form-data"> 

        <input type="text" name="title" placeholder="titre" required>

        <textarea name="content" placeholder="contenu de l'article" required></textarea>

        <select name="status">
            <option value="published">publié</option>
            <option value="draft">brouillon</option>
        </select>

        <input type="file" name="article_image" accept="image/*">

        <button type="submit">publier</button>

    </form>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>