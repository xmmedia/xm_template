var gulp = require('gulp'),
	concat = require('gulp-concat-sourcemap'),
	uglify = require('gulp-uglify'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	base64 = require('gulp-base64'),
	svgmin = require('gulp-svgmin'),
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
					'html/js/src/modernizr.min.js',
					'html/js/src/jquery.min.js',
					'html/js/src/base.js'
				]
		},
		{
			dest : 'html/js',
			destFile : 'private.min.js',
			files :
				[
					'html/js/src/jquery-ui.min.js',
					'html/xm/js/src/xm.js',
					'html/xm/js/src/ajax.js',
					'html/js/src/private.js'
				]
		},
		// xm module
		{
			dest : 'html/xm/js',
			destFile : 'error_admin.min.js',
			files :
				[
					'html/xm/js/src/error_admin.js'
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
gulp.task('styles', ['svgs'], function() {
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

// SVGs
gulp.task('svgs', function() {
	return gulp.src('html/images/*.svg')
		.pipe(svgmin())
		.pipe(gulp.dest('html/images'));
});

// Rerun the task when a file changes
gulp.task('watch', function() {
	// watch everything in the JS dirs & sub dirs with extension .js, but exclude the .min.js files
	gulp.watch(['html/js/src/**/*.js', 'html/xm/js/src/**/*.js'], ['scripts']);
	// watch everything in the sass dirs & sub dirs with extension .scss
	gulp.watch(['html/css/sass/**/*.scss', 'html/xm/css/sass/**/*.scss'], ['styles']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['scripts', 'styles']);