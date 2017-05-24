const gulp = require('gulp')
const sass = require('gulp-sass')
const uglyfly = require('gulp-uglyfly')
const  copy = require('gulp-copy')

const webApp = "./app/Resources/public"
const sassSrc = `${webApp}/sass/**/main.scss`
const jsSrc = `${webApp}/js/**/*.js`
const buildSrc = `./web/dist`
const nodeModules = `./node_modules/`
const jsDirs = [
    './node_modules/jquery/dist/jquery.js',
    './node_modules/tether/dist/js/tether.js',
    './node_modules/bootstrap/dist/js/bootstrap.js',
    jsSrc
]

gulp.task('sass', () => gulp.src(sassSrc)
    .pipe(sass({
        outputStyle: 'compressed',
        includePaths: [ nodeModules ]
    }).on('error', sass.logError))
    .pipe(gulp.dest(`${buildSrc}/css`))
)

gulp.task('js', () => gulp.src(jsDirs)
    .pipe(uglyfly())
    .pipe(gulp.dest(`${buildSrc}/js`))
)

gulp.task('fonts', () => gulp.src('./node_modules/**/fonts/**/*')
    .pipe(copy(`${buildSrc}/fonts`, {prefix: 7}))
)

gulp.task('sass:watch', () => gulp.watch(`${webApp}/**/*.scss`, ['sass']))
gulp.task('js:watch', () => gulp.watch(jsSrc, ['js']))

gulp.task('watch', [ 'sass:watch', 'js:watch' ])
gulp.task('default', [ 'sass', 'js' ])