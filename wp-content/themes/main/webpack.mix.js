const mix = require("laravel-mix");
mix.setPublicPath("assets");

mix.js(["__dev/js/main.js"], "js")
    .js(["__dev/js/admin.js"], "js")

    .sass("__dev/css/style.scss", "css")
    .sass("__dev/css/admin.scss", "css")
    .sass("__dev/css/blocks.scss", "css")
    .sass("__dev/css/_editor.scss", "css")
    .sass("__dev/css/login.scss", "css")

    .options({
        processCssUrls: false,
        postCss: [
            require("tailwindcss"),
            require("autoprefixer")(),
            require('cssnano')
        ],
    })
    .copy("__dev/fonts", "assets/fonts")
    .copy("__dev/images", "assets/images")
    .webpackConfig({
        stats: {
            children: true,
        },
    })

    .sourceMaps()
    .version()
    .browserSync({
        proxy: "http://thenight2023.test",
        logLevel: "debug",
        online: true,
        ui: false,
        open: false,
        notify: false,
        files: [
            "__dev/js/**/*",
            "__/dev/css/!**!/!*",
            "functions/!**!/!*",
            "partials/!**!/!*",
            "blocks/!**/!*",
            "*.php",
        ],
    });
