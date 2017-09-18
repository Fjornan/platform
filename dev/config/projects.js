var path = require('path')
var Time = require('./time')


module.exports = {
  /**
   *  主工程
   */
  default: {
    name: 'default',
    entry: 'main.js',
    buildTemplate: 'index.html',
    devTemplate: 'index.html',
    index: path.resolve(__dirname, '../../admin.html'),
    assetsRoot: path.resolve(__dirname, '../../'),
    assetsSubDirectory: 'static/default/'+new Time().format('yyMMddhhmm'),
    assetsPublicPath: '',
    proxy: {

    },
    port: '8089'
  }
}
