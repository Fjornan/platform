/**
 * 本地持久化存储辅助模块
 */
export default storage = {
  /**
   * 检查是否支持localstorage
   * @return {Boolean}
   */
  support (){
    if(window.locaStorage){
      return true
    } else {
      console.log('localstorage unsupported')
      return false
    }
  },
  /**
   * 插入新的数据
   * @param {Object} data 要插入的数据
   */
  insert (data){
    if(!this.support()) return

  }
}
