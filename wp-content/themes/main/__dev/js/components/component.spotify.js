export function componentSpotify() {
    let AUD = new Audio();

    document.querySelectorAll('.spotify-slider-block').forEach((slider) => {
        const buttons = slider.querySelectorAll("[data-audio]")

        buttons.forEach((btn) => {
            btn.addEventListener("click", (el) => {
                const src = el.target.dataset.audio;
                if (AUD.src !== src) AUD.src = src;

                AUD[AUD.paused ? "play" : "pause"]();

                buttons.forEach((element) => {
                    element.parentElement.parentElement.classList.remove("pause");
                    element.ariaLabel = "Play";
                });

                el.target.parentElement.parentElement.classList.toggle("pause", !AUD.paused);

                if (AUD.paused) {
                    flkty.player.play();
                    el.target.ariaLabel = "Play";
                } else {
                    flkty.player.stop();
                    el.target.ariaLabel = "Pause";
                }
            });
        });

        AUD.addEventListener("ended", (el) => {
            let btn_container = document.querySelector("[data-audio='" + el.target.src + "']");

            btn_container.parentElement.parentElement.classList.remove("pause");
            btn_container.ariaLabel = "Play";
            flkty.player.play();
        });
    })
}