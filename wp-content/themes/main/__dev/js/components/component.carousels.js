import Splide from '@splidejs/splide';
import {Intersection} from '@splidejs/splide-extension-intersection';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

export function componentCarousels() {
    const carousels = document.getElementsByClassName('splide'),
        isWpAdmin = document.querySelector('body.wp-admin') ? true : false;

    Splide.defaults = {
        type: 'loop',
        perPage: 4,
        drag: 'free',
        arrows: true,
        pagination: false,
        slideFocus: false,
        focusableNodes: 'a',
        breakpoints: {
            640: {
                perPage: 2,
            }
        },
        autoScroll : {
            speed: (isWpAdmin) ? 0.0000000000001 : 0.2,
        },
        intersection: {
            inView: {
                autoplay: true,
            },
            outView: {
                autoplay: false,
            }
        },
        reducedMotion: {
            speed: 0,
            rewindSpeed: 0,
            autoplay: 'pause',
        },
    }

    for (let i = 0; i < carousels.length; i++) {
        new Splide(carousels[i], {
            i18n: {
                prev: 'Forrig slide',
                next: 'Næste slide',
            }
        }).mount({ Intersection, AutoScroll });
    }

}