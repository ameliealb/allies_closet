const burgerBtn = document.getElementById('burgerBtn');
const menuHeader = document.getElementById('menuHeader');

if (burgerBtn && menuHeader) { //checks if existing 
    burgerBtn.addEventListener('click', function() {
        burgerBtn.classList.toggle('open'); //adds or removes'open' class, starts CSS animation
        menuHeader.classList.toggle('open'); //same 
    });

    // closes menu when clicks on a link
    const menuLinks = menuHeader.querySelectorAll('a');
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            burgerBtn.classList.remove('open'); //removes 'open' class when clicks
            menuHeader.classList.remove('open');
        });
    });
}

//a golden halo follows the mouse movements through the screen, with coordinates given by the mousemove 
const light = document.querySelector('.spotlight');

document.addEventListener('mousemove', e => {
  light.style.left = e.clientX + 'px';
  light.style.top = e.clientY + 'px';
  light.style.opacity = '1';
});

document.addEventListener('mouseleave', () => light.style.opacity = '0'); //when mouse leaves screen, spotlight disapears 

document.addEventListener('DOMContentLoaded', function () { //for the makeup button, gets all the elements needed 

  const btn = document.getElementById('makeupBtn');
  const popup = document.getElementById('makeupPopup');
  const close = document.getElementById('makeupClose');
  const loading = document.getElementById('makeupLoading');
  const product = document.getElementById('makeupProduct');

  if (!btn) return; //if there is no makeup button on the page, do nothing

  let loaded = false;

  // open/close popup
  btn.addEventListener('click', function () {
    popup.classList.toggle('hidden');
    if (!loaded) {
      fetchProduct();
    }
  });

   // either close when clicks outside or when clicks on the cross
  close.addEventListener('click', function () {
    popup.classList.add('hidden');
  });

  document.addEventListener('click', function (e) {
    if (!popup.contains(e.target) && e.target !== btn) {
      popup.classList.add('hidden');
    }
  });

  function fetchProduct() {
    // Seed based on the daytime -> same product the whole day
    const today = new Date();
    const seed = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate(); //generates a specific number according the current date

    fetch('https://makeup-api.herokuapp.com/api/v1/products.json')
      .then(function (response) { return response.json(); })
      .then(function (data) {
        // gets a product according the day, from all the products
        const index = seed % data.length; //uses modulo, seed divided by the data's lenght (around 930)
        const item = data[index]; 

        //fills the popup with product's data
        // || allows to get a default value if the field is empty in the API
        document.getElementById('makeupBrand').textContent = item.brand ? item.brand.toUpperCase() : '';
        document.getElementById('makeupName').textContent = item.name || '';
        document.getElementById('makeupType').textContent = item.product_type || '';
        document.getElementById('makeupPrice').textContent = item.price ? item.price + ' $' : 'prix non disponible';
        document.getElementById('makeupLink').href = item.website_link || item.product_link || '#';

        const img = document.getElementById('makeupImg'); //if there's an image, displays it ; if not, hides it
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
        loading.textContent = 'impossible de charger le produit.'; //displays an error message if API not avilable, no co, anything
      });
  }
});