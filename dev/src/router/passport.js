import view from '../pages/view'

/* eslint-disable */
const login =  (resolve) => {
  require.ensure(['../pages/passport/login'], () => {
    resolve(require('../pages/passport/login'))
  })
}


export default {
  path: '/passport',
  component: view,
  children: [
    {
      path: 'login',
      component: login
    }
  ]
}
