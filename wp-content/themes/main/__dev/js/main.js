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
import {blockVideo} from "blocks/block.video";

document.addEventListener("DOMContentLoaded", function () {
    AOS.init();
    SVGInject(document.querySelectorAll("img.injectable"));

    scrollToContent();
    wpMu();

    window.Alpine = Alpine;

    Alpine.plugin(persist)
    Alpine.plugin(focus);
    Alpine.plugin(collapse);

    componentCarousels()
    componentSpotify()
    blockVideo()

    Alpine.start()
});