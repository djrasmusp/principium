export function componentSplashPage() {
    Alpine.data('splashPage', function() {
        return {
            show_splash_page: this.$persist(true).using(cookieStorage)
        }
    })
}