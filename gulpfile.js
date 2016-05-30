"use strict";
 
var gulp = require("gulp");
var sass = require("gulp-sass");
 
var SASS_ENTRYPOINT = "src/Argon/WebBundle/Resources/scss/argonbook.scss";
var SASS_OPTIONS    = {outputStyle: "compressed", includePaths: ["node_modules"]};

gulp.task('default', ['sass']);

gulp.task('sass', function() {
  console.info("+ " + SASS_ENTRYPOINT.toString());
  return gulp.src(SASS_ENTRYPOINT)
    .pipe(sass.sync(SASS_OPTIONS).on('error', sass.logError))
    .pipe(gulp.dest('web/css/'));
});

gulp.task('sass:watch', function() {
  gulp.watch(SASS_ENTRYPOINT, ['sass']);
});