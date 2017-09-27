import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/logistics/index'], () => {
    resolve(require('../pages/logistics/index'))
  })
}

export default {
  path: '/logistics',
  component: Frame,
  children: [
    {
      path: '/',
      component: index
    },
  ]
}
