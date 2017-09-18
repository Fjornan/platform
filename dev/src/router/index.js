import Vue from 'vue'
import VueRouter from 'vue-router'
import demo from './demo'
import home from './home'
import passport from './passport'
import slider from './slider'
import article from './article'
import price from './price'
import recruit from './recruit'

Vue.use(VueRouter)

export default new VueRouter({
  routes: [
    demo,
    home,
    passport,
    slider,
    article,
    price,
    recruit
  ]
})
