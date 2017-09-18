/**
 * 多工程开发和编译处理模块
 */
var projectsConfig = require('../config/projects')

module.exports.getProject = function(){
  var projects = []
  var arguments = process.argv[2]||'default'//.splice(2)

  for(key in projectsConfig){
    projects.push({
      name: projectsConfig[key].name,
      key: key
    })
  }

  function printList(){
    for(var i=0; i<projects.length; ++i){
      console.log(projects[i].name + ":" + projects[i].key)
    }
  }

  return projectsConfig[arguments]
}
