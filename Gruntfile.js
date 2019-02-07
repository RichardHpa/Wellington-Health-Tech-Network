module.exports = function(grunt){
    grunt.initConfig({
        sass:{
            dist:{
                options: {
                    sourcemap: 'none',
                    noCache: true
                },
                files:{
                    "assets/css/sass.css":"assets/sass/style.scss"
                }
            }
        },
        watch: {
            sass:{
                files:["assets/sass/*.scss", "assets/sass/partials/*.scss", "!assets/sass/mediaQueries.scss"],
                tasks:["sass"]
            }
        }
    });

    // grunt.loadNpmTasks();
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    // grunt.registerTask();
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('compile', ['sass']);

};
