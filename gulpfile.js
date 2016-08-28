'use strict';
 
var gulp   = require('gulp');
var util   = require('gulp-util');
var sass   = require('gulp-sass');
var concat = require('gulp-concat');

var // Configuration
  FONT_DEST = 'web/fonts/',
  FONT_SRC  = [
    'bower_components/foundation-icon-fonts/foundation-icons.eot',
    'bower_components/foundation-icon-fonts/foundation-icons.woff',
    'bower_components/foundation-icon-fonts/foundation-icons.ttf',
    'bower_components/foundation-icon-fonts/foundation-icons.svg'
  ],

  SASS_DEST    = 'web/css/',
  SASS_SRC     = 'app/assets/scss/argonbook.scss',
  SASS_OPTIONS = {outputStyle: 'compressed', includePaths: ['node_modules', 'bower_components']},

  JS_DEST = 'web/js/',
  JS_SRC  = [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/foundation-sites/dist/foundation.min.js',
    'node_modules/sortablejs/Sortable.min.js',
  ]
;

gulp.task('default', ['sass', 'js', 'fonts']);

gulp.task('sass', function() {
  return gulp.src(SASS_SRC)
    .pipe(sass.sync(SASS_OPTIONS).on('error', sass.logError))
    .pipe(gulp.dest(SASS_DEST));
});

gulp.task('sass:watch', function() {
  gulp.watch(SASS_SRC, ['sass']);
});

gulp.task('js', function() {
  return gulp.src(JS_SRC)
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest(JS_DEST));
});

gulp.task('js:watch', function() {
  gulp.watch(JS_SRC, ['js']);
});

gulp.task('fonts', function() {
  return gulp.src(FONT_SRC)
    .pipe(gulp.dest(FONT_DEST));
});
