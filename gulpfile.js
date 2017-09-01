'use strict';
 
var gulp    = require('gulp');
var util    = require('gulp-util');
var sass    = require('gulp-sass');
var concat  = require('gulp-concat');
var plumber = require('gulp-plumber');

var // Configuration
  SASS_DEST    = 'web/css/',
  SASS_SRC     = 'app/assets/scss/argonbook.scss',
  SASS_OPTIONS = { outputStyle: 'compressed', includePaths: ['node_modules', 'bower_components'] },

  JS_DEST = 'web/js/',
  JS_SRC  = [
    'bower_components/jquery/dist/jquery.min.js',
    'bower_components/number-polyfill/number-polyfill.min.js',
    'bower_components/Sortable/Sortable.min.js',
    'bower_components/foundation-sites/dist/js/foundation.min.js',
  ],

  FONT_DEST = 'web/fonts/',
  FONT_SRC  = [
    'bower_components/foundation-icon-fonts/foundation-icons.eot',
    'bower_components/foundation-icon-fonts/foundation-icons.woff',
    'bower_components/foundation-icon-fonts/foundation-icons.ttf',
    'bower_components/foundation-icon-fonts/foundation-icons.svg'
  ]
;

function errorHandler() {
  this.emit('end');
}

gulp.task('default', ['sass', 'js', 'fonts']);

gulp.task('sass', function() {
  gulp.src(SASS_SRC)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(sass.sync(SASS_OPTIONS).on('error', sass.logError))
    .on('error', process.exit.bind(process, 1))
    .pipe(gulp.dest(SASS_DEST));
});

gulp.task('js', function() {
  gulp.src(JS_SRC)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest(JS_DEST));
});

gulp.task('fonts', function() {
  gulp.src(FONT_SRC)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(gulp.dest(FONT_DEST));
});
