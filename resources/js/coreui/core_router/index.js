import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '@/containers/Full'

// Views
import Dashboard from '@/views/sample/Dashboard'

// Views - Pages
import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'
import Login from '@/views/pages/Login'
import RegisterForm from '@/views/pages/RegisterForm'

// Sample route
import sample from '../router/sample'

Vue.use(Router)

export default new Router({
  mode           : 'history',
  linkActiveClass: 'open active',
  scrollBehavior : () => ({ y: 0 }),
  routes         : [
    {
      path     : '/',
      redirect : '/login',
      name     : 'login',
      component: Login,
      meta     : { auth: undefined },
    },
    {
      path     : '/dashboard',
      name     : 'dashboard',
      component: Full,
      children : [
        {
          path     : 'dashboard',
          name     : 'Dashboard',
          component: Dashboard,
        },
        ...sample,
      ],
    },
    {
      path     : '/admin',
      name     : 'admin.dashboard',
      component: AdminDashboard,
      meta     : {
        auth: {
          roles            : 2, redirect         : { name: 'login' }, forbiddenRedirect: '/403',
        },
      },

    },
    {
      path     : '/pages',
      redirect : '/pages/404',
      name     : 'Pages',
      component: { render (c) { return c('router-view') } },
      children : [
        {
          path     : '404',
          name     : 'Page404',
          component: Page404,
        },
        {
          path     : '500',
          name     : 'Page500',
          component: Page500,
        },
        {
          path     : '/login',
          name     : 'Login',
          component: Login,
          meta     : { auth: false },
        },
        {
          path     : '/register',
          name     : 'register',
          component: RegisterForm,
        },
      ],
    },
    {
      path     : '*',
      name     : '404',
      component: Page404,
    },
  ],
})
