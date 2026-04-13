<?php require RACINE . '/app/views/layouts/header.php'; ?>

<section id="blogBlock">

    <h2>blog</h2>
    <div class="underLine">&nbsp</div> 

    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="blog">
        <input type="text" name="search" placeholder="rechercher un article..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">rechercher</button>
    </form>

    <?php if (empty($articles)): ?>
        <p>aucun article trouvé.</p>

    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <article class="articleCard">
                <?php if (!empty($article['article_image'])): ?>
                    <img src="<?php echo htmlspecialchars($article['article_image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                <?php endif; ?>

                <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                <p><?php echo htmlspecialchars($article['date_of_creation']); ?></p>
                <p><?php echo htmlspecialchars(substr($article['content'], 0, 150)); ?>...</p>

                <a href="index.php?action=showArticle&id=<?php echo $article['id_article']; ?>">lire la suite</a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

</section>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>