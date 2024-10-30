module.exports = function (grunt) {
    'use strict';
    // Configure Package.
    grunt.initConfig({
        makepot: {
            target: {
                options: {
                    domainPath: './languages/',
                    include: [
                        '.*'
                    ],
                    potHeaders: {
                        poedit: true,
                        'x-poedit-keywordslist': true
                    },
                    potComments: 'All rights reserved.',
                    updatePoFiles: true,
                    type: 'wp-plugin'
                }
            }
        }
    });
    // Load Packages From NPM Repository.
    grunt.loadNpmTasks('grunt-wp-i18n');

    // Register Tasks.
    grunt.registerTask('build', ['makepot']);
    grunt.registerTask('default', ['build']);
};
