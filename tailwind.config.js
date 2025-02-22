/** @type {import('tailwindcss').Config} */
const glob = require('fast-glob');

module.exports = {
  content: glob.sync(['./**.php', './**/**.php', './src/js/**.js', './src/js/**/**.js']),
  blocklist: ['container'],
  theme: {
    extend: {
      colors: {
        blue: 'rgba(var(--blue) / <alpha-value>)',
        beige: 'rgba(var(--beige) / <alpha-value>)',
        white: 'rgba(var(--white) / <alpha-value>)',
      },
      fontFamily: {
        figtree: 'var(--font-figtree)',
      },
    },
  },
  plugins: [
    function ({ addVariant }) {
      addVariant('next-child', '& + *');
    },
  ],
};
