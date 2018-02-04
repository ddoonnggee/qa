var elixir = require('laravel-elixir'),
    gulp   = require('gulp'),
    base64 = require('gulp-base64'),
    del    = require('del'),
    colors = require('colors');//npm install --save-dev colors

elixir.config.sourcemaps = false;

var assets = "resources/assets/",
    bower = "bower/",
    paths = {
        'adminlte': bower + 'AdminLTE/',
      	'bootstrap': bower + 'AdminLTE/bootstrap/',
        'fontawesome': bower + 'font-awesome/',
        'ionicons': bower + 'Ionicons/',
        'datatables': bower + 'AdminLTE/plugins/datatables/',
        'jqueryui': bower + 'jquery-ui/ui/minified/',
        'toastr': bower + 'toastr/',
    },
    developmentAssets = "public/";

var base64_config = {
    dest: assets + 'css/base64/',
    options: {
        // baseDir: build,
        extensions: ['png'],
        maxImageSize: 20 * 1024, // bytes
        debug: false
    }
};

elixir.extend('iCheckBase64', function() {
    gulp.task('base64', function() {
        console.log('Base64 iCheck css'.bgYellow);
        return gulp.src([
            assets + paths.adminlte + 'plugins/iCheck/square/blue.css'
        ])
        .pipe(base64(base64_config.options))
        .pipe(gulp.dest(base64_config.dest));
    });
    return this.queueTask('base64');
});

gulp.task("remove", function() {
    del([
        base64_config.dest,
        developmentAssets + "css/backend.css",
        developmentAssets + "js/backend.js"
    ]);
});

elixir(function(mix) {
    mix.copy(assets + paths.bootstrap + 'fonts/**', developmentAssets + 'build/fonts')
        .copy(assets + paths.fontawesome + 'fonts/**', developmentAssets + 'build/fonts')
        .copy(assets + paths.ionicons + 'fonts/**', developmentAssets + 'build/fonts')
        .iCheckBase64()
        .styles([
            paths.bootstrap + "css/bootstrap.css",
            paths.fontawesome + "css/font-awesome.css",
            paths.ionicons + "css/ionicons.css",
            paths.datatables + "dataTables.bootstrap.css",
            paths.datatables + "extensions/Responsive/css/dataTables.responsive.css",
            paths.adminlte + "dist/css/AdminLTE.css",
            paths.adminlte + "dist/css/skins/_all-skins.min.css",
            paths.adminlte + "plugins/pace/pace.css",
            paths.toastr + "toastr.css",
            "css/base64/blue.css",
            "css/backend.css",
        ], developmentAssets + "css/backend.css", assets)
        .scripts([
            bower + "jquery/dist/jquery.min.js",
            paths.jqueryui + "core.min.js",
            paths.jqueryui + "effect.min.js",
            paths.jqueryui + "effect-highlight.min.js",
            paths.bootstrap + "js/bootstrap.min.js",
            paths.datatables + "jquery.dataTables.min.js",
            paths.datatables + "dataTables.bootstrap.min.js",
            paths.datatables + "extensions/Responsive/js/dataTables.responsive.min.js",
            bower + "yadcf/jquery.dataTables.yadcf.js",
            paths.adminlte + "plugins/iCheck/icheck.min.js",
            paths.adminlte + "plugins/slimScroll/jquery.slimscroll.min.js",
            paths.adminlte + "plugins/fastclick/fastclick.min.js",
            paths.adminlte + "dist/js/app.min.js",
            paths.adminlte + "plugins/pace/pace.js",
            bower + "bootbox.js/bootbox.js",
            bower + "screenfull/dist/screenfull.js",
            paths.toastr + "toastr.min.js",
            "js/backend.js",
        ], developmentAssets + 'js/backend.js', assets)
        .version(['css/backend.css','js/backend.js'])
        .task('remove')
});
