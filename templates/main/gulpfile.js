var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));

gulp.task('sass', function(){
	return gulp.src('scss/styles.scss')
		.pipe(sass()) // Конвертируем Sass в CSS через gulp-sass
		.pipe(gulp.dest('css'))
});

gulp.task('watch', function () {
	gulp.watch('scss/**/*.scss', ['sass']);
})

gulp.task('default', ['watch']);