var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	notify = require('gulp-notify'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	Q = require('q');

// paths & options used within the tasks
var paths = {
	scripts : [
		{
			dest : 'html/js',
			destFile : 'base.min.js',
			files :
				[
					'html/js/modernizr.min.js',
					'html/js/jquery.min.js',
					'html/js/base.js'
				]
		},
		{
			dest : 'html/js',
			destFile : 'private.min.js',
			files :
				[
					'html/js/jquery-ui.min.js',
					'html/xm/js/xm.js',
					'html/xm/js/ajax.js',
					'html/js/private.js'
				]
		},
		{
			dest : 'html/xm/js',
			destFile : 'error_admin.min.js',
			files :
				[
					'html/xm/js/error_admin.js'
				]
		}
	],
	styles : [
		{
			src : 'html/css/sass/*.scss',
			dest : 'html/css',
			options : {
				style: 'compressed',
				loadPath: 'html/xm/css/sass'
			}
		},
		{
			src : 'html/xm/css/sass/*.scss',
			dest : 'html/xm/css',
			options : {
				style: 'compressed',
			}
		}
	]
};

// Scripts
gulp.task('scripts', function(cb) {
	var deferred = Q.defer();

	setTimeout(function() {
		var script;
		for (var key in paths.scripts) {
			script = paths.scripts[key];

			gulp.src(script.files)
				.pipe(uglify({
					mangle : false
				}))
				.pipe(concat(script.destFile))
				.pipe(gulp.dest(script.dest))
				.pipe(notify({ message: 'Scripts task complete: <%= file.relative %>' }));
		}

		deferred.resolve();
	}, 1);

	return deferred.promise;
});

// Styles
gulp.task('styles', function() {
	var deferred = Q.defer();

	setTimeout(function() {
		var style;
		for (var key in paths.styles) {
			style = paths.styles[key];

			gulp.src(style.src)
				.pipe(sass(style.options))
				.pipe(autoprefixer())
				.pipe(gulp.dest(style.dest))
				.pipe(notify({ message: 'Styles task complete: <%= file.relative %>' }));
		}

		deferred.resolve();
	}, 1);

	return deferred.promise;
});

// Rerun the task when a file changes
gulp.task('watch', function() {
	gulp.watch(['html/js/**', 'html/xm/js/**'], ['scripts']);
	gulp.watch(['html/css/sass/**', 'html/xm/css/sass/**'], ['styles']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['scripts', 'styles']);