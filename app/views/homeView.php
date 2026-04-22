<?php require RACINE . '/app/views/layouts/header.php'; ?>

<main id="homeMain">

    <section id="firstBlock">
        <div id="firstBlockPart1">
            <div id="subBlock1">
                <div class="underLineSmall"></div>
                <h2>le style, l'<span class="italicBold">attitude</span> : bienvenue sur mon blog</h2>
            </div>
            <h6>L'ART DE <span class="italicBig">VIVRE</span> <br>et de s'habiller <br>à contre-courant <br>des <span class="bold big">NORMES.</span></h6>
            <button id="discoverButton"><a href="index.php?action=blog">découvrir le blog</a></button>
            <button id="contactButton"><a href="index.php?action=forum">aller sur le forum</a></button>
        </div>

        <div id="firstBlockPart2">
            <?php if (!empty($lastArticle)): ?>
                <a href="index.php?action=showArticle&id=<?php echo $lastArticle['id_article']; ?>">
                    <article id="lastArticle">
                        <?php if (!empty($lastArticle['article_image'])): ?>
                            <img src="<?php echo htmlspecialchars($lastArticle['article_image']); ?>" alt="<?php echo htmlspecialchars($lastArticle['title']); ?>">
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>/public/images/main_home_pic.webp" alt="article de la semaine">
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($lastArticle['title']); ?></h3>
                    </article>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <div class="soloLine"></div>

    <div class="ribbon">
        <div class="ribbon-track">
            <span>mode</span><span class="star">★</span>
            <span>prestige</span><span class="star">★</span>
            <span>intemporel</span><span class="star">★</span>
            <span>haute couture</span><span class="star">★</span>
            <span>renouveau</span><span class="star">★</span>
            <span>tendances</span><span class="star">★</span>
            <span>avant-gardisme</span><span class="star">★</span>

            <span>mode</span><span class="star">★</span>
            <span>prestige</span><span class="star">★</span>
            <span>intemporel</span><span class="star">★</span>
            <span>haute couture</span><span class="star">★</span>
            <span>renouveau</span><span class="star">★</span>
            <span>tendances</span><span class="star">★</span>
            <span>avant-gardisme</span><span class="star">★</span>

            <span>mode</span><span class="star">★</span>
            <span>prestige</span><span class="star">★</span>
            <span>intemporel</span><span class="star">★</span>
            <span>haute couture</span><span class="star">★</span>
            <span>renouveau</span><span class="star">★</span>
            <span>tendances</span><span class="star">★</span>
            <span>avant-gardisme</span><span class="star">★</span>

            <span>mode</span><span class="star">★</span>
            <span>prestige</span><span class="star">★</span>
            <span>intemporel</span><span class="star">★</span>
            <span>haute couture</span><span class="star">★</span>
            <span>renouveau</span><span class="star">★</span>
            <span>tendances</span><span class="star">★</span>
            <span>avant-gardisme</span><span class="star">★</span>
        </div>
    </div>

    <section id="secondBlock">
        <div id="firstArticleColumn">
            <?php if (!empty($latestArticles[1])): ?>
                <a href="index.php?action=showArticle&id=<?php echo $latestArticles[1]['id_article']; ?>">
                    <article id="firstArticle">
                        <?php if (!empty($latestArticles[0]['article_image'])): ?>
                            <img src="<?php echo htmlspecialchars($latestArticles[1]['article_image']); ?>" alt="<?php echo htmlspecialchars($latestArticles[1]['title']); ?>">
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>/public/images/img_article_body_dictats.webp" alt="article">
                        <?php endif; ?>
                        <h4><?php echo htmlspecialchars($latestArticles[1]['title']); ?></h4>
                    </article>
                </a>
            <?php endif; ?>
            <?php if (!empty($latestArticles[4])): ?>
                <a href="index.php?action=showArticle&id=<?php echo $latestArticles[4]['id_article']; ?>">
                    <article id="fourthArticle">
                        <img src="<?php echo htmlspecialchars($latestArticles[4]['article_image']); ?>" alt="">
                        <h4><?php echo htmlspecialchars($latestArticles[4]['title']); ?></h4>
                    </article>
                </a>
            <?php endif; ?>
        </div>

        <div id="secondArticleColumn">
            <?php if (!empty($latestArticles[2])): ?>
                <a href="index.php?action=showArticle&id=<?php echo $latestArticles[2]['id_article']; ?>">
                    <article id="secondArticle">
                        <?php if (!empty($latestArticles[1]['article_image'])): ?>
                            <img src="<?php echo htmlspecialchars($latestArticles[2]['article_image']); ?>" alt="<?php echo htmlspecialchars($latestArticles[2]['title']); ?>">
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>/public/images/img_article_cars.webp" alt="article">
                        <?php endif; ?>
                        <h4><?php echo htmlspecialchars($latestArticles[2]['title']); ?></h4>
                    </article>
                </a>
            <?php endif; ?>

            <?php if (!empty($latestArticles[3])): ?>
                <a href="index.php?action=showArticle&id=<?php echo $latestArticles[3]['id_article']; ?>">
                    <article id="thirdArticle">
                        <?php if (!empty($latestArticles[3]['article_image'])): ?>
                            <img src="<?php echo htmlspecialchars($latestArticles[3]['article_image']); ?>" alt="<?php echo htmlspecialchars($latestArticles[3]['title']); ?>">
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>/public/images/img_article_other1.webp" alt="article">
                        <?php endif; ?>
                        <h4><?php echo htmlspecialchars($latestArticles[3]['title']); ?></h4>
                    </article>
                </a>
            <?php endif; ?>

            <p>voir les</p>
            <h5>derniers articles publiés</h5>
        </div>
    </section>

    <section id="communityBlock">
        <div id="communityLabelRow">
            <div class="underLineSmall"></div>
            <p id="communityLabel">notre communauté</p>
        </div>
        <div id="communityContent">
            <h2>rejoignez <br> les <span>ALLIEGATORS</span></h2>
            <p>découvrez les avant-premières <br> et ne ratez aucune actualité.</p>
            <a href="index.php?action=loginPage"><button id="subscribeButton">inscrivez-vous</button></a>
        </div>
    </section>

    <div id="makeupWidget">
        <button id="makeupBtn" title="produit du jour">💄</button>
    </div>

    <div id="makeupPopup" class="hidden">
        <button id="makeupClose">✕</button>
        <p id="makeupLabel">produit du jour</p>
        <div id="makeupContent">
            <div id="makeupLoading">chargement...</div>
            <div id="makeupProduct" class="hidden">
                <img id="makeupImg" src="" alt="">
                <div id="makeupInfo">
                    <p id="makeupBrand"></p>
                    <h3 id="makeupName"></h3>
                    <p id="makeupType"></p>
                    <p id="makeupPrice"></p>
                    <a id="makeupLink" href="#" target="_blank" rel="noopener noreferrer">voir le produit →</a>
                </div>
            </div>
        </div>
    </div>

</main>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>