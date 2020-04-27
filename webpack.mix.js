const mix = require('laravel-mix');
const atImport = require('postcss-import');
const tailwindcss = require('tailwindcss');
const mixins = require('postcss-mixins');
const simpleVars = require('postcss-simple-vars');
const nested = require('postcss-nested');
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

mix
  .webpackConfig({
    output: {
      publicPath: "/",
      chunkFilename: "js/modules/[name].js"
    }
  })
  .js("resources/js/app.js", "public/js")
  .js("resources/js/TwitterTimelineWidget.js", "public/js")
  .js("resources/js/NewestTweetWidget.js", "public/js")
  .js("resources/js/home.js", "public/js")
  .js("resources/js/GitHubActivityTimelineWidget.js", "public/js")
  .js("resources/js/MainProjectsList.js", "public/js")
  .extract(["vue", "axios", "moment"])
  .sourceMaps()
  .postCss("resources/css/app.css", "public/css", [
    atImport(),
    tailwindcss(),
    mixins(),
    simpleVars(),
    nested(),
  ])
  .options({
    processCssUrls: false
  })
  .purgeCss()
  .version();
