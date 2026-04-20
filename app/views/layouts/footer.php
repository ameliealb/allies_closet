<footer class="footer">
    <div class="footerContainer">

        <!-- first column : logo + catchy phrase + socials -->
        <div id="footerFirstColumn">
            <div id="footerLogo">
                <img class="logoHeaderFooter" src="<?php echo BASE_URL; ?>/public/images/cropped_logo_gold_st.png" alt="logo doré">
                <span id="footerWebsiteName">Allie's Closet</span>
            </div>
            <p id="footerCatchyPhrase">
                le blog de mode pensé et conçu<br>
                pour révéler la Bratz qui sommeille en soi
            </p>
            <div id="footerSocials">
                <a href="#">ig</a>
                <a href="#">fb</a>
                <a href="#">yt</a>
                <a href="#">pi</a>
            </div>
        </div>

        <!-- second column : footer menu -->
        <nav id="footerSecondColumn">
            <h3 class="footerSecondaryTitle">menu</h3>
            <div class="underLine">&nbsp</div>
            <ul id="footerNav">
                <li><a href="index.php?action=default">accueil</a></li>
                <li><a href="index.php?action=blog">blog</a></li>
                <li><a href="index.php?action=forum">forum</a></li>
                <li><a href="index.php?action=aPropos">à propos</a></li>
                <li><a href="index.php?action=contact">contact</a></li>
                <li><a href="index.php?action=loginPage">connexion / inscription</a></li>
            </ul>
        </nav>

        <!-- third column : footer subjects -->
        <nav id="footerThirdColumn">
            <h3 class="footerSecondaryTitle">catégories</h3>
            <div class="underLine">&nbsp</div>
            <ul id="footerSubjectsList">
                <li><a href="index.php?action=default">mode</a></li>
                <li><a href="index.php?action=default">maquillage</a></li>
                <li><a href="index.php?action=default">chaussures</a></li>
                <li><a href="index.php?action=default">cheveux</a></li>
                <li><a href="index.php?action=default">skincare</a></li>
                <li><a href="index.php?action=default">lifestyle</a></li>
            </ul>
        </nav>

        <!-- fourth column : policies stuff -->
        <nav id="footerFourthColumn">
            <h3 class="footerSecondaryTitle">légal</h3>
            <div class="underLine">&nbsp</div>
            <ul class="footerPoliciesList">
                <li><a href="index.php?action=legal">mentions légales</a></li>
                <li><a href="index.php?action=privacy">politique de confidentialité</a></li>
                <li><a href="index.php?action=rules" target="_blank">règles du forum</a></li>
            </ul>
        </nav>

    </div>

    <div id="footerCopyrights">
        <p class="footerCopyrightsText">&copy; <?= date('Y') ?> <span id="creditWebsiteTitle">Allie's Closet</span> — tous droits réservés</p>
    </div>
</footer>
<script src="<?php echo BASE_URL; ?>/public/js/main.js" defer></script>
</body>

</html>