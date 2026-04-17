<?php require RACINE . '/app/views/layouts/header.php'; ?>
<div id="errorBlock">
  <p class="errorCode">403</p>
  <h2>accès interdit</h2>
  <div class="underLine"></div>
  <p class="errorMessage">tu n'as pas les droits pour accéder à cette page.</p>
  <a href="index.php"><button>retour à l'accueil</button></a>
</div>
<?php require RACINE . '/app/views/layouts/footer.php'; ?>