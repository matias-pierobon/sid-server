const gulp = require('gulp')
const sass = require('gulp-sass')
const uglyfly = require('gulp-uglyfly')

const webApp = "./client"
const sassSrc = `${webApp}/sass/**/*.scss`
const jsSrc = `${webApp}/js/**/*.js`
const buildSrc = `./web/dist`

const jsDirs = [jsSrc]

gulp.task('sass', () => gulp.src(sassSrc)
    .pipe(sass({
        outputStyle: 'compressed'
    }).on('error', sass.logError))
    .pipe(gulp.dest(`${buildSrc}/css`))
)

gulp.task('js', () => gulp.src(jsDirs)
    .pipe(uglyfly())
    .pipe(gulp.dest(`${buildSrc}/css`))
)

gulp.task('sass:watch', () => gulp.watch(sassSrc, ['sass']))
gulp.task('js:watch', () => gulp.watch(jsSrc, ['js']))

gulp.task('watch', [ 'sass:watch', 'js:watch' ])
gulp.task('default', [ 'sass', 'js' ])