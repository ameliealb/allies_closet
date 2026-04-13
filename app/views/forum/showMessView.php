<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="showMessageBlock">

    <article id="mainMessage">
        <h1><?php echo htmlspecialchars($message['title']); ?></h1>
        <p>par <?php echo htmlspecialchars($message['username']); ?></p>
        <p><?php echo htmlspecialchars($message['date_of_creation']); ?></p>
        <p><?php echo htmlspecialchars($message['content']); ?></p>
    </article>

    <section id="replies">
        <h2>réponses</h2>

        <?php if (empty($replies)): ?>
            <p>aucune réponse pour le moment.</p>
        <?php else: ?>
            <?php foreach ($replies as $reply): ?>
                <article class="replyCard">
                    <p>par <?php echo htmlspecialchars($reply['username']); ?></p>
                    <p><?php echo htmlspecialchars($reply['date_of_creation']); ?></p>
                    <p><?php echo htmlspecialchars($reply['content']); ?></p>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <?php if (isset($_SESSION['user'])): ?>
        <section id="replyForm">
            <h2>répondre</h2>

            <?php if (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?action=submitReply">
                <input type="hidden" name="id_reply" value="<?php echo $message['id_message']; ?>">
                <input type="text" name="title" placeholder="titre de ta réponse">
                <textarea name="content" placeholder="ta réponse..." required></textarea>
                <button type="submit">répondre</button>
            </form>
        </section>
    <?php else: ?>
        <p><a href="index.php?action=loginPage">connecte-toi</a> pour répondre.</p>
    <?php endif; ?>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>