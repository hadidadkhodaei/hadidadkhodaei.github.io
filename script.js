const menuLineContainer = document.getElementById('menuLineContainer');
const sideMenu = document.getElementById('sideMenu');
const menuClose = document.getElementById('menuClose');

menuLineContainer.addEventListener('click', () => {
  sideMenu.classList.add('open');
  menuLineContainer.classList.add('hidden');
});

menuClose.addEventListener('click', () => {
  sideMenu.classList.remove('open');
  menuLineContainer.classList.remove('hidden');
});
