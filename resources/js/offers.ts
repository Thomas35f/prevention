let flickityInstance: any = null;
declare var Flickity: any;

function initializeCarousel() {
    const mq = window.matchMedia("(max-width: 1025px)");

    if (mq.matches) {
        const carouselElement = document.querySelector('.carousel') as HTMLElement;
        const carousel = new Flickity(carouselElement, {
            prevNextButtons: false,
            pageDots: false,
            initialIndex: 1
        });

        const galleryNav = document.querySelector('.gallery-nav') as HTMLElement;
        const galleryNavItems = galleryNav.querySelectorAll('button');

        carouselElement.addEventListener('select.flickity', function() {
            const selectedItem = galleryNav.querySelector('.is-selected');
            if (selectedItem) {
                selectedItem.classList.remove('is-selected');
            }
            galleryNavItems[carousel.selectedIndex].classList.add('is-selected');
        });

        galleryNav.addEventListener('click', function(event) {
            const targetElement = event.target as HTMLElement;
            if (targetElement && targetElement.nodeName === 'BUTTON') {
                const index = Array.from(galleryNavItems).indexOf(targetElement as HTMLButtonElement);
                carousel.select(index);
            }
        });

        flickityInstance = carousel;
    } else {
        if (flickityInstance) {
            flickityInstance.destroy();
            flickityInstance = null;
        }
    }
}

function updateDivClass() {
    const threshold = 1025;

    const mappings = [
        {id: 'box-under-title', smallClass: 'carousel', largeClass: 'box-under-title'},
        {id: 'column-first-offer', smallClass: 'carousel-cell', largeClass: 'column-first-offer'},
        {id: 'column-second-offer', smallClass: 'carousel-cell', largeClass: 'column-second-offer'},
        {id: 'column-third-offer', smallClass: 'carousel-cell', largeClass: 'column-third-offer'}
    ];

    mappings.forEach(mapping => {
        const element = document.getElementById(mapping.id);
        if (element) {
            if (window.innerWidth < threshold) {
                element.classList.add(mapping.smallClass);
                element.classList.remove(mapping.largeClass);
            } else {
                element.classList.add(mapping.largeClass);
                element.classList.remove(mapping.smallClass);
            }
        }
    });
}

window.addEventListener("load", function () {
    updateDivClass();
    initializeCarousel();
});

window.addEventListener("resize", function () {
    updateDivClass();
    initializeCarousel();
});

export {};
