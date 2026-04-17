<?php require RACINE . '/app/views/layouts/header.php'; ?>

<main id="homeMain">

    <section id="firstBlock">
        <div id="firstBlockPart1">
            <div id="subBlock1">
                <div class="underLineSmall"></div>
                <h2>le style, l'<span class="italicBold">attitude</span> : bienvenue sur mon blog</h2>
            </div>
            <h6>L'ART DE <span class="italicBig">VIVRE</span> <br>et de s'habiller <br>à contre-courant <br>des <span class="bold big">NORMES.</span> </h6>
            <button id="discoverButton"><a href="index.php?action=blog">découvrir le blog</a></button>
            <button id="contactButton"><a href="index.php?action=forum">aller sur le forum</a></button>
        </div>
        <div id="firstBlockPart2">
            <a href="#">
                <article id="lastArticle">
                    <img src="<?php echo BASE_URL; ?>/app/public/images/main_home_pic.webp" alt="article_semaine">
                    <h3>l'article de la semaine ici</h3>
                </article>
            </a>
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
            <article id="firstArticle">
                <img src="<?php echo BASE_URL; ?>/app/public/images/img_article_body_dictats.webp" alt="article_1_dictats_physique">
                <h4>Se défaire des dictats sur nos corps : mode d'emploi</h4>
            </article>
        </div>
        <div id="secondArticleColumn">
            <article id="secondArticle">
                <img src="<?php echo BASE_URL; ?>/app/public/images/img_article_cars.webp" alt="article_2_voitures">
                <h4>Votre choix de voiture en dit plus sur vous que ce que vous pensiez !</h4>
            </article>
            <article id="thirdArticle">
                <img src="<?php echo BASE_URL; ?>/app/public/images/img_article_other1.webp" alt="article_3_boutiques_luxe">
                <h4>Le modèle bien chapeauté des boutiques de luxe : comment les grandes maisons nous manipulent</h4>
            </article>
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

</main>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>