import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/user/index'], () => {
    resolve(require('../pages/user/index'))
  })
}

export default {
  path: '/user',
  component: Frame,
  children: [
    {
      path: '/',
      component: index
    }
  ]
}
