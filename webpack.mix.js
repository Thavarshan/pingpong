const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 3 })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .alias({
        '@': path.join(__dirname, 'resources/js'),
        ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'),
    })
    .browserSync('pingpong.test');

if (mix.inProduction()) {
    mix.version();
}
