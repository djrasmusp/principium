export function  componentMenus() {
    Alpine.data("menusState", () => ({
        show_artist_menu: false,
        show_mobile_menu: false,
        show_artist_mobile: false,

        artist_menu_trigger: {
            ["@click.prevent"]() {
                this.show_artist_menu = !this.show_artist_menu;
            },
            ["@keydown.escape"]() {
                this.show_artist_menu = false;
            },
        },

        artist_menu: {
            ["x-show"]() {
                return this.show_artist_menu;
            },
            ["x-trap.noscroll"]() {
                return this.show_artist_menu;
            },
            ["@keydown.escape"]() {
                this.show_artist_menu = false;
            },
        },

        mobile_menu_trigger: {
            ["@click.prevent"]() {
                this.show_mobile_menu = !this.show_mobile_menu;
            },
            ["@keydown.escape"]() {
                this.show_mobile_menu = false;
            },
        },

        mobile_menu: {
            ["x-show"]() {
                return this.show_mobile_menu;
            },
            ["x-trap.noscroll"]() {
                return this.show_mobile_menu;
            },
            ["@keydown.escape"]() {
                this.show_mobile_menu = false;
            },
        },

        mobile_artist_trigger: {
            ["@click.prevent"]() {
                this.show_artist_mobile = !this.show_artist_mobile;
            },
        },

        mobile_artist_menu: {
            ["x-show"]() {
                return this.show_artist_mobile;
            },
            ["x-collapse"]() {
                return this.show_artist_mobile;
            },
            ["x-collapse.duration.1000ms"]() {
                return this.show_artist_mobile;
            },
        },

        footer_index: {
            [":class"]() {
                return (this.show_artist_menu) ? 'z-20' : 'z-30'
            }
        }
    }))
}