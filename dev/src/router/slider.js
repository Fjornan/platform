import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/slider/index'], () => {
    resolve(require('../pages/slider/index'))
  })
}
const add =  (resolve) => {
  require.ensure(['../pages/slider/add'], () => {
    resolve(require('../pages/slider/add'))
  })
}
const edit =  (resolve) => {
  require.ensure(['../pages/slider/edit'], () => {
    resolve(require('../pages/slider/edit'))
  })
}



export default {
  path: '/slider',
  component: Frame,
  children: [
    {
      path: '/',
      component: index
    },
    {
      path: 'add',
      component: add
    },
    {
      path: 'edit/:id',
      component: edit
    }
  ]
}
