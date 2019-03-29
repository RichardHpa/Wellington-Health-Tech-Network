module.exports = function(grunt){
    grunt.initConfig({
        sass: {
            admin: {
                src: ['assets/scss/admin/admin.scss'],
                dest: 'assets/css/admin/admin.css',
                options: {
                    sourcemap: 'none',
                    noCache: true
                }
            },
            front: {
                src: ['assets/scss/front/master.scss'],
                dest: 'assets/css/front/style.css',
                options: {
                    sourcemap: 'none',
                    noCache: true
                }
            }
        },
        watch: {
            admin_scss: {
                files: [
                    'assets/scss/admin/*.scss'
                ],
                tasks: [
                    'sass:admin',
                ]
            },
            front_scss: {
                files: [
                    'assets/scss/front/*.scss'
                ],
                tasks: [
                    'sass:front'
                ]
            },
        },
        csslint: {
            strict: {
              options: {
                import: 2
              },
              src: ["assets/css/front/style.css"]
            }
        },
        jshint: {
            files: ["*.js", "assets/js/script.js"],
            options: {
                globals:{
                    jQuery: true
                }
            }
        },
        cssmin: {
          target: {
            files: [{
              expand: true,
              cwd: 'assets/css/*/',
              src: ['*.css', '!*.min.css'],
              dest: 'css/',
              ext: '.min.css'
            }]
          }
        },
    });

    // grunt.loadNpmTasks();
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    // grunt.registerTask();
    grunt.registerTask('complie', ['sass:front', 'sass:admin']);
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('compile', ['sass']);
    // grunt.registerTask('validate', ['csslint', 'jshint']);

};
