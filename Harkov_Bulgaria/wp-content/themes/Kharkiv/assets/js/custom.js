/*BURGER MENU*/

const burgerWrapper = document.querySelector('.burger-wrapper')
const headerMenu = document.querySelector('#headerMenu')
const menuLinks = document.querySelectorAll('.header-menu__link')

if (burgerWrapper) {
  burgerWrapper.addEventListener('click', () => {
    burgerWrapper.classList.toggle('active');
    headerMenu.classList.toggle('active');
  })
}

if (menuLinks) {
  menuLinks.forEach((item) => {
    item.addEventListener('click', () => {
      burgerWrapper.classList.remove('active');
      headerMenu.classList.remove('active');
    })
  })
}