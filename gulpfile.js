'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
 
var SASS_ENTRYPOINT = 'src/ArgonWeb/sass/argonbook.scss';

gulp.task('sass', function () {
  return gulp.src(SASS_ENTRYPOINT)
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulp.dest('web/css/'));
});
 
gulp.task('sass:watch', function () {
  gulp.watch(SASS_ENTRYPOINT, ['sass']);
});
