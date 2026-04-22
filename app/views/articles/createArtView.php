<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div class="container" id="createArticleView">

    <h2>article creation</h2>
    <div class="underLine">&nbsp</div>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- enctype is absolutely needed to upload an image -->
    <form method="POST" action="?action=submitArticle" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="title" required>

        <textarea name="content" placeholder="article content" required></textarea>

        <label>category</label>
        <select name="category">
            <option value="mode">fashion</option>
            <option value="maquillage">makeup</option>
            <option value="chaussures">shoes</option>
            <option value="cheveux">hair</option>
            <option value="skincare">skincare</option>
            <option value="lifestyle">lifestyle</option>
        </select>

        <select name="status">
            <option value="published">publié</option>
            <option value="draft">brouillon</option>
        </select>

        <input type="file" name="article_image" accept="image/*">
        <p>Be careful ! The file chosen must not exceed 2MB and should preferably be a horizontal format.</p>

        <button type="submit">publish</button>

    </form>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>