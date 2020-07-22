let mix = require('laravel-mix');

mix.options({
    publicPath: 'dist',
    postCss: [
        require('autoprefixer')({
            remove: false,
            browsers: ['>1%'],
            grid: true
        })
    ]
}).js('src/main.js', 'dist/').version();
