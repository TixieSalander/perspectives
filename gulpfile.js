var gulp				= require('gulp');
var less				= require('gulp-less');
var autoprefixer		= require('gulp-autoprefixer');
var csscomb				= require('gulp-csscomb');
var imagemin			= require('gulp-imagemin');
var browserSync			= require('browser-sync');
var reload				= browserSync.reload;

var paths = {
	less: {
		src: 'dev/less/style.less',
		dest: './',
		watch: 'dev/less/**'
	},
	html: {
		watch: '*.html',
	},
	imgs: {
		watch: 'dev/assets/img/*.*',
	},
	copyjs: {
		watch: 'dev/assets/js/**/*.*',
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

gulp.task('imagemin', () =>
    gulp.src('dev/assets/img/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('img'))
);

gulp.task('copyjs', () =>
	gulp.src('dev/assets/js/**/*')
		.pipe(gulp.dest('js'))
);

gulp.task('browser-sync', function() {
	browserSync({
		server: {
			baseDir: "./",
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

gulp.task('default', ['less', 'imagemin', 'copyjs']);
