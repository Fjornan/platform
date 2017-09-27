import Frame from '../pages/frame'

/* eslint-disable */
const amaaccount =  (resolve) => {
  require.ensure(['../pages/school/amazon-account'], () => {
    resolve(require('../pages/school/amazon-account'))
  })
}

const amanewapply =  (resolve) => {
  require.ensure(['../pages/school/amazon-newapply'], () => {
    resolve(require('../pages/school/amazon-newapply'))
  })
}

const amaqa =  (resolve) => {
  require.ensure(['../pages/school/amazon-qa'], () => {
    resolve(require('../pages/school/amazon-qa'))
  })
}

export default {
  path: '/school',
  component: Frame,
  children: [
    {
      path: 'amaaccount',
      component: amaaccount
    },
    {
      path: 'amanewapply',
      component: amanewapply
    },
    {
      path: 'amaqa',
      component: amaqa
    },
  ]
}
