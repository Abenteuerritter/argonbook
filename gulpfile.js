'use strict';

var gulp    = require('gulp');
var sass    = require('gulp-sass');
var concat  = require('gulp-concat');
var plumber = require('gulp-plumber');

var // Configuration
  SASS_DEST    = 'web/css/',
  SASS_SRC     = 'app/assets/scss/argonbook.scss',
  SASS_OPTIONS = { outputStyle: 'compressed', includePaths: ['node_modules'] },

  JS_DEST = 'web/js/',
  JS_SRC  = [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/what-input/dist/what-input.min.js',
    'node_modules/foundation-sites/dist/js/foundation.min.js',
    'node_modules/number-polyfill/number-polyfill.min.js',
    'node_modules/sortablejs/Sortable.min.js',
  ],

  FONT_DEST = 'web/fonts/',
  FONT_SRC  = [
    'node_modules/foundation-icon-fonts/foundation-icons.eot',
    'node_modules/foundation-icon-fonts/foundation-icons.woff',
    'node_modules/foundation-icon-fonts/foundation-icons.ttf',
    'node_modules/foundation-icon-fonts/foundation-icons.svg'
  ]
;

function errorHandler() {
  this.emit('end');
}

gulp.task('sass', function() {
  return gulp.src(SASS_SRC)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(sass.sync(SASS_OPTIONS).on('error', sass.logError))
    .on('error', process.exit.bind(process, 1))
    .pipe(gulp.dest(SASS_DEST));
});

gulp.task('js', function() {
  return gulp.src(JS_SRC)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest(JS_DEST));
});

gulp.task('fonts', function() {
  return gulp.src(FONT_SRC)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(gulp.dest(FONT_DEST));
});

gulp.task('default', gulp.series(['sass', 'js', 'fonts']));
