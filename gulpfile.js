var gulp = require('gulp'),
	concat = require('gulp-concat-sourcemap'),
	uglify = require('gulp-uglify'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	base64 = require('gulp-base64'),
	svgmin = require('gulp-svgmin'),
	size = require('gulp-size'),
	Q = require('q'),
	colors = require('colors');

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
				style : 'compressed',
				loadPath : 'html/xm/css/sass',
				container : 'local_sass',
				// disable source maps (don't work with autoprefixer atm)
				"sourcemap=none" : true
			}
		},
		// xm module
		{
			src : 'html/xm/css/sass/*.scss',
			dest : 'html/xm/css',
			options : {
				style : 'compressed',
				container : 'xm_sass',
				// disable source maps (don't work with autoprefixer atm)
				"sourcemap=none" : true
			}
		}
	]
};

// Scripts
gulp.task('scripts', function(cb) {
	var deferred = Q.defer();

	setTimeout(function() {
		var script, uglify_options;
		for (var key in paths.scripts) {
			script = paths.scripts[key];

			uglify_options = {
				mangle : false
			};
			for (var _key in script.uglify_options) {
				uglify_options[_key] = script.uglify_options[_key];
			}

			gulp.src(script.files)
				.pipe(uglify(uglify_options))
				.on('error', function (err) {
					console.log('   ' + 'Uglify JS ERROR'.underline.red);
					console.log('   ' + err.message.underline.red);
				})
				.pipe(concat(script.destFile, {
					// remove the first directory from the paths in the sourcemap
					prefix : 1,
					sourceRoot : '/'
				}))
				.on('error', function (err) {
					console.log('   ' + 'Concat JS ERROR'.underline.red);
					console.log('   ' + err.message.underline.red);
				})
				.pipe(size({
					showFiles: true
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
				.on('error', function (err) {
					console.log('   ' + 'SASS ERROR'.underline.red);
					console.log('   ' + err.message.underline.red);
				})
				// write the files so everything is saved for autoprefixer and base64
				.pipe(gulp.dest(style.dest))
				.pipe(autoprefixer())
				.on('error', function (err) {
					console.log('   ' + 'Autoprefixer ERROR'.underline.red);
					console.log('   ' + err.message.underline.red);
				})
				// inline any files with extensions: svg, png@datauri, or jpg#datauri
				.pipe(base64({
					baseDir : 'html',
					extensions : ['svg', /\.png#datauri$/i, /\.jpg#datauri$/i],
					maxImageSize : 8*1024 // bytes
				}))
				.on('error', function (err) {
					console.log('   ' + 'Base64 ERROR'.underline.red);
					console.log('   ' + err.message.underline.red);
				})
				.pipe(size({
					showFiles: true
				}))
				.pipe(gulp.dest(style.dest));
		}

		deferred.resolve();
	}, 1);

	return deferred.promise;
});

// SVGs
gulp.task('svgs', function() {
	return gulp.src('html/images/**/*.svg')
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