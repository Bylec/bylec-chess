const mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        }
    }
})

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

mix.copy('node_modules/bootstrap/dist/css//bootstrap.css', 'resources/sass/bootstrap.scss');

mix.js([
    'node_modules/popper.js/dist/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/@chrisoakman/chessboardjs/dist/chessboard-1.0.0.js',
], 'public/js/app.js');

mix.js([
    'resources/js/app.js'
], 'public/js/vue.js')
   .sass(['resources/sass/app.scss',
            'resources/sass/bootstrap.scss'], 'public/css/app.css');
