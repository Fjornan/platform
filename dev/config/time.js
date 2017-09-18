/**
 * 日期辅助模块
 */
/* eslint-disable */

/**
 * @param {str} yyyy-mm-dd | yyyy-m-d | yyyy-mm-dd hh:mm:ss
 */
function Time(str){
  this.obj = null //原生JS DATE对象
  this.time = 0 //时间戳
  this.year = 0
  this.month = 0
  this.date = 0
  this.hour = 0
  this.minute = 0
  this.second = 0

  this.init(str)
}

/**
 * 初始化日期数据
 * @param {String} str yyyy-mm-dd | yyyy-m-d | yyyy-mm-dd hh:mm:ss
 *                     yyyy/mm/dd | yyyy/m/d | yyyy/mm/dd hh:mm:ss
 */
Time.prototype.init = function(str){

  if(typeof str == 'undefined'){
    this.obj = new Date()
    this.year = this.obj.getFullYear()
    this.month = this.obj.getMonth()+1
    this.date = this.obj.getDate()
    this.hour = this.obj.getHours()
    this.minute = this.obj.getMinutes()
    this.second = 0

    return
  }

  var d = str.split(' ')
  var d1 = d[0].split('-')

  if(d1.length === 1){
    d1 = d[0].split('/')
  }


  this.year = parseInt(d1[0])
  this.month = parseInt(d1[1])
  this.date = parseInt(d1[2])

  if(d[1]){
      var d2 = d[1].split(':')
      this.hour = parseInt(d2[0])
      this.minute = parseInt(d2[1])
      this.second = parseInt(d2[2])
  }

  this.obj = new Date(this.year, this.month-1, this.date, this.hour, this.minute, this.second)
}

/**
 * 比较日期是否相等
 * @param {Time} aim 对比的time对象
 * @param {String} min 对比的最小精确单位
 */
Time.prototype.equal = function(aim, min){
  let m = min||'date'
  let result = false

  switch(m){
    case 'date':{
      if(this.year === aim.year && this.month === aim.month && this.date === aim.date){
        result = true
        break
      }
    }
    default: {
      result = false
    }
  }

  return result

}

/**
 * @param {format} yy-mm-dd hh:mm:ss
 */
Time.prototype.format = function(format){
  let result = format.replace('yy', this.year)
  result = result.replace('MM', trans(this.month))
  result = result.replace('dd', trans(this.date))
  result = result.replace('hh', trans(this.hour))
  result = result.replace('mm', trans(this.minute))
  result = result.replace('ss', trans(this.second))



  return result
}

function trans(str) {
      str = str + '' //eslint-disable-line
      const s = '0'+ str
      return s.substring(str.length - 1, s.length)
    }

module.exports = Time
