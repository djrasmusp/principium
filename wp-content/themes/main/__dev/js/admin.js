import SVGInject from "@iconfu/svg-inject";
import {componentCarousels} from "./components/component.carousels";

document.addEventListener("DOMContentLoaded", function () {
    SVGInject(document.querySelectorAll("img.injectable"));

    window.acf.addAction('render_block_preview', () => {
        SVGInject(document.querySelectorAll("img.injectable"));
        componentCarousels()
    })
});

