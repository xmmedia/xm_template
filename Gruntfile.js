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
			}
		},

		compass: {
			dist: {
				options: {
					config: 'config.rb'
				}
			}
		},

		autoprefixer: {
			multiple_files: {
				expand: true,
				flatten: true,
				src: 'html/css/*.css', // -> src/css/file1.css, src/css/file2.css
				dest: 'html/css/' // -> dest/css/file1.css, dest/css/file2.css
			},
		},

		watch: {
			scripts: {
				files: ['html/js/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false,
				},
			},

			css: {
				files: ['html/css/sass/*.scss'],
				tasks: ['compass'],
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