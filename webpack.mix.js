let mix = require('laravel-mix');

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

mix.sass('resources/assets/sass/app.scss', 'public/css')
    .scripts([
        'resources/assets/js/vendors/jquery-1.12.4.min.js',
        'resources/assets/js/vendors/jquery-migrate-1.4.1.min.js',
        'resources/assets/js/vendors/bootstrap.min.js',
        'resources/assets/js/vendors/parallax.min.js',
        'resources/assets/js/vendors/jquery.easing.min.js',
        'resources/assets/js/vendors/response.min.js',
        'resources/assets/js/vendors/jquery.accordion.js',
        'resources/assets/js/vendors/jquery.placeholder.min.js',
        'resources/assets/js/vendors/waypoints.min.js',
        'resources/assets/js/vendors/smoothscroll.js',
        'resources/assets/js/vendors/jquery.fancybox.pack.js',
        'resources/assets/js/vendors/jquery.fancybox-media.js',
        'resources/assets/js/vendors/jquery.imgpreload.min.js',
        'resources/assets/js/vendors/slick.min.js',
        'resources/assets/js/vendors/jquery.counterup.min.js',
        'resources/assets/js/vendors/stripe-checkout.js',
        'resources/assets/js/app.js'
    ], 'public/js/app.js')
    .copy('resources/assets/fonts', 'public/fonts')
    .copy('resources/assets/images', 'public/images')
    .copy('resources/assets/css', 'public/css')
    .copy('resources/assets/js/auth', 'public/js/auth')
    .copy('resources/assets/js/frontend', 'public/js/frontend');
