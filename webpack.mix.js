const mix = require('laravel-mix');

require('laravel-mix-purgecss');

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
}).js('resources/js/app.js', 'public/js')
  .js('resources/js/TwitterTimelineWidget.js', 'public/js')
  .js('resources/js/NewestTweetWidget.js', 'public/js')
  .js('resources/js/home.js', 'public/js')
  .js('resources/js/GitHubActivityTimelineWidget.js', 'public/js')
  .extract(['vue', 'axios', 'moment'])
  .sass('resources/sass/app.scss', 'public/css')
  .options({
    postCss: [
      require('tailwindcss')
    ],
  })
  .purgeCss()
  .version();
