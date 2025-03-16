const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

// Directories
const RESOURCES_DIR = path.resolve(__dirname, 'src');
const DIST_DIR = path.resolve(__dirname, 'dist');
const LOCAL_URL = 'quesos-del-vecchio.local/';

mix
  .webpackConfig({
    plugins: [new CleanWebpackPlugin({ verbose: false, cleanOnceBeforeBuildPatterns: [DIST_DIR] })],
  })
  .setPublicPath(__dirname)
  .options({
    processCssUrls: false,
    postCss: [tailwindcss('tailwind.config.js')],
  })
  .js(`${RESOURCES_DIR}/js/app.js`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/app.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-homepage-hero.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-occasions-slider.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-occasions-hero.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-vertical-slider.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-four-images-slider.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-instagram-reels.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-recipe-slider.scss`, DIST_DIR)
  .copyDirectory(`${RESOURCES_DIR}/fonts`, DIST_DIR)
  .copyDirectory(`${RESOURCES_DIR}/svg`, DIST_DIR)
  .sourceMaps();

mix.browserSync({
  proxy: LOCAL_URL,
  open: 'external',
  files: [`${__dirname}/**/*.php`, `${__dirname}/**/*.js`, `${__dirname}/**/*.css`],
});

/*
 |--------------------------------------------------------------------------
 | Production Mode
 |--------------------------------------------------------------------------
 */

if (mix.inProduction()) {
  mix.sourceMaps(false).options({
    terser: {
      terserOptions: {
        compress: {
          drop_console: true,
        },
      },
    },
  });
}
