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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .js('resources/js/functionsJS/confirmDelete.js', 'public/js/functionsJS')
    .js('resources/js/functionsJS/authPasswordFunctions.js', 'public/js/functionsJS')
    .js('resources/js/functionsJS/authPasswordConfirmFunctions.js', 'public/js/functionsJS')
    .js('resources/js/functionsJS/getRandomColor.js', 'public/js/functionsJS')
    .sass('resources/sass/app.scss', 'public/css');
    