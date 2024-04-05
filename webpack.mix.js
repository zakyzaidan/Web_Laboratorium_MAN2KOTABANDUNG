const mix = require('laravel-mix')

mix.js('node_modules/@ckeditor/ckeditor5-alignment/src/index.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');

mix.disableNotifications();

mix.webpackConfig({
    resolve: {
      alias: {
        '@ckeditor': path.resolve(__dirname, './node_modules/@ckeditor'),

      },
    },
});


