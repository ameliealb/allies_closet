<?php require RACINE . '/app/views/layouts/header.php'; ?>

<main id="aboutPage">

    <!-- Hero -->
    <section class="about-hero">
        <div class="about-hero__bg"></div>
        <div class="about-hero__content">
            <span class="about-hero__eyebrow">à propos</span>
            <h1 class="about-hero__title">je suis <em>Allie</em>,<br>et voici mon dressing.</h1>
        </div>
    </section>

    <!-- Intro -->
    <section class="about-intro">
        <div class="about-intro__number">01</div>
        <div class="about-intro__text">
            <h2 class="about-intro__title">qui je suis</h2>
            <p>Bienvenue sur <strong>Allie's Closet</strong> — un espace pensé pour celles qui refusent de choisir entre le fond et la forme. Ici, la mode est un langage, une armure, une déclaration.</p>
            <p>Je suis Allison, une américaine passionnée de style depuis toujours, convaincue que bien s'habiller n'est pas une question de budget mais d'intention. Ce blog, c'est mon carnet de bord ouvert au monde.</p>
        </div>
    </section>

    <!-- Valeurs -->
    <section class="about-values">
        <div class="about-values__header">
            <div class="about-values__line"></div>
            <h2>mes valeurs</h2>
            <div class="about-values__line"></div>
        </div>
        <div class="about-values__grid">
            <article class="about-values__card">
                <span class="about-values__icon">✦</span>
                <h3>authenticité</h3>
                <p>Pas de filtre, pas de masque. Je partage ce que je porte vraiment, ce que j'aime vraiment.</p>
            </article>
            <article class="about-values__card">
                <span class="about-values__icon">✦</span>
                <h3>accessibilité</h3>
                <p>La mode n'appartient pas qu'aux maisons de luxe. Mon dressing mélange les genres, les prix, les époques.</p>
            </article>
            <article class="about-values__card">
                <span class="about-values__icon">✦</span>
                <h3>singularité</h3>
                <p>S'inspirer des tendances sans les suivre aveuglément. Construire son style, c'est construire son identité.</p>
            </article>
        </div>
    </section>

    <!-- Citation -->
    <section class="about-quote">
        <blockquote>
            <span class="about-quote__mark">"</span>
            le style, c'est une façon de dire qui tu es sans avoir à parler.
            <cite>— Rachel Zoe</cite>
        </blockquote>
    </section>

    <!-- CTA -->
    <section class="about-cta">
        <p>envie d'en savoir plus ou de collaborer ?</p>
        <a href="index.php?action=contact" class="btn-gold">me contacter</a>
    </section>

</main>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>