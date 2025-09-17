import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default class Cards {
    constructor(app, container) {
        this.app = app;
        this.container = container;
        this.init();
    }

    init() {
        const slider = this.container.querySelector('.cards-swiper');
        if (!slider) return;

        const SwiperClass = this.app.Swiper;

        new SwiperClass(slider, {
            modules: [Navigation, Pagination],
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            spaceBetween: 40,
            slideToClickedSlide: true,
            navigation: {
                nextEl: slider.querySelector('.swiper-button-next'),
                prevEl: slider.querySelector('.swiper-button-prev'),
            },
            pagination: {
                el: slider.querySelector('.swiper-pagination'),
                clickable: true,
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
            },
        });
    }
}