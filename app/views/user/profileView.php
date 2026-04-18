<?php require RACINE . '/app/views/layouts/header.php'; ?>

<div id="profileBlock">

    <div id="profileHeader">
        <?php if (!empty($profile['avatar'])): ?>
            <img src="<?php echo htmlspecialchars($profile['avatar']); ?>" alt="avatar">
        <?php else: ?>
            <div id="defaultAvatar"><?php echo strtoupper(substr($profile['username'], 0, 1)); ?></div>
        <?php endif; ?>

        <div id="profileInfo">
            <h1><?php echo htmlspecialchars($profile['username']); ?></h1>
            <p><?php echo htmlspecialchars($profile['profile_description'] ?? 'aucune description.'); ?></p>
        </div>
    </div>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_user'] == $profile['id_user']): ?>
        <section id="editProfileForm">
            <h2>modifier mon profil</h2>

            <form method="POST" action="index.php?action=submitProfile" enctype="multipart/form-data">

                <label>avatar</label>
                <input type="file" name="avatar" accept="image/*">
                <p>Attention : le poids de votre image ne doit pas dépasser les 2MB.</p>

                <label>description</label>
                <textarea name="profile_description" placeholder="parlez de vous."><?php echo htmlspecialchars($profile['profile_description'] ?? ''); ?></textarea>

                <button type="submit">sauvegarder</button>
            </form>
        </section>
    <?php endif; ?>

</div>

<?php require RACINE . '/app/views/layouts/footer.php'; ?>