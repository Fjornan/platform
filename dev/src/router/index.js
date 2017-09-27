import Vue from 'vue'
import VueRouter from 'vue-router'
import passport from './passport'
import shop from './shop'
import hhbb from './hhbb'
import logistics from './logistics'
import union from './union'
import school from './school'
import user from './user'

Vue.use(VueRouter)

export default new VueRouter({
  routes: [
    passport,
    shop,
    hhbb,
    logistics,
    union,
    school,
    user
  ]
})
