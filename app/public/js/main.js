const light = document.querySelector('.spotlight');

document.addEventListener('mousemove', e => {
  light.style.left = e.clientX + 'px';
  light.style.top  = e.clientY + 'px';
  light.style.opacity = '1';
});

document.addEventListener('mouseleave', () => light.style.opacity = '0');