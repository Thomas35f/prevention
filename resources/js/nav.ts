document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.getElementById('burger-menu');
    const overlay = document.getElementById('menu');

    if (burgerMenu && overlay) {
        burgerMenu.addEventListener('click', function() {
            burgerMenu.classList.toggle("close");
            overlay.classList.toggle("overlay");
        });
    }
});

export {}
