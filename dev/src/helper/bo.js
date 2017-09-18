/**
 * 为Bone4-vue定制的辅助功能
 * @author leedow
 * @version 0.0.1
 */

/**
 * 将一个数组转换为可被bone4-vue select组件可用的数据结构
 * @param {Array} data 原始数据
 * @param {String} valName 原始数据中对应为value的属性名
 * @param {String} textName 原始数据中对应为text的属性名
 * @return {Array} [{value, text, ...}]其中...为原始数据自带属性
 */
export default function getOptions(data, valName, textName) {
  const op = []
  data.forEach((item) => {
    const tmp = item
    tmp.value = item[valName]
    tmp.text = item[textName]
    op.push(tmp)
  })
  return op
}
