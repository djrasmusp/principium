import SVGInject from "@iconfu/svg-inject";
export function wpMu(){
    SVGInject(document.querySelectorAll("img.injectable"));

    document.querySelector('.skip-link').addEventListener('click', () => {
        document.getElementById("main-content").tabIndex = -1;
    })

    document.addEventListener("keydown", (event) => {
        if (event.isComposing || event.keyCode === 48 || event.keyCode === 96) {
            document.querySelector("body").classList.toggle("show-admin-bar");
        }
    });

    
}