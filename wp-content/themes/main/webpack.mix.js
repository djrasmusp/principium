const mix = require("laravel-mix");
const path = require('path')
mix.setPublicPath("assets");

mix
    .js(["__dev/js/main.js"], "js")
    .js(["__dev/js/admin.js"], "js")

    .sass("__dev/css/style.scss", "css")
    .sass("__dev/css/admin.scss", "css")
    .sass("__dev/css/blocks.scss", "css")
    .sass("__dev/css/_editor.scss", "css")
    .sass("__dev/css/login.scss", "css")

    .alias({
        'blocks' : path.join(__dirname, '__dev/js/blocks'),
        'components' : path.join(__dirname, '__dev/js/components'),
        'config' : path.join(__dirname, '__dev/js/config'),
        'utils': path.join(__dirname, '__dev/js/utils')
    })

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
        host: "192.168.1.163",
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
    })
