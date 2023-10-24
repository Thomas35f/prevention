import roadImage from '../images/home/road.jpg';
import truckImage from '../images/home/truck.jpg';

document.addEventListener('DOMContentLoaded', () => {
    const images: string[] = [roadImage, truckImage];
    const randomIndex: number = Math.floor(Math.random() * images.length);
    const imageUrl: string = images[randomIndex];
    const img: HTMLImageElement = new Image();
    img.src = imageUrl;

    img.onload = function() {
        const sliderElement = document.querySelector('.slider-height') as HTMLElement;
        sliderElement.style.backgroundImage = `linear-gradient(90deg, rgba(10,27,47,1) 0%, rgba(16,32,52,0.9344070391828606) 33%, rgba(47,62,80,0.46381880388874297) 100%), url(${imageUrl})`;
    };

    img.onerror = function() {
        const sliderElement = document.querySelector('.slider-height') as HTMLElement;
        sliderElement.style.backgroundImage = 'linear-gradient(90deg, rgba(10,27,47,1) 0%, rgba(16,32,52,0.9344070391828606) 33%, rgba(47,62,80,0.46381880388874297) 100%)';
    };

    const computer = document.getElementById('computer') as HTMLImageElement;
    const database = document.getElementById('database') as HTMLImageElement;
    const dashcam = document.getElementById('dashcam') as HTMLImageElement;

    const cat1 = document.getElementById('cat-1') as HTMLElement;
    const cat2 = document.getElementById('cat-2') as HTMLElement;
    const cat3 = document.getElementById('cat-3') as HTMLElement;

    const timeToCoordinateImages: number = 300;

    function switchImagesOrangeWhite(element: HTMLElement, image: HTMLImageElement): void {
        let timeout: ReturnType<typeof setTimeout>;

        element.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                image.src = 'images/home/services/' + image.id + '-w.png';
            }, timeToCoordinateImages);
        });

        element.addEventListener('mouseleave', function() {
            clearTimeout(timeout);
            image.src = 'images/home/services/' + image.id + '.png';
        });
    }

    switchImagesOrangeWhite(cat1, computer);
    switchImagesOrangeWhite(cat2, database);
    switchImagesOrangeWhite(cat3, dashcam);
});
