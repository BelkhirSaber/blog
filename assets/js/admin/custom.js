'use strict';

const activePage = document.location.href;
const links = document.querySelectorAll('.sidebar-nav > .sidebar-item');

window.onload = function() {
  links.forEach(link => {
    let href = link.querySelector('a').href;
    if (href === activePage) {
      link.classList.add('active');
    }
  });
}

links.forEach(link => {
  link.addEventListener('click', function() {
    links.forEach(link => link.classList.remove('active'));
    link.classList.add('active');
  });
});

