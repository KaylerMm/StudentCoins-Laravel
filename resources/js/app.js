import './bootstrap';

const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.site-nav ul');

navToggle.addEventListener('click', () => {
  navMenu.classList.toggle('active');
});
