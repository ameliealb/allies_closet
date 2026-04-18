<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="auth-container">

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <section id="form-login">
        <h2>connectez-vous</h2>
        <div class="underLine"></div>
        <form method="POST" action="index.php?action=login">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">se connecter</button>
        </form>
    </section>

    <section id="form-register">
        <h2>inscrivez-vous</h2>
        <div class="underLine"></div>
        <form method="POST" action="index.php?action=register">
            <input type="text" name="name" placeholder="Nom" required>
            <input type="text" name="surname" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Pseudonyme" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <div id="checkboxGroup">
                <input type="checkbox" id="acceptTerms" name="acceptTerms" required>
                <label for="acceptTerms">
                    j'accepte les
                    <a href="index.php?action=privacy" target="_blank">politiques de confidentialité</a>
                    et les
                    <a href="index.php?action=rules" target="_blank">règles du forum</a>
                </label>
            </div>
            <button type="submit">s'inscrire</button>
        </form>
    </section>

</div>

<div id="quoteCoco">
    <p>" garde tes talons, <br> ta tête et <br> tes standards <span id="italicBold">HAUTS</span> "</p>
    <div id="quoteAuthor">
        <div class="underLineAuthor"></div>
        <h4>Coco CHANEL</h4>
    </div>
</div>
<?php require RACINE . '/app/views/layouts/footer.php'; ?>