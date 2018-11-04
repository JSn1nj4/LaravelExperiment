let mix = require('laravel-mix');

require('laravel-mix-tailwind');

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

mix.webpackConfig({
  output: {
    publicPath: '/',
    chunkFilename: 'js/modules/[name].js'
  }
}).js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/TwitterTimelineWidget.js', 'public/js')
  .js('resources/assets/js/NewestTweetWidget.js', 'public/js')
  .js('resources/assets/js/home.js', 'public/js')
  .js('resources/assets/js/GitHubActivityTimelineWidget.js', 'public/js')
  .extract(['vue', 'axios', 'moment'])
  .sass('resources/assets/sass/app.scss', 'public/css')
  .tailwind();
