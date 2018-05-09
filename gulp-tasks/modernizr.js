var pkg = require('../package.json');
var gulp = require('gulp');
var modernizr = require('gulp-modernizr');

const modernizrOptions = {
    'cache': false,
    'devFile': `${pkg.config.scripts}/libraries/modernizr.js`,
    'dest': `${pkg.config.scripts}/libraries/modernizr-custom.js`,

    // Based on default settings on http://modernizr.com/download/
    'options': [
        'addtest',
        'classes',
        'html5printshiv',
        'html5shiv',
        'load',
        'mq',
        'setClasses'
    ],

    // Define any tests you want to implicitly include.
    'tests': [
        'rgba'
    ],

    'crawl': false,

    // hidden is a selector used in magento.
    // Don't test for it, it will hide the html element :D
    'excludeTests': ['hidden']
}

module.exports = function(){
    return gulp.src([ `${pkg.config.scss}/**/*.{css,scss}`,
                      `${pkg.config.scripts}/source/**/*.js` ])
        .pipe(modernizr(modernizrOptions))
        .pipe(gulp.dest(`${pkg.config.scripts}/libraries`));
}
