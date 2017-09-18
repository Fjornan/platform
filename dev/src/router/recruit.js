import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/recruit/index'], () => {
    resolve(require('../pages/recruit/index'))
  })
}

const edit =  (resolve) => {
  require.ensure(['../pages/recruit/edit'], () => {
    resolve(require('../pages/recruit/edit'))
  })
}

const add =  (resolve) => {
  require.ensure(['../pages/recruit/add'], () => {
    resolve(require('../pages/recruit/add'))
  })
}


export default {
  path: '/recruit',
  component: Frame,
  children: [
    {
      path: '/',
      component: index
    },
    {
      path: 'edit/:id',
      component: edit
    },
    {
      path: 'add',
      component: add
    }
  ]
}
