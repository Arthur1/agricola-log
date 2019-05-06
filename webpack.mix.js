const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/materialize.js', 'public/assets/js')
    .js('resources/js/template.js', 'public/assets/js')
    .js('resources/js/index.js', 'public/assets/js')
    .js('resources/js/edit_step1.js', 'public/assets/js')
    .js('resources/js/edit_step2.js', 'public/assets/js')
    .js('resources/js/games_view.js', 'public/assets/js')
    .js('resources/js/games_tweet.js', 'public/assets/js')
    .sass('resources/sass/app.scss', 'public/assets/css')
    .sass('resources/sass/app_async.scss', 'public/assets/css');
