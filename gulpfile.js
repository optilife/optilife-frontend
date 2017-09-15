'use strict';

// Gulp packages.
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var pump = require('pump');
var del = require('del');
var rename = require('gulp-rename');

// Custom settings.
var theme_name = 'theme';

// Path settings.
var paths = {
  theme: './' + theme_name,
  sass: './' + theme_name + '/src/sass',
  css: './' + theme_name + '/dist/css',
  css_maps: './maps',
  js_src: './' + theme_name + '/src/js',
  js_dist: './' + theme_name + '/dist/js',
  js_maps: './maps'
};

var options = {
  sass: {
    outputStyle: 'compressed'
  },
  uglify: {
    quote_style: 1
  }
};

gulp.task('clean-css', function() {
  del.sync([paths.css + '/*']);
  del.sync([paths.css + '/' + paths.css_maps]);
});

gulp.task('clean-js', function() {
  del.sync([paths.js_dist + '/*']);
  del.sync([paths.js_dist + '/' + paths.js_maps]);
});

gulp.task('clean', ['clean-css', 'clean-js']);

gulp.task('compile-css', ['clean-css'], function() {
  return gulp.src(paths.sass + '/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(options.sass).on('error', sass.logError))
    .pipe(sourcemaps.write(paths.css_maps, {sourceRoot: '../../src/sass/'}))
    .pipe(gulp.dest(paths.css));
});

gulp.task('compile-js', ['clean-js'], function(cb) {
  pump([
      gulp.src(paths.js_src + '/*.js'),
      sourcemaps.init(),
      rename({suffix: '.min'}),
      uglify(options.uglify),
      sourcemaps.write(paths.js_maps),
      gulp.dest(paths.js_dist)
    ],
    cb
  );
});

gulp.task('compile', ['compile-css', 'compile-js']);

gulp.task('watch', function() {
  gulp.watch(paths.sass + '/**/*.scss', ['compile-css']);
  gulp.watch(paths.js_src + '/**/*.js', ['compile-js']);
});

gulp.task('default', ['compile', 'watch']);
