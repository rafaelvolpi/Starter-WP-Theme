// webpack.mix.js

let mix = require('laravel-mix');

mix.setPublicPath("./");
mix.browserSync("narro.test");

mix.postCss("resources/css/app.css", "dist/css").options({
  processCssUrls: false,
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
