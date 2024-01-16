export function scrollToContent() {
    document.querySelectorAll(".single-artist .scroll-to-content").forEach((btn) => {
        btn.addEventListener("click", (el) => {
            window.scroll({
                top: document.getElementsByClassName("artist-content-block")[0].offsetTop - get_mobile_menu(),
            });
        });
    });

    document.querySelectorAll(".single-post .scroll-to-content").forEach((btn) => {
        btn.addEventListener("click", (el) => {
            window.scroll({
                top: document.getElementsByClassName("article-content-block")[0].offsetTop - get_mobile_menu(),
            });
        });
    });

    document.querySelectorAll(".booking_btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            window.scroll({
                top: document.getElementsByClassName("artist-booking-form-block")[0].offsetTop - get_mobile_menu(),
            });
        });
    });
}

function get_mobile_menu() {
    let mobile_header = document.querySelector(".mobile_header");

    if(!mobile_header){
        return 0;
    }

    if (window.getComputedStyle(mobile_header).display === "none") {
        return 0;
    }

    return mobile_header.offsetHeight;
}