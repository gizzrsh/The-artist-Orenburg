const burger = document.querySelector('.burger');
const menu = document.querySelector('.header__menu');

if (burger && menu) {
    burger.addEventListener('click', () => {
        menu.classList.toggle('active');
        document.body.classList.toggle('lock');
    });
}