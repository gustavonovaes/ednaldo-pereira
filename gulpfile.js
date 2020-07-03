const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglifyjs = require('gulp-uglify-es').default;
const cleanCss = require('gulp-clean-css');
const purgecss = require('gulp-purgecss');
const merge = require('merge-stream');

sass.compiler = require('node-sass');

gulp.task('sass', function () {
  const sassStream = gulp.src([
    './resources/scss/**/*.{scss,css}',
  ]).pipe(sass().on('error', sass.logError));

  const cssStream = gulp.src([
    'node_modules/chart.js/dist/Chart.min.css',
  ]);

  return merge(cssStream, sassStream)
    .pipe(concat('main.css'))
    .pipe(purgecss({
      content: ['./templates/**/*.tpl']
    }))
    .pipe(cleanCss())
    .pipe(gulp.dest('./public/css'));
});

gulp.task('script', function () {
  return gulp
    .src([
      'resources/js/main.js',
    ])
    .pipe(concat('main.js'))
    .pipe(uglifyjs())
    .pipe(gulp.dest('public/js'));
});

gulp.task('script:vendor', function () {
  return gulp
    .src([
      'node_modules/bootstrap/dist/js/bootstrap.js',
      'node_modules/popper.js/dist/umd/popper.js',
      'node_modules/feather-icons/dist/feather.js',
      'node_modules/chart.js/dist/Chart.js',
    ])
    .pipe(concat('vendor.js'))
    .pipe(uglifyjs())
    .pipe(gulp.dest('public/js'));
});

gulp.task('dev', function () {
  gulp.watch('./resources/scss/**/*.{scss,css}', gulp.series('sass'));
  gulp.watch('./resources/js/**/*.js', gulp.series('script'));
});
