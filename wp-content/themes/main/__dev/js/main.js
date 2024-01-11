import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist'
import AOS from "aos";
import SVGInject from "@iconfu/svg-inject";

import {wpMu} from "utils/wp-mu";
import {scrollToContent} from "utils/scroll-to-content";

import {componentCarousels} from "components/component.carousels";
import {componentSpotify} from "components/component.spotify";
import {componentLottie} from "components/component.lottie";

import {blockVideo} from "blocks/block.video";
import {componentSplashPage} from "./components/component.splash-page";
import {componentMenus} from "./components/component.menus";

document.addEventListener("DOMContentLoaded", function () {
    AOS.init();
    SVGInject(document.querySelectorAll("img.injectable"));

    scrollToContent();
    wpMu();

    window.Alpine = Alpine;

    Alpine.plugin(persist)
    Alpine.plugin(focus);
    Alpine.plugin(collapse);

    componentMenus()
    componentSplashPage();
    componentLottie();
    componentCarousels()
    componentSpotify()
    blockVideo()

    Alpine.start()
});

window.cookieStorage = {
    getItem(key) {
        let cookies = document.cookie.split(";");
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].split("=");
            if (key === cookie[0].trim()) {
                return decodeURIComponent(cookie[1]);
            }
        }
        return null;
    },
    setItem(key, value) {
        document.cookie = key+' = '+encodeURIComponent(value) + '; max-age=' + 60*60*24*60
    }
}