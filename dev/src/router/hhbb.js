import Frame from '../pages/frame'

/* eslint-disable */
const order =  (resolve) => {
  require.ensure(['../pages/hhbb/order'], () => {
    resolve(require('../pages/hhbb/order'))
  })
}

const setting =  (resolve) => {
  require.ensure(['../pages/hhbb/setting'], () => {
    resolve(require('../pages/hhbb/setting'))
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
      path: 'setting',
      component: setting
    },
  ]
}
