import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/price/index'], () => {
    resolve(require('../pages/price/index'))
  })
}

const detail =  (resolve) => {
  require.ensure(['../pages/price/detail'], () => {
    resolve(require('../pages/price/detail'))
  })
}

export default {
  path: '/price',
  component: Frame,
  children: [
    {
      path: '/',
      component: index
    },
    {
      path: 'detail/:id',
      component: detail
    }
  ]
}
