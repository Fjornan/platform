import Frame from '../pages/frame'

/* eslint-disable */
const hasgoods =  (resolve) => {
  require.ensure(['../pages/union/hasgoods'], () => {
    resolve(require('../pages/union/hasgoods'))
  })
}

const seekgoods =  (resolve) => {
  require.ensure(['../pages/union/seekgoods'], () => {
    resolve(require('../pages/union/seekgoods'))
  })
}

const apply =  (resolve) => {
  require.ensure(['../pages/union/apply'], () => {
    resolve(require('../pages/union/apply'))
  })
}

const recruit =  (resolve) => {
  require.ensure(['../pages/union/recruit'], () => {
    resolve(require('../pages/union/recruit'))
  })
}

const activity =  (resolve) => {
  require.ensure(['../pages/union/activity-apply'], () => {
    resolve(require('../pages/union/activity-apply'))
  })
}

const operate =  (resolve) => {
  require.ensure(['../pages/union/operate'], () => {
    resolve(require('../pages/union/operate'))
  })
}

export default {
  path: '/union',
  component: Frame,
  children: [
    {
      path: 'hasgoods',
      component: hasgoods
    },
    {
      path: 'seekgoods',
      component: seekgoods
    },
    {
      path: 'apply',
      component: apply
    },
    {
      path: 'recruit',
      component: recruit
    },
    {
      path: 'activity',
      component: activity
    },
    {
      path: 'operate',
      component: operate
    }
  ]
}
