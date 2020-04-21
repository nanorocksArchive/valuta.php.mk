import Vue from 'vue'
import Router from 'vue-router'

import List from '../components/List.vue'
import Convert from '../components/Convert.vue'
import History from '../components/History.vue'
import About from '../components/About.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/list',
      name: 'list',
      component: List
    },
    {
      path: '/convert',
      name: 'convert',
      component: Convert
    },
    {
      path: '/history',
      name: 'history',
      component: History
    },
    {
      path: '/',
      name: 'about',
      component: About
    }
  ]
})
