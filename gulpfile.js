var pkg = require('./package.json');
var gulp = require('gulp');
var watch = require('gulp-watch');

const InjectHopperConfig = require('./gulp-tasks/inject-hopper-config');
const BrowserSync = require('./gulp-tasks/browser-sync');
const Modernizr = require('./gulp-tasks/modernizr');
const Gulpicon = require('./gulp-tasks/icons');
const Images = require('./gulp-tasks/images');
const Scripts = require('./gulp-tasks/scripts');
const Sass = require('./gulp-tasks/sass');

gulp.task('inject-hopper-config', InjectHopperConfig);

gulp.task('sass', Sass.build);

gulp.task('lint', Scripts.lint);
gulp.task('js', ['lint'], Scripts.build);

gulp.task('imagemin', Images.minify);

gulp.task('iconmin', Gulpicon.minify);
gulp.task('icons', ['iconmin'], Gulpicon.build);

gulp.task('modernizr', Modernizr);

gulp.task('browser-sync-init', BrowserSync.initialize);
gulp.task('js-watch', ['js'], BrowserSync.reload);
gulp.task('reload-watch', BrowserSync.reload);

gulp.task('default', ['inject-hopper-config', 'sass', 'js', 'browser-sync-init'], function(){
    gulp.watch(`${pkg.config.scss}/**/*.scss`, ['sass']);

    gulp.watch(`${pkg.config.scripts}/source/**/*.js`, ['js-watch']);

    gulp.watch('hopper.json', ['inject-hopper-config', 'js', 'sass']);

    //Using gulp-watch instead of gulp.watch because it will catch NEW files
    watch(`${pkg.config.images}/source/**/*.*`, Images.minify);
    watch(`${pkg.config.images}/*.*`, function(){
        try{
            BrowserSync.reload();
        } catch(err){
            //don't care!
        }
    });

    gulp.watch([
        `${pkg.config.themeRoot}/**/*.php`,
        `${pkg.config.themeRoot}/**/*.mustache`,
        `${pkg.config.scripts}/libraries/modernizr-custom.js`,
        `${pkg.config.scripts}/libraries/grunticon.js`
    ], ['reload-watch']);
});
