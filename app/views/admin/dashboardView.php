<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="dashboardAdmin">

    <h2>bienvenue, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h2>
    <div class="underLine">&nbsp</div> 
    
    <nav id="dashboardMenu">
        <ul>
            <a href="index.php?action=createArticle"><li>créer un article</li></a>
            <a href="index.php?action=manageArticles"><li>gérer les articles</li></a>
            <a href="index.php?action=manageUsers"><li>gérer les membres</li></a>
        </ul>
    </nav>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>