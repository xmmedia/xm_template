module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		uglify: {
			options: {
				mangle: false
			},
			dist: {
				files: {
					'html/js/base.min.js': 'html/js/base.js',
					'html/js/private.min.js':
						[
							'html/js/jquery.outside.min.js',
							'html/xm/js/xm.js',
							'html/xm/js/ajax.js',
							'html/js/private.js'
						]
				}
			},
			xm: {
				files: {
					'html/xm/js/error_admin.min.js': 'html/xm/js/error_admin.js'
				}
			}
		},

		compass: {
			dist: {
				options: {
					httpPath: '/',
					cssDir: 'html/css',
					sassDir: 'html/css/sass',
					imagesDir: 'html/images',
					httpImagesPath: '/images',
					httpGeneratedImagesPath: '/images',
					javascriptsDir: 'html/js',
					httpJavascriptsPath: '/js',
					outputStyle: 'compressed',
					noLineComments: false,
					importPath: 'html/xm/css/sass'
				}
			},
			xm: {
				options: {
					httpPath: '/',
					cssDir: 'html/xm/css',
					sassDir: 'html/xm/css/sass',
					imagesDir: 'html/xm/images',
					httpImagesPath: '/xm/images',
					httpGeneratedImagesPath: '/xm/images',
					javascriptsDir: 'html/xm/js',
					httpJavascriptsPath: '/xm/js',
					outputStyle: 'compressed',
					noLineComments: false
				}
			}
		},

		autoprefixer: {
			dist: {
				expand: true,
				flatten: true,
				src: 'html/css/*.css',
				dest: 'html/css/'
			},
			xm: {
				expand: true,
				flatten: true,
				src: 'html/xm/css/*.css',
				dest: 'html/xm/css/'
			}
		},

		watch: {
			scripts: {
				files: ['html/js/*.js', 'html/xm/js/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false,
				},
			},

			css: {
				files: ['html/css/sass/*.scss', 'html/xm/css/sass/*.scss'],
				tasks: ['compass', 'autoprefixer'],
				options: {
					spawn: false,
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', ['uglify', 'compass', 'autoprefixer']);
};