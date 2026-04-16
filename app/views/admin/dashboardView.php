<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="dashboardAdmin">

    <h2>bienvenue, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h2>
    <div class="underLine">&nbsp</div> 
    
    <nav id="dashboardMenu">
        <ul>
            <a href="index.php?action=createArticle"><img src="<?php echo BASE_URL; ?>/app/public/images/img_write_articles.webp" alt="admin_write"><li>créer un article</li></a>
            <a href="index.php?action=manageArticles"><img src="<?php echo BASE_URL; ?>/app/public/images/img_manage_articles.webp" alt="admin_manage_article"><li>gérer les articles</li></a>
            <a href="index.php?action=manageUsers"><img src="<?php echo BASE_URL; ?>/app/public/images/img_manage_users.webp" alt="admin_manage_user"><li>gérer les membres</li></a>
        </ul>
    </nav>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>