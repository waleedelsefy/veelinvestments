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
        safelist: [/^rtl/, /^ltr/], // Safelist for RTL/LTR classes
    });

// Compile and minify JavaScript
mix.js('./src/js/app.js', 'dist/js/app.js')
    .minify('dist/js/app.js');

// Set public path and versioning
mix.setPublicPath('./');
mix.version();
