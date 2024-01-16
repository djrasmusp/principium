export function blockVideo() {
    document.querySelectorAll('.video-block, .video-slider-block').forEach((block) => {
        require("fslightbox");
    })
}