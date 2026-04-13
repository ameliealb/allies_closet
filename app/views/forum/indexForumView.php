<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="forumBlock">

    <h2>forum</h2>

    <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?action=createMessage">créer un topic</a>
    <?php endif; ?>

    <?php if (empty($messages)): ?>
        <p>aucun message pour le moment.</p>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <article class="messageCard">
                <h2><?php echo htmlspecialchars($message['title']); ?></h2>
                <p>par <?php echo htmlspecialchars($message['username']); ?></p>
                <p><?php echo htmlspecialchars($message['date_of_creation']); ?></p>
                <p><?php echo htmlspecialchars(substr($message['content'], 0, 150)); ?>...</p>
                <a href="index.php?action=showMessage&id=<?php echo $message['id_message']; ?>">voir le topic</a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>