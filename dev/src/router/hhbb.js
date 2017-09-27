import Frame from '../pages/frame'

/* eslint-disable */
const order =  (resolve) => {
  require.ensure(['../pages/hhbb/order'], () => {
    resolve(require('../pages/hhbb/order'))
  })
}

const product =  (resolve) => {
  require.ensure(['../pages/hhbb/product'], () => {
    resolve(require('../pages/hhbb/product'))
  })
}

const proedit =  (resolve) => {
  require.ensure(['../pages/hhbb/product-edit'], () => {
    resolve(require('../pages/hhbb/product-edit'))
  })
}

export default {
  path: '/hhbb',
  component: Frame,
  children: [
    {
      path: 'order',
      component: order
    },
    {
      path: 'product',
      component: product
    },
    {
      path: 'proedit/:id',
      component: proedit
    },
  ]
}
