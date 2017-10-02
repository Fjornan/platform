import Frame from '../pages/frame'

/* eslint-disable */
const amazon =  (resolve) => {
  require.ensure(['../pages/shop/amazon'], () => {
    resolve(require('../pages/shop/amazon'))
  })
}

const amazonDetail =  (resolve) => {
  require.ensure(['../pages/shop/amazon-detail'], () => {
    resolve(require('../pages/shop/amazon-detail'))
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
    {
      path: 'amazonDetail/:id',
      component:amazonDetail
    }
  ]
}
