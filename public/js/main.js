const burgerBtn = document.getElementById('burgerBtn');
const menuHeader = document.getElementById('menuHeader');

if (burgerBtn && menuHeader) {
    burgerBtn.addEventListener('click', function() {
        burgerBtn.classList.toggle('open');
        menuHeader.classList.toggle('open');
    });

    // ferme le menu quand on clique sur un lien
    const menuLinks = menuHeader.querySelectorAll('a');
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            burgerBtn.classList.remove('open');
            menuHeader.classList.remove('open');
        });
    });
}

const light = document.querySelector('.spotlight');

document.addEventListener('mousemove', e => {
  light.style.left = e.clientX + 'px';
  light.style.top = e.clientY + 'px';
  light.style.opacity = '1';
});

document.addEventListener('mouseleave', () => light.style.opacity = '0');

document.addEventListener('DOMContentLoaded', function () {

  const btn = document.getElementById('makeupBtn');
  const popup = document.getElementById('makeupPopup');
  const close = document.getElementById('makeupClose');
  const loading = document.getElementById('makeupLoading');
  const product = document.getElementById('makeupProduct');

  let loaded = false;

  // Ouvre/ferme le popup
  btn.addEventListener('click', function () {
    popup.classList.toggle('hidden');
    if (!loaded) {
      fetchProduct();
    }
  });

  close.addEventListener('click', function () {
    popup.classList.add('hidden');
  });

  // Ferme en cliquant dehors
  document.addEventListener('click', function (e) {
    if (!popup.contains(e.target) && e.target !== btn) {
      popup.classList.add('hidden');
    }
  });

  function fetchProduct() {
    // Seed basé sur la date du jour → même produit toute la journée
    const today = new Date();
    const seed = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();

    fetch('https://makeup-api.herokuapp.com/api/v1/products.json')
      .then(function (response) { return response.json(); })
      .then(function (data) {
        // Choisit un produit selon le seed du jour
        const index = seed % data.length;
        const item = data[index];

        document.getElementById('makeupBrand').textContent = item.brand ? item.brand.toUpperCase() : '';
        document.getElementById('makeupName').textContent = item.name || '';
        document.getElementById('makeupType').textContent = item.product_type || '';
        document.getElementById('makeupPrice').textContent = item.price ? item.price + ' $' : 'prix non disponible';
        document.getElementById('makeupLink').href = item.website_link || item.product_link || '#';

        const img = document.getElementById('makeupImg');
        if (item.image_link) {
          img.src = item.image_link;
          img.style.display = 'block';
        } else {
          img.style.display = 'none';
        }

        loading.classList.add('hidden');
        product.classList.remove('hidden');
        loaded = true;
      })
      .catch(function () {
        loading.textContent = 'impossible de charger le produit.';
      });
  }
});