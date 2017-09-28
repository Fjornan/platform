import Frame from '../pages/frame'

/* eslint-disable */
const order =  (resolve) => {
  require.ensure(['../pages/hhbb/order'], () => {
    resolve(require('../pages/hhbb/order'))
  })
}

const patent =  (resolve) => {
  require.ensure(['../pages/hhbb/patent'], () => {
    resolve(require('../pages/hhbb/patent'))
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
      path: 'patent',
      component: patent
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
