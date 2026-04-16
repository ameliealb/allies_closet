<?php require RACINE . '/app/views/layouts/header.php'; ?>



<h2>forum</h2>
<div class="underLine"></div>

<div id="introForum">
    <p>let your <span class="gold">heart</span> and your <span class="gold">soul</span> <span class="italicBold big gold">speak loud</span></p>

    <div class="underLineSmall"></div>
    <h3>bienvenue sur le forum : <br>crééer vos propres sujets et partagez vos visions <br>avec d'autres ALLIEGATORS. <br> <br> amicalement vôtre, <br><span class="signatureFont">Allie</span></h3>
    <div class="underLineSmall"></div>
</div>
<nav id="categoriesNav">
    <a href="index.php?action=forum">tous</a>
    <a href="index.php?action=showForumCategory&category=mode">mode</a>
    <a href="index.php?action=showForumCategory&category=maquillage">maquillage</a>
    <a href="index.php?action=showForumCategory&category=chaussures">chaussures</a>
    <a href="index.php?action=showForumCategory&category=cheveux">cheveux</a>
    <a href="index.php?action=showForumCategory&category=skincare">skincare</a>
    <a href="index.php?action=showForumCategory&category=lifestyle">lifestyle</a>
</nav>
<div id="forumBlock">

    <div id="mainForumBlock">

        <?php if (empty($messages)): ?>
            <p>aucun message pour le moment.</p>
        <?php else: ?>
            <p>topics récents</p>
            <?php foreach ($messages as $message): ?>
                <article class="messageCard">
                    <p class="messageCategory"><?php echo htmlspecialchars($message['category']); ?></p>
                    <h4><?php echo htmlspecialchars($message['title']); ?></h4>
                    <p><?php echo htmlspecialchars(substr($message['content'], 0, 150)); ?>...</p>
                    <p>rédigé par <span class="bold"><a href="index.php?action=showProfile&id=<?php echo $message['id_user']; ?>">
                                <?php echo htmlspecialchars($message['username']); ?>
                            </a></span> le <?php echo htmlspecialchars($message['date_of_creation']); ?></p>
                    <button><a href="index.php?action=showMessage&id=<?php echo $message['id_message']; ?>">voir le topic</a></button>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="sidebarForumBlock">
        <p>dernières réponses</p>
        <?php if (empty($lastReplies)): ?>
            <p>aucune réponse pour le moment.</p>
        <?php else: ?>
            <div id="sidenavBlock">
                <?php foreach ($lastReplies as $reply): ?>
                    <div class="sidenav">
                        <p>
                            par <strong><?php echo htmlspecialchars($reply['username']); ?></strong>
                            sur <a href="index.php?action=showMessage&id=<?php echo $reply['id_reply']; ?>">
                                <?php echo htmlspecialchars($reply['topic_title']); ?>
                            </a>
                            <p> >> <?php echo htmlspecialchars(substr($reply['content'], 0, 80)); ?></p>
                        </p>
                        
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <nav id="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?action=forum&page=<?php echo $page - 1; ?>">← précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?action=forum&page=<?php echo $i; ?>"
                <?php if ($i === $page): ?> class="activePage" <?php endif; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="index.php?action=forum&page=<?php echo $page + 1; ?>">suivant →</a>
        <?php endif; ?>
    </nav>

    <div>&nbsp;</div>



    <div id="speakUp">
        <p>lancez une discussion</p>
        <div id="speakUpCase">
            <p>exprimez-vous</p>
            <?php if (isset($_SESSION['user'])): ?>
                <button><a href="index.php?action=createMessage">créez un topic</a></button>
            <?php endif; ?>
            <?php if (!isset($_SESSION['user'])): ?>
                <h6><a href="index.php?action=loginPage">cliquez ici et connectez-vous pour écrire un topic</a></h6>
            <?php endif; ?>
        </div>
        <p>attention : ce site internet a été créé dans l’optique d’en faire un lieu sûr où partager ses opinions sur des sujets qui nous rassemblent. <br> le forum et son contenu (sujets, réponses, ...) sont soumis à des règles strictes se basant sur le respect d’autrui. toute forme de discrimination est interdite, punie par la loi et ne sera pas tolérée.</p>
    </div>

    <div id="joinOrContact">
        <p>passez le cap</p>
        <div id="joinOrContactCase">
            <h5><span class="big" id="join">rejoignez</span> <br>les <span id="joinAlliegators">ALLIEGATORS</span></h5>
            <button><a href="index.php?action=loginPage">inscrivez-vous ici</a></button>
            <p>ou si vous avez besoin de plus <br> amples renseignements</p>
            <button><a href="index.php?action=contact">contactez-moi</a></button>
        </div>
    </div>
</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>