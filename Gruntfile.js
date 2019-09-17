module.exports = function(grunt){
    grunt.initConfig({
        sass:{
            front: {
                options: {
                    style: 'expanded',
                    sourcemap: 'none',
                    noCache: true
                },
                files : {
                    'assets/css/style.css':'assets/scss/front/style.scss'
                }
            },
            admin: {
                options: {
                    style: 'expanded',
                    sourcemap: 'none',
                    noCache: true
                },
                files : {
                    'assets/css/admin.css':'assets/scss/admin/admin.scss'
                }
            },
            bootstrap: {
                options: {
                    style: 'expanded',
                    sourcemap: 'none',
                    noCache: true
                },
                files : {
                    'assets/css/bootstrap.css':'assets/scss/bootstrap.scss'
                }
            }
        },
        csslint: {
            lax: {
                options: {
                    import: 2
                },
                src: [
                    'assets/css/*.css',
                    '!assets/css/*.min.css',
                    '!assets/css/bootstrap.css'
                ]
            }
        },
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'assets/css/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'assets/css/',
                    ext: '.min.css'
                }]
            }
        },
        jshint: {
            files: ['assets/js/*/*.js', '!assets/js/*/*.min.js'],
            options: {
                esversion: 6,
                sub: true,
                globals:{
                    jQuery: true
                }
            }
        },
        uglify: {
            front: {
                options: {
                    mangle: false
                },
                files: [{
                    expand: true,
                    src: ['assets/js/front/*.js', '!assets/js/front/*.min.js'],
                    dest: 'assets/js/front',
                    cwd: '.',
                    rename: function (dst, src) {
                        return src.replace('.js', '.min.js');
                    }
                }]
            },
            admin: {
                options: {
                    mangle: false
                },
                files: [{
                    expand: true,
                    src: ['assets/js/admin/*.js', '!assets/js/admin/*.min.js'],
                    dest: 'assets/js/admin',
                    cwd: '.',
                    rename: function (dst, src) {
                        return src.replace('.js', '.min.js');
                    }
                }]
            }
        },
        watch : {
            frontStyle: {
                files : [ 'assets/scss/front/*.scss' ],
                tasks : [ 'sass:front', 'csslint', 'cssmin' ]
            },
            adminStyle: {
                files : [ 'assets/scss/admin/admin.scss' ],
                tasks : [ 'sass:admin', 'csslint', 'cssmin' ]
            },
            bootstrap: {
                files : [ 'assets/sass/bootstrap.scss' ],
                tasks : [ 'sass:bootstrap', 'csslint', 'cssmin' ]
            },
            frontJS : {
                files : ['assets/js/front/script.js'],
                tasks : ['jshint', 'uglify:front']
            },
            adminJS : {
                files : ['assets/js/admin/admin.js'],
                tasks : ['jshint', 'uglify:admin']
            },
            customizer: {
                files: ['assets/js/front/customizer.js'],
                tasks: ['jshint', 'uglify']
            },
        },
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify-es');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};
