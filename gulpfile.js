var gulp						= require('gulp');
var less						= require('gulp-less');
var autoprefixer		= require('gulp-autoprefixer');
var csscomb					= require('gulp-csscomb');
var imagemin				= require('gulp-imagemin');
var browserSync			= require('browser-sync');
var reload					= browserSync.reload;

var paths = {
	less: {
		src: 'less/style.less',
		dest: 'wp-content/themes/perspectives/',
		watch: 'less/**'
	},
	html: {
		watch: 'wp-content/themes/perspectives/**/*.html',
	},
	imgs: {
		watch: 'assets/img/*.*',
	},
	copyjs: {
		watch: 'assets/js/**/*.*',
	},
	csscomb : {
		src: [
			'less/**',
			'!less/1.base/_00-mixins.less',
			'!less/1.base/_05-spacing.less',
			'!less/1.base/_07-width.less',
			'!less/1.base/_08-grid.less',
			'!less/2.structure/_02-icons.less',
			'!less/5.vendors/**'
		],
		dest: 'less/'
	}
};

gulp.task('less', function () {
	gulp.src(paths.less.src)
		.pipe(less())
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(gulp.dest(paths.less.dest))
		.pipe(reload({stream:true}));
});

gulp.task('csscomb', function () {
	gulp.src(paths.csscomb.src)
		.pipe(csscomb())
		.pipe(gulp.dest(paths.csscomb.dest));
});

gulp.task('imagemin', () =>
    gulp.src('assets/img/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('wp-content/themes/perspectives/img'))
);

gulp.task('copyjs', () =>
	gulp.src('assets/js/**/*')
		.pipe(gulp.dest('wp-content/themes/perspectives/js'))
);

gulp.task('browser-sync', function() {
	browserSync({
		server: {
			baseDir: "wp-content/themes/perspectives",
			directory: true
		}
	});
});

gulp.task('bs-reload', function () {
	browserSync.reload();
});



gulp.task('watch', ['browser-sync'], function () {
	gulp.watch(paths.less.watch, ['less']);
	gulp.watch(paths.html.watch, ['bs-reload']);
	gulp.watch(paths.imgs.watch, ['imagemin']);
	gulp.watch(paths.copyjs.watch, ['copyjs']);
});

gulp.task('default', ['less']);
