import Lottie from "lottie-web";
export function componentLottie() {
    setTimeout(() => {
        let lottie = new Lottie.loadAnimation({
                container: document.querySelector('.splash-page'),
                renderer: "svg",
                loop: false,
                autoplay: true,
                path: site_objects.lottie + 'logo.json',
            }
        )
    }, 750)
}

