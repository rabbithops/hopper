var gulp = require('gulp');
var imagemin = require('gulp-imagemin');
var gulpicon = require('gulpicon/tasks/gulpicon');
var pkg = require('../package.json');
var glob = require('glob');
var changed = require('gulp-changed');

let iconGlob = glob.sync(`${pkg.config.icons}/source/*.svg`);

let iconOptions = {
    corsEmbed: true,
    dest: `${pkg.config.icons}/dist`,
    cssprefix: '.icon-',
    defaultHeight: '64px',
    defaultWidth: '64px',
    enhanceSVG: true,
    loadersnippet: 'grunticon.js',
    optimizationLevel: 5
}

const minify = function(){
    return gulp.src(`${pkg.config.icons}/source/raw/*.svg`)
        .pipe(changed(`${pkg.config.icons}/source`))
        .pipe(imagemin())
        .pipe(gulp.dest(`${pkg.config.icons}/source`));
}


module.exports = { minify, build: gulpicon(iconGlob, iconOptions) }
