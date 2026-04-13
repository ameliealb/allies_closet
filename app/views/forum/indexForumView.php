<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="forumBlock">

    <h2>forum</h2>
    <div class="underLine"></div>

    <p>let your <span>heart</span> and your <span>soul</span> <span>speak loud</span></p>

    <div class="underLineSmall"></div>
    <h3>bienvenue sur le forum : <br>crééer vos propres sujets et partagez vos visions <br>avec d'autres ALLIEGATORS. <br> <br> amicalement vôtre, <br><span>Allie</span></h3>
    <div class="underLineSmall"></div>


    <div id="mainForumBlock">
        <?php if (empty($messages)): ?>
            <p>aucun message pour le moment.</p>
        <?php else: ?>
            <?php foreach ($messages as $message): ?>
                <p>topics récents</p>
                <article class="messageCard">
                    <h4><?php echo htmlspecialchars($message['title']); ?></h4>
                    <p>par <?php echo htmlspecialchars($message['username']); ?></p>
                    <p><?php echo htmlspecialchars($message['date_of_creation']); ?></p>
                    <p><?php echo htmlspecialchars(substr($message['content'], 0, 150)); ?>...</p>
                    <a href="index.php?action=showMessage&id=<?php echo $message['id_message']; ?>">voir le topic</a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="sidebarForumBlock">
        <p>derniers commentaires</p>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?action=createMessage">créer un topic</a>
    <?php endif; ?>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>