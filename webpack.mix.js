// webpack.mix.js
const pjson = require('./package.json');

let mix = require('laravel-mix');
require('mix-tailwindcss');

mix
  .ts('assets/plugin.ts', 'plugin.js')
  .css('assets/plugin.css', 'plugin.css')
  .tailwind()
  .setPublicPath('dist') // this is the URL to place assets referenced in the CSS/JS
  .setResourceRoot(`/api/staticAsset/leantime.plugins.${pjson.name}.`) // this is what to prefix the URL with
  .sourceMaps(false)
  .version();
