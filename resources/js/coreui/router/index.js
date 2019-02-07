import VueRouter from 'vue-router'

// Pages
import Home from '../../pages/Home'
import Register from '../../pages/Register'
import Login from '../../pages/Login'
import Dashboard from '../../pages/user/Dashboard'
import AdminDashboard from '../../pages/admin/Dashboard'
import Test from '../../pages/Test'
import Test2 from '../../pages/Test2'
import About from '../../pages/About'

// import LDC from '../containers/LDC'

// Routes
const routes = [
  {
    path     : '/',
    name     : 'home',
    component: Home,
    meta     : { auth: undefined },
  },
  {
    path     : '/about',
    name     : 'about',
    component: About,
    meta     : { auth: undefined },
  },
  {
    path     : '/register',
    name     : 'register',
    component: Register,
    meta     : { auth: false },
  },
  {
    path     : '/login',
    name     : 'login',
    component: Login,
    meta     : { auth: false },
  },
  // USER ROUTES
  {
    path     : '/dashboard',
    name     : 'user.dashboard',
    component: Dashboard,
    meta     : { auth: true },
  },
  {
    path     : '/test',
    name     : 'test',
    component: Test,
    meta     : { auth: true },
  },
  {
    path     : '/test2',
    name     : 'test2',
    component: Test2,
    meta     : { auth: true },
  },
  // ADMIN ROUTES
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
]
const router = new VueRouter({
  history: true,
  mode   : 'history',
  routes,
})

export default router
