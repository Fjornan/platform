import Frame from '../pages/frame'

/* eslint-disable */
const index =  (resolve) => {
  require.ensure(['../pages/article/index'], () => {
    resolve(require('../pages/article/index'))
  })
}

const detail =  (resolve) => {
  require.ensure(['../pages/article/detail'], () => {
    resolve(require('../pages/article/detail'))
  })
}

const add =  (resolve) => {
  require.ensure(['../pages/article/add'], () => {
    resolve(require('../pages/article/add'))
  })
}

const edit =  (resolve) => {
  require.ensure(['../pages/article/edit'], () => {
    resolve(require('../pages/article/edit'))
  })
}

const test =  (resolve) => {
  require.ensure(['../pages/article/test'], () => {
    resolve(require('../pages/article/test'))
  })
}

export default {
  path: '/article',
  component: Frame,
  children: [
    {
      path: '/',
      component: index
    },
    {
      path: 'detail/:id',
      component: detail
    },
    {
      path: 'add',
      component: add
    },
    {
      path: 'edit/:id',
      component: edit
    },
    {
      path: 'test',
      component: test
    }
  ]
}
