"use strict";
 
var gulp = require("gulp");
var sass = require("gulp-sass");
 
var SASS_ENTRYPOINT = "src/Argon/WebBundle/Resources/sass/argonbook.scss";

gulp.task('default', ['sass']);

gulp.task('sass', function() {
  console.info("+ " + SASS_ENTRYPOINT.toString());
  return gulp.src(SASS_ENTRYPOINT)
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulp.dest('web/css/'));
});

gulp.task('sass:watch', function() {
  gulp.watch(SASS_ENTRYPOINT, ['sass']);
});