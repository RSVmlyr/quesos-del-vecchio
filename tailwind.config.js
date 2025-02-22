/** @type {import('tailwindcss').Config} */
const glob = require('fast-glob');

module.exports = {
  content: glob.sync(['./**.php', './**/**.php', './src/js/**.js', './src/js/**/**.js']),
  blocklist: ['container'],
  theme: {
    extend: {
      colors: {
        black: 'rgba(var(--black) / <alpha-value>)',
        blue_dark: 'rgba(var(--blue_dark) / <alpha-value>)',
        blue_light: 'rgba(var(--blue_light) / <alpha-value>)',
        content: 'rgba(var(--content) / <alpha-value>)',
        pink: 'rgba(var(--pink) / <alpha-value>)',
        white: 'rgba(var(--white) / <alpha-value>)',
        white_dark: 'rgba(var(--white_dark) / <alpha-value>)',
      },
      fontFamily: {
        myriad: 'var(--font-myriad)',
        gotham: 'var(--font-gotham)',
        gotham_narrow: 'var(--font-gotham-narrow)',
        cocogoose: 'var(--font-cocogoose)',
        cocogoose_block: 'var(--font-cocogoose-block)',
      },
    },
  },
  plugins: [
    function ({ addVariant }) {
      addVariant('next-child', '& + *');
    },
  ],
};
