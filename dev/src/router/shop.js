import Frame from '../pages/frame'

/* eslint-disable */
const amazon =  (resolve) => {
  require.ensure(['../pages/shop/amazon'], () => {
    resolve(require('../pages/shop/amazon'))
  })
}

export default {
  path: '/shop',
  component: Frame,
  children: [
    {
      path: 'amazon',
      component: amazon
    },
  ]
}
