module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		'string-replace': {
			'plugin-tokens': {
				files: {
					'./': ['*', 'src/**', 'tests/**'],
				},
				options: {
					replacements: [
						{
							pattern: function() {
								var tokens = [];
								for(var token in pkg.plugin_info) {
									tokens.push(token);
								}
								var result = '/' + tokens.join('|') + '/g';
								grunt.log.write(result);
								return result;
							},
							replacement: function(match, p1) {
								var plugin_info = grunt.config.get('pkg.plugin_info');
								return (match in plugin_info) ? plugin_info[match] : ("NOT_FOUND_" + match);
							}
						}
					]
				}
			}
		}
	});

	// Load the plugin that will replace the PLUGIN_* tokens with the actual values
	grunt.loadNpmTasks('grunt-string-replace');

	// Default task(s).
  grunt.registerTask('default', ['string-replace:plugin-tokens']);
};
