/**
 * 命名规范：
 *     {{模块名}}/{{方法名}}
 * 方法名命名规范：
 *     {{动作名}}_{{动作对象}}_{{动作修饰}}
 * 方法命名举例：
 *     INIT_DATA,GET_DATA_BY_ID,UPDATE_DATA_BY_ID
 * 动作名规范：
 *     INIT:初始化数据
 *     GET:获取数据
 *     UPDATE:更新数据
 *     DELETE:删除数据
 *     CLEAN:清空所有数据
 */

export default {
  state: {
    data: []
  },
  mutations: {
    initData(state, data) {
      state.data = data // eslint-disable-line
    }
  },
  actions: {

  },
  getters: {
    getData: state => state.data
  }
}
