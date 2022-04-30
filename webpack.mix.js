let mix = require('laravel-mix');

mix
    .css('assets/css/app.css', 'public/css')
    .js('assets/js/app.js', 'public/js');