let mix = require('laravel-mix');
require('laravel-mix-purgecss');

// Compile SCSS file
mix.sass('src/css/style.scss', 'dist/css/main.css')

  // Optimize CSS
  .options({
    processCssUrls: false,
    postCss: [
      require('cssnano')({
        preset: ['default', {
          discardComments: { removeAll: true },
          normalizeWhitespace: true,
        }],
      }),
    ],
  })
  .purgeCss({
    content: [
      './**/**/**/*.php',
    ],
    safelist: [/^rtl/, /^ltr/, /^fancybox/],
  });

// Compile and minify JavaScript
mix.js('src/js/app.js', 'dist/js/app.js')
  .minify('dist/js/app.js');

// Copy Fancybox CSS to your CSS bundle
mix.styles([
  'dist/css/main.css',
  'node_modules/@fancyapps/ui/dist/fancybox/fancybox.css'
], 'dist/css/main.css');

// Set public path and versioning
mix.setPublicPath('./');
mix.version();
