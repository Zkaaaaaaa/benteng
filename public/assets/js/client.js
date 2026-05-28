document.addEventListener('DOMContentLoaded', function () {
    var navbar = document.querySelector('.navbar');
    var toggle = document.getElementById('navToggle');
    var menu = document.getElementById('navMenu');

    if (navbar) {
        var onScroll = function () {
            navbar.classList.toggle('is-scrolled', window.scrollY > 48);
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            menu.classList.toggle('open');
            toggle.classList.toggle('is-active');
        });

        menu.querySelectorAll('a[href^="#"]').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('open');
                toggle.classList.remove('is-active');
            });
        });
    }
});
