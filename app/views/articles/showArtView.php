<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="showArticleBlock">

    <h2><?php echo htmlspecialchars($article['title']); ?></h2>
    <div class="underLine"></div>
    <p><?php echo htmlspecialchars($article['date_of_creation']); ?></p>

    <?php if (!empty($article['article_image'])): ?>
        <img src="<?php echo htmlspecialchars($article['article_image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
    <?php endif; ?>

    <div id="articleContent">
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        <div id="likeBlock">
            <span><?php echo $likes; ?> like<?php echo $likes > 1 ? 's' : ''; ?></span>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?action=toggleLikeArticle&id_article=<?php echo $article['id_article']; ?>">
                    <?php echo $hasLiked ? '♥︎ retirer le like' : '♡ liker'; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <section id="commentsBlock">
        <h2>commentaires</h2>

        <?php if (empty($comments)): ?>
            <p>aucun commentaire pour le moment.</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <article class="commentCard">
                    <p class="commentAuthor">
                        <a href="index.php?action=showProfile&id=<?php echo $comment['id_user']; ?>">
                            <?php echo htmlspecialchars($comment['username']); ?>
                        </a>
                    </p>
                    <p class="commentDate"><?php echo htmlspecialchars($comment['date_of_sending']); ?></p>
                    <p class="commentContent"><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>

                    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id_user'] == $comment['id_user'] || $_SESSION['user']['role'] === 'admin')): ?>
                        <a href="index.php?action=deleteComment&id_comment=<?php echo $comment['id_comment']; ?>&id_article=<?php echo $article['id_article']; ?>"
                            onclick="return confirm('Supprimer ce commentaire ?')">supprimer</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])): ?>
            <section id="commentForm">
                <h3>laisser un commentaire</h3>

                <?php if (!empty($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <form method="POST" action="index.php?action=submitComment">
                    <input type="hidden" name="id_article" value="<?php echo $article['id_article']; ?>">
                    <textarea name="content" placeholder="votre commentaire..." required></textarea>
                    <button type="submit">publier</button>
                </form>
            </section>
        <?php else: ?>
            <p><a href="index.php?action=loginPage">connecte-toi</a> pour commenter.</p>
        <?php endif; ?>

    </section>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>