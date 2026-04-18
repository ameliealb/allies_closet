<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ALLIE'S CLOSET</title>
    <link rel="stylesheet" href="/projet-final/app/public/styles/css/style.css">
</head>

<body>
    <div class="spotlight"></div>
    <header>
        <div id="logoAndTitle">
            <img id="logoHeader" src="/projet-final/app/public/images/cropped_logo_gold_st.png" alt="logo doré">
            <h1>Allie's Closet</h1>
        </div>
        <nav id="navHeader">
            <ul id="menuHeader">
                <li><?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <a href="index.php?action=dashboard">dashboard</a>
                    <?php endif; ?>
                </li>
                <li><a href="index.php?action=default">accueil</a></li>
                <li><a href="index.php?action=blog">blog</a></li>
                <li><a href="index.php?action=forum">forum</a></li>
                <li><a href="index.php?action=aPropos">à&nbsp;propos</a></li>
                <li><a href="index.php?action=contact">contact</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="index.php?action=showProfile&id=<?php echo $_SESSION['user']['id_user']; ?>">mon&nbsp;compte</a></li>
                <?php endif; ?>
            </ul>
            <?php if (isset($_SESSION['user'])): ?>
                <button><a href="index.php?action=logout">déconnexion</a></button>
            <?php else: ?>
                <button><a href="index.php?action=loginPage">connexion</a></button>
            <?php endif; ?>
        </nav>
    </header>