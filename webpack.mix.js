const mix = require('laravel-mix');
const atImport = require('postcss-import');
const tailwindcss = require('tailwindcss');
const mixins = require('postcss-mixins');
const simpleVars = require('postcss-simple-vars');
const nested = require('postcss-nested');

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
  .js("resources/js/GAPopup.js", "public/js")
  .extract(["vue", "axios", "moment"])
  .sourceMaps()
  .postCss("resources/css/app.css", "public/css", [
    atImport(),
    mixins({
      mixins: {
        transitions(mixin, settings) {
          settings = settings.indexOf('|') >= 0 ? settings.split('|') : [settings];

          let set = settings.reduce((set, val) => {
            return set === '' ? val : `${set}, ${val}`;
          }, '');

          mixin.replaceWith({
            prop: 'transition',
            value: set,
          });
        },
        textGlow(mixin, number = 1, color = '#00C49A') {
          let base = 2;
          let size = 2;
          let set = '';

          for(let i = 0; i < number; i++) {
            set = (set === '') ? `0 0 ${size}px ${color}` : `${set}, 0 0 ${size}px ${color}`;
            size *= base;
          }

          mixin.replaceWith({
            prop: 'text-shadow',
            value: set,
          });
        },
      }
    }),
    simpleVars(),
    nested(),
    tailwindcss(),
  ])
  .options({
    processCssUrls: false
  })
  .version();
