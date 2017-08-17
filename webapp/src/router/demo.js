import View from '../pages/view'
import IndexPage from '../pages/demo'

export default {
  path: '/demo',
  component: View,
  children: [
    {
      path: '/',
      component: IndexPage
    }
  ]
}
