import frame from '../pages/frame'

/* eslint-disable */
const log =  (resolve) => {
  require.ensure(['../pages/demo/index'], () => {
    resolve(require('../pages/demo/index'))
  })
}


export default {
  path: '/demo',
  component: frame,
  children: [
    {
      path: 'index',
      component: log
    }
  ]
}
