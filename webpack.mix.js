const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')

   .styles([
        'public/assets/css/oneui.css',
        'public/assets/css/alertify.min.css',
        'public/assets/css/default.min.css',
        'public/assets/css/custom.css'
    ],'public/css/dashboard.css')

   .styles([
        'public/website/css/bootstrap.min.css',
        'public/website/font-awesome/css/font-awesome.min.css',
        'public/website/plugins/cubeportfolio/css/cubeportfolio.css',
        'public/website/css/nivo-lightbox.css',
        'public/website/css/nivo-lightbox-theme/default/default.css',
        'public/website/css/owl.carousel.css',
        'public/website/css/owl.theme.css',
        'public/website/css/animate.css',
        'public/website/css/alertify.bootstrap3.css',
        'public/website/css/style.css',
        'public/website/bodybg/bg1.css',
        'public/website/color/default.css',
        'public/assets/css/custom.css'
    ],'public/css/website.css')

   .scripts([
        'public/assets/js/core/bootstrap.bundle.min.js',
        'public/assets/js/core/simplebar.min.js',
        'public/assets/js/core/jquery-scrollLock.min.js',
        'public/assets/js/core/jquery.appear.min.js',
        'public/assets/js/core/js.cookie.min.js',
        'public/assets/js/oneui.app.min.js',
        'public/assets/js/pages/be_pages_dashboard.min.js'
   	],'public/js/dashboard.js')

   .scripts([
        'public/website/js/jquery.min.js',   
        'public/website/js/bootstrap.min.js',
        'public/website/js/jquery.easing.min.js',
        'public/website/js/wow.min.js',
        'public/website/js/jquery.scrollTo.js',
        'public/website/js/jquery.appear.js',
        'public/website/js/stellar.js',
        'public/website/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js',
        'public/website/js/owl.carousel.min.js',
        'public/website/js/nivo-lightbox.min.js',
        'public/website/js/custom.js',
    ],'public/js/website.js');

mix.browserSync('http://127.0.0.1:8000')
