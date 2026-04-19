<?php require RACINE . '/app/views/layouts/header.php'; ?>
<main id="contactPage">

  <!-- Header avec vidéo de fond -->
  <section class="contact-hero">
    <video class="contact-hero__video" autoplay muted loop playsinline>
      <source src="<?= BASE_URL ?>/app/public/images/contact_video.mp4" type="video/mp4">
    </video>
    <div class="contact-hero__overlay"></div>
    <div class="contact-hero__content">
      <span class="contact-hero__eyebrow">contact</span>
      <h1 class="contact-hero__title">parlons <em>style</em>.</h1>
      <p class="contact-hero__sub">une question, une collab, un simple bonjour — je lis tout.</p>
    </div>
  </section>

  <div class="contact-wrapper">
    <!-- Formulaire -->
    <section class="contact-form-section">
      <h2 class="contact-form-section__title">m'écrire</h2>
      <form action="index.php?action=sendContact" method="POST" class="contact-form">
        <div class="contact-form__row">
          <div class="contact-form__group">
            <label for="name">nom</label>
            <input type="text" id="name" name="name" placeholder="votre prénom" required />
          </div>
          <div class="contact-form__group">
            <label for="email">email</label>
            <input type="email" id="email" name="email" placeholder="votre@email.com" required />
          </div>
        </div>
        <div class="contact-form__group">
          <label for="subject">sujet</label>
          <input type="text" id="subject" name="subject" placeholder="collaboration, question, autre..." required />
        </div>
        <div class="contact-form__group">
          <label for="message">message</label>
          <textarea id="message" name="message" rows="6" placeholder="dites-moi tout..." required></textarea>
        </div>
        <button type="submit" class="contact-form__submit">envoyer le message</button>
      </form>
    </section>

    <!-- Réseaux & infos -->
    <aside class="contact-aside">
      <h2 class="contact-aside__title">me retrouver</h2>
      <div class="contact-aside__socials">
        <a href="#" class="contact-social" aria-label="Instagram">
          <span class="contact-social__icon">ig</span>
          <span class="contact-social__label">Instagram</span>
          <span class="contact-social__handle">@alliescloset</span>
        </a>
        <a href="#" class="contact-social" aria-label="Pinterest">
          <span class="contact-social__icon">pi</span>
          <span class="contact-social__label">Pinterest</span>
          <span class="contact-social__handle">alliescloset</span>
        </a>
        <a href="#" class="contact-social" aria-label="YouTube">
          <span class="contact-social__icon">yt</span>
          <span class="contact-social__label">YouTube</span>
          <span class="contact-social__handle">Allie's Closet</span>
        </a>
        <a href="#" class="contact-social" aria-label="Facebook">
          <span class="contact-social__icon">fb</span>
          <span class="contact-social__label">Facebook</span>
          <span class="contact-social__handle">Allie's Closet</span>
        </a>
      </div>
      <div class="contact-aside__note">
        <span class="contact-aside__note-icon">✦</span>
        <p>je réponds généralement sous <strong>48h</strong>. pour les collaborations, merci de préciser ta marque et le type de partenariat souhaité.</p>
      </div>
    </aside>
  </div>

</main>
<?php require RACINE . '/app/views/layouts/footer.php'; ?>