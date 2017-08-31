var
	gulp = require( "gulp" ),
	browsersync = require("browser-sync"),
	sass = require( "gulp-sass" ),
	newer = require( "gulp-newer" ),
	destclean = require( "gulp-dest-clean" ),
	preprocess = require( "gulp-preprocess" ),
	pkg = require( "./package.json" );

var
	devBuild = ( (process.env.NODE_ENV || "development").trim().toLowerCase() !== 'production'),
	source = 'sources/',
	dest = 'public/';

var
	css = {
		in: source + "sass/styles.scss",
		watch: [ source + "sass/**/*" ],
		out: dest + "css/",
		sassOpts: {
			outputStyle: "expanded",
			precision: 3, // nombre de valeurs derrière la virgule
			errLogToConsole: true // pour que les erreurs s'affichent dans la console
		}
	},
	syncOpts = {
		server: {
			baseDir: dest,
			index: "template.blade.php"
		},
		open: false,
		notify: true
	};

gulp.task( "sass", function() {
	return gulp.src( css.in )
		.pipe( sass( css.sassOpts ) )
		.pipe( gulp.dest( css.out ) )
		.pipe( browsersync.reload( { stream: true } ) );
} );

gulp.task( "browsersync", function() {
	browsersync( syncOpts );
} );

gulp.task( "default", [ "sass", "browsersync" ], function(  ) {
	gulp.watch( css.watch, [ "sass" ] );
} );
