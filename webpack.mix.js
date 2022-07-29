let mix = require('laravel-mix');

mix.setPublicPath('./').options({
    processCssUrls: false,
})

/**
 * Copy
 */
mix
    .copyDirectory('node_modules/bulma', 'assets/src/bulma')
mix
    .copy('assets/images/favicon.ico', 'public/images/favicon.ico')
    .copy('node_modules/jquery/dist/jquery.min.js', 'assets/src/jquery/dist/jquery.min.js')

/**
 * JS
 */
mix.scripts(
    [
        'assets/src/jquery/dist/jquery.min.js',
        'assets/js/bulma.js',
        'assets/js/app.js'
    ],
    'public/js/app.js'
)

mix.minify('public/js/app.js', 'public/js/app.min.js')

/**
 * CSS
 */
mix.sass('assets/sass/app.scss', 'public/css')


mix.version();
