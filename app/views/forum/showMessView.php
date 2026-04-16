<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="showMessageBlock">

    <h2><?php echo htmlspecialchars($message['title']); ?></h2>
    <div class="underLine"></div>
    <p>par <a href="index.php?action=showProfile&id=<?php echo $message['id_user']; ?>">
            <?php echo htmlspecialchars($message['username']); ?>
        </a> le <?php echo htmlspecialchars($message['date_of_creation']); ?></p>

    <article id="mainMessage">
        <p><?php echo nl2br(htmlspecialchars($message['content'])); ?></p>
        <div id="likeBlock">
            <span><?php echo $likes; ?> like<?php echo $likes > 1 ? 's' : ''; ?></span>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?action=toggleLikeMessage&id_message=<?php echo $message['id_message']; ?>">
                    <?php echo $hasLiked ? '♥ retirer le like' : '♡ liker'; ?>
                </a>
            <?php endif; ?>
        </div>
    </article>

    <section id="replies">
        <h3>réponses</h3>

        <?php if (empty($replies)): ?>
            <p>aucune réponse pour le moment.</p>
        <?php else: ?>
            <?php foreach ($replies as $reply): ?>
                <article class="replyCard">
                    <p><a href="index.php?action=showProfile&id=<?php echo $reply['id_user']; ?>">
                            <?php echo htmlspecialchars($reply['username']); ?>
                        </a> le <?php echo htmlspecialchars($reply['date_of_creation']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($reply['content'])); ?></p>


                    <?php if (isset($_SESSION['user'])): ?>
                        <details>
                            <summary>répondre à ce message</summary>
                            <form method="POST" action="index.php?action=submitReply">
                                <input type="hidden" name="id_reply" value="<?php echo $reply['id_message']; ?>">
                                <input type="hidden" name="topic_id" value="<?php echo $message['id_message']; ?>">
                                <textarea name="content" placeholder="ta réponse..." required></textarea>
                                <button type="submit">répondre</button>
                            </form>
                        </details>
                    <?php endif; ?>

                    <?php
                    $subReplies = getRepliesByMessageId($reply['id_message']);
                    if (!empty($subReplies)):
                    ?>
                        <div class="subReplies">
                            <?php foreach ($subReplies as $subReply): ?>
                                <article class="subReplyCard">
                                    <p>par <a href="index.php?action=showProfile&id=<?php echo $subReply['id_user']; ?>">
                                            <?php echo htmlspecialchars($subReply['username']); ?>
                                        </a> le <?php echo htmlspecialchars($subReply['date_of_creation']); ?></p>
                                    <p id="subReplyContent"><?php echo nl2br(htmlspecialchars($subReply['content'])); ?></p>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <?php if (isset($_SESSION['user'])): ?>
        <section id="replyForm">
            <h3>répondre au topic</h3>

            <?php if (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?action=submitReply">
                <input type="hidden" name="id_reply" value="<?php echo $message['id_message']; ?>">
                <input type="hidden" name="topic_id" value="<?php echo $message['id_message']; ?>">
                <textarea name="content" placeholder="écrivez votre réponse ici" required></textarea>
                <button type="submit">répondre</button>
            </form>
        </section>
    <?php else: ?>
        <p><a href="index.php?action=loginPage">connecte-toi</a> pour répondre.</p>
    <?php endif; ?>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>