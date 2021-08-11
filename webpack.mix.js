const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/boot.js", "public/js")
    .js('resources/js/app.js', 'public/js')
    .js("resources/js/posts.js","public/js")
    .js("resources/js/sendrequest.js","public/js")
    .js("resources/js/login.js","public/js")
    .js("resources/js/navbar.js", "public/js")
    .js("resources/js/notifications.js", "public/js")
    .js("resources/js/friends.js", "public/js")
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ])
    .postCss("resources/css/login.css", "public/css")
    .version();
