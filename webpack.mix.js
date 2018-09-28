let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts(
	[
        'resources/assets/dashboard/assets/plugins/jquery/jquery.js',
        'resources/assets/dashboard/assets/plugins/bootstrap/js/popper.js',
        'resources/assets/dashboard/assets/plugins/bootstrap/js/bootstrap.js',
        'resources/assets/dashboard/js/jquery.slimscroll.js',
        'resources/assets/dashboard/js/waves.js',
        'resources/assets/dashboard/assets/plugins/datatables/jquery.dataTables.js',
        'resources/assets/dashboard/js/sidebarmenu.js',
        'resources/assets/dashboard/assets/plugins/sticky-kit-master/dist/sticky-kit.js',
        'resources/assets/dashboard/assets/plugins/sparkline/jquery.sparkline.js',
        'resources/assets/dashboard/js/custom.js',
        'resources/assets/dashboard/assets/plugins/styleswitcher/jQuery.style.switcher.js',
        'resources/assets/dashboard/assets/plugins/sweetalert/sweetalert.js',
        'resources/assets/dashboard/assets/plugins/sweetalert/jquery.sweet-alert.custom.js',
        'resources/assets/dashboard/js/const.js',
        'resources/assets/dashboard/js/mycustom.js',
        'resources/assets/dashboard/assets/plugins/toast-master/js/jquery.toast.js',
        
	],
	'public/assets/dashboard/js/app.js').minify('public/assets/dashboard/js/app.js');

mix.styles(
	[
                'resources/assets/dashboard/assets/plugins/bootstrap/css/bootstrap.css',
                'resources/assets/dashboard/assets/plugins/sweetalert/sweetalert.css',
                'resources/assets/dashboard/css/style.css',
                'resources/assets/dashboard/css/colors/green.css',
                'resources/assets/dashboard/assets/plugins/datatables/jquery.dataTables.css',
                'resources/assets/dashboard/css/icons/font-awesome/css/font-awesome.css',
                'resources/assets/dashboard/css/icons/simple-line-icons/css/simple-line-icons.css',
                'resources/assets/dashboard/css/icons/themify-icons/css/themify-icons.css',
                'resources/assets/dashboard/scss/icons/font-awesome/css/font-awesome.min.css',
                'resources/assets/dashboard/scss/icons/simple-line-icons/css/simple-line-icons.css',
                'resources/assets/dashboard/scss/icons/weather-icons/css/weather-icons.min.css',
                'resources/assets/dashboard/scss/icons/linea-icons/linea.css',
                'resources/assets/dashboard/scss/icons/themify-icons/themify-icons.css',
                'resources/assets/dashboard/scss/icons/material-design-iconic-font/css/materialdesignicons.min.css',
                'resources/assets/dashboard/css/spinners.css',
                'resources/assets/dashboard/css/animate.css',
                'resources/assets/dashboard/assets/plugins/toast-master/css/jquery.toast.css',
        ],
        
    'public/assets/dashboard/css/app.css').minify('public/assets/dashboard/css/app.css');
    
    