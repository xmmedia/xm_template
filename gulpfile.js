var gulp = require('gulp'),
	concat = require('gulp-concat-sourcemap'),
	uglify = require('gulp-uglify'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	base64 = require('gulp-base64'),
	Q = require('q');

// paths & options used within the tasks
var paths = {
	scripts : [
		// local
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
		// xm module
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
		// local
		{
			src : 'html/css/sass/*.scss',
			dest : 'html/css',
			options : {
				style: 'compressed',
				loadPath: 'html/xm/css/sass'
			}
		},
		// xm module
		{
			src : 'html/xm/css/sass/*.scss',
			dest : 'html/xm/css',
			options : {
				style: 'compressed'
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
				.pipe(concat(script.destFile, {
					// remove the first directory from the paths in the sourcemap
					prefix : 1,
					sourceRoot : '/'
				}))
				.pipe(gulp.dest(script.dest));
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
				// inline any svg images
				.pipe(base64({
					baseDir: 'html',
					extensions: ['svg']
				}))
				.pipe(gulp.dest(style.dest));
		}

		deferred.resolve();
	}, 1);

	return deferred.promise;
});

// Rerun the task when a file changes
gulp.task('watch', function() {
	// watch everything in the JS dirs & sub dirs with extension .js, but exclude the .min.js files
	gulp.watch(['html/js/**/*.js', 'html/xm/js/**/*.js', '!**/*.min.js'], ['scripts']);
	// watch everything in the sass dirs & sub dirs with extension .scss
	gulp.watch(['html/css/sass/**/*.scss', 'html/xm/css/sass/**/*.scss'], ['styles']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['scripts', 'styles']);