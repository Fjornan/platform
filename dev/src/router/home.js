import frame from '../pages/frame'

/* eslint-disable */
const home =  (resolve) => {
  require.ensure(['../pages/home/index'], () => {
    resolve(require('../pages/home/index'))
  })
}


export default {
  path: '/',
  component: frame,
  children: [
    {
      path: 'index',
      component: home
    }
  ]
}
