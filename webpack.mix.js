// webpack.mix.js

let mix = require('laravel-mix');

// SVG VUE 3
require('laravel-mix-svg-vue');

mix.setPublicPath("./");
mix.browserSync("narro.test");

mix.postCss("resources/css/app.css", "dist/css").options({
  processCssUrls: true,
  postCss: [
      require("postcss-import"),
      require("tailwindcss/nesting"),
      require("tailwindcss"),
      require("autoprefixer"),
    ],
  });
  

mix.js('resources/js/app.js', 'dist')
  .vue({ version: 3 })
  .version()
  .svgVue();
