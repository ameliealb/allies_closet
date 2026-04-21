<?php require RACINE . '/app/views/layouts/header.php'; ?>

<section id="blogBlock">

    <h2>blog</h2>
    <div class="underLine">&nbsp</div>

    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="blog">
        <input type="text" name="search" placeholder="rechercher un article..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">rechercher</button>
    </form>

    <nav id="categoriesNav">
        <?php $currentCategory = $_GET['category'] ?? ''; ?>
        <?php $currentAction = $_GET['action'] ?? ''; ?>

        <a href="index.php?action=blog"
            class="<?php echo $currentAction === 'blog' && empty($currentCategory) ? 'active' : ''; ?>">
            tous
        </a>
        <a href="index.php?action=showCategory&category=mode"
            class="<?php echo $currentCategory === 'mode' ? 'active' : ''; ?>">
            mode
        </a>
        <a href="index.php?action=showCategory&category=maquillage"
            class="<?php echo $currentCategory === 'maquillage' ? 'active' : ''; ?>">
            maquillage
        </a>
        <a href="index.php?action=showCategory&category=chaussures"
            class="<?php echo $currentCategory === 'chaussures' ? 'active' : ''; ?>">
            chaussures
        </a>
        <a href="index.php?action=showCategory&category=cheveux"
            class="<?php echo $currentCategory === 'cheveux' ? 'active' : ''; ?>">
            cheveux
        </a>
        <a href="index.php?action=showCategory&category=skincare"
            class="<?php echo $currentCategory === 'skincare' ? 'active' : ''; ?>">
            skincare
        </a>
        <a href="index.php?action=showCategory&category=lifestyle"
            class="<?php echo $currentCategory === 'lifestyle' ? 'active' : ''; ?>">
            lifestyle
        </a>
    </nav>

    <?php if (empty($articles)): ?>
        <p>aucun article trouvé.</p>

    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <article class="articleCard">
                <div class="articleContent">
                    <p><?php echo htmlspecialchars($article['category']); ?></p>
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p><?php echo htmlspecialchars($article['date_of_creation']); ?></p>
                    <p><?php echo htmlspecialchars(substr($article['content'], 0, 150)); ?>...</p>
                    <a href="index.php?action=showArticle&id=<?php echo $article['id_article']; ?>">lire la suite</a>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

    <nav id="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?action=blog&page=<?php echo $page - 1; ?>">← précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?action=blog&page=<?php echo $i; ?>"
                <?php if ($i === $page): ?> class="activePage" <?php endif; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="index.php?action=blog&page=<?php echo $page + 1; ?>">suivant →</a>
        <?php endif; ?>
    </nav>

</section>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>