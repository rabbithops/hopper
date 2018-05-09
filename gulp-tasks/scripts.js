var pkg = require('../package.json');
var gulp = require('gulp');
var eslint = require('gulp-eslint');
var colors = require('colors/safe');
var webpack = require('webpack');
var gulpWebpack = require('gulp-webpack');
var path = require('path');

let pathToScripts = path.resolve(`${pkg.config.scripts}`);

let webpackConfig = {
    entry: `${pathToScripts}/source/main.js`,
    output: {
        path: `${pathToScripts}/site`,
        filename: 'main.js',
        sourceMapFilename: '[name].js.map'
    },
    devtool: 'source-map',
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                options: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    },
    plugins: [
        new webpack.DefinePlugin({
            'process.env.NODE_ENV': JSON.stringify('production')
        }),
        new webpack.LoaderOptionsPlugin({
            minimize: true,
            debug: false
        }),
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            beautify: false,
            mangle: {
                screw_ie8: true,
                keep_fnames: true
            },
            compress: {
                screw_ie8: true
            },
            comments: false
        })
    ]
};

const handleError = function(err) {
    console.error('---------------------------');
    console.error(colors.red.bold('ERROR Building JS Bundle!'));
    console.error(colors.red(err.message));
    console.error('---------------------------');

    this.emit('end');
};

function buildWithWebpack(done) {
    return gulp
        .src(`${pkg.config.scripts}/source/main.js`)
        .pipe(gulpWebpack(webpackConfig, webpack, done))
        .pipe(gulp.dest(`${pkg.config.scripts}/site`))
        .on('error', handleError);
}

function build(done) {
    buildWithWebpack(done);
}

const lint = function() {
    return gulp
        .src(`${pkg.config.scripts}/source/**/*.js`)
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
};
module.exports = { lint, build };
