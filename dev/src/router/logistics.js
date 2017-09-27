import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/logistics/index'], () => {
    resolve(require('../pages/logistics/index'))
  })
}

const amazon =  (resolve) => {
  require.ensure(['../pages/logistics/amazon'], () => {
    resolve(require('../pages/logistics/amazon'))
  })
}

const warehouse =  (resolve) => {
  require.ensure(['../pages/logistics/warehouse'], () => {
    resolve(require('../pages/logistics/warehouse'))
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
    {
      path: 'amazon',
      component: amazon
    },
    {
      path: 'warehouse',
      component: warehouse
    },
  ]
}
