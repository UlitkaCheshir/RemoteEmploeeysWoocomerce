const modal = document.querySelector('.modal');
const closeButtons = document.querySelectorAll('.close-modal');
const openModalButton = document.querySelector('.open-modal');
// set open modal behaviour

if (modal && openModalButton) {
  openModalButton.addEventListener('click', function () {
    modal.classList.toggle('modal-open');
  });
  document.querySelector('#menuButton').addEventListener('click', function () {
    modal.classList.toggle('modal-open');
  });

// set close modal behaviour
  for (i = 0; i < closeButtons.length; ++i) {
    closeButtons[i].addEventListener('click', function () {
      modal.classList.toggle('modal-open');
    });
  }

// close modal if clicked outside content area
  document.querySelector('.modal-inner').addEventListener('click', function () {
    modal.classList.toggle('modal-open');
  });
// prevent modal inner from closing parent when clicked
  document.querySelector('.modal-content').addEventListener('click', function (e) {
    e.stopPropagation();
  });
  /*MODAL*/
  const menuButton = document.querySelector('#menuButton')
  const phoneButton = document.querySelector('#phoneButton')
  const phoneBlock = document.querySelector('.modal-phone')

  if (phoneButton) {
    phoneButton.addEventListener('click', () => {
      phoneBlock.style.display = 'block'
    });
    menuButton.addEventListener('click', () => {
      phoneBlock.style.display = 'block'
    });
  }
}

/*BURGER MENU*/

const burgerWrapper = document.querySelector('.burger-wrapper')
const topMenu = document.querySelector('.menu-top')
const menuLinks = document.querySelectorAll('.menu-top-link')

if (burgerWrapper) {
  burgerWrapper.addEventListener('click', () => {
    burgerWrapper.classList.toggle('active');
    topMenu.classList.toggle('active');
  })
}
if (menuLinks) {
  menuLinks.forEach((item) => {
    item.addEventListener('click', () => {
      burgerWrapper.classList.remove('active');
      topMenu.classList.remove('active');
    })
  })
}

/*TABS*/
const tabLinks = document.querySelectorAll('.resume-tabs__links li');
const tabContent = document.querySelectorAll('.resume-tabs__content li');

if (tabLinks && tabContent) {
  for (let i = 0; i < tabLinks.length; i++) {
    (function (i) {
      let link = tabLinks[i];
      link.onclick = function () {
        for (let j = 0; j < tabContent.length; j++) {
          let tabContentOpacity = window.getComputedStyle(tabContent[j]).display;
          if (tabContentOpacity == 'block') {
            tabContent[j].style.display = 'none'
          }
        }
        tabContent[i].style.display = 'block';
      }
    })(i);
  }
}