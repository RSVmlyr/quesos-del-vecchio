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
  .sass(`${RESOURCES_DIR}/scss/section/section-content-slider.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-instagram-reels.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-recipe-slider.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-product-hero.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-ingredient-banner.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-fun-fact.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-locations-slider.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-hotspots.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-horizontal-scroll.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-scroll-sections.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-article-hero.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-image-text.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-hero.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-animate-text.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-hero-image-content.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-gallery.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-vertical-slider-locations.scss`, DIST_DIR)
  .sass(`${RESOURCES_DIR}/scss/section/section-logos.scss`, DIST_DIR)
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
