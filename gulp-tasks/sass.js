var pkg = require('../package.json');
var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var pxtorem = require('postcss-pxtorem');
var mqpacker = require('css-mqpacker');
var uniqueSelectors = require('postcss-unique-selectors');
var sourcemaps = require('gulp-sourcemaps');

const streamToBrowserSync = require('./browser-sync').stream;

const sassOptions = {
    errLogToConsole: true,
    includePaths: [
        './node_modules/susy/sass',
        `${pkg.config.scss}/**/*.scss`
    ]
};

const autoprefixerOptions = {
    expand: true,
    flatten: true,
    browsers: ['last 2 versions', '> 1%']
};

const pxToRemOptions = {
    propWhiteList: [
        'font',
        'font-size',
        'line-height',
        'letter-spacing',
        'margin',
        'margin-top',
        'margin-right',
        'margin-bottom',
        'margin-left',
        'padding',
        'padding-top',
        'padding-right',
        'padding-bottom',
        'padding-left'
    ]
};

const mqpackerOptions = {
    sort: true
};

const build = function(){
    return gulp.src(`${pkg.config.scss}/**/*.scss`)
      .pipe(sourcemaps.init())
      .pipe(sass(sassOptions).on('error', function(err){
            console.error(err.message);
            this.emit('end');
        }))
      .pipe(postcss([
          autoprefixer(autoprefixerOptions),
          pxtorem(pxToRemOptions),
          mqpacker(mqpackerOptions),
          uniqueSelectors()
      ]))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest(pkg.config.css))
      .pipe(streamToBrowserSync());
}

module.exports = { build }
