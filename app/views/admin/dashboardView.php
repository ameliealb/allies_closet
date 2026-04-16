<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="dashboard-container">

    <h2>bonjour <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h2>

    <section id="manageArticles">
        <h3>mes articles</h3>

        <?php
        $articles = getAllArticlesAdmin();
        foreach ($articles as $article):
        ?>
            <div class="articleRow">
                <p><?php echo htmlspecialchars($article['title']); ?></p>
                <p><?php echo htmlspecialchars($article['status']); ?></p>
                <a href="index.php?action=showEditArticle&id=<?php echo $article['id_article']; ?>">modifier</a>
                <a href="index.php?action=archiveArticle&id=<?php echo $article['id_article']; ?>">archiver</a>
                <a href="index.php?action=deleteArticle&id=<?php echo $article['id_article']; ?>" onclick="return confirm('Supprimer cet article ?')">supprimer</a>
            </div>
        <?php endforeach; ?>

        <a href="index.php?action=createArticle">+ créer un article</a>
    </section>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>