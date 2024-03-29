const { postCss } = require('laravel-mix');
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


mix.js(['resources/js/app.js', 'resources/js/functions/index.js'], 'public/js')
    .postCss('resources/styles/index.css', 'public/styles')
    .react();
