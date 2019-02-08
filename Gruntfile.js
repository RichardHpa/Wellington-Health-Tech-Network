module.exports = function(grunt){
    grunt.initConfig({
        sass:{
            dist:{
                options: {
                    sourcemap: 'none',
                    noCache: true
                },
                files:{
                    "assets/css/style.css":"assets/scss/master.scss"
                }
            }
        },
        watch: {
            sass:{
                files:["assets/scss/*.scss", "assets/scss/partials/*.scss", "!assets/scss/mediaQueries.scss"],
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
